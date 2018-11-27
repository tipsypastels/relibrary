<?php

###
#
# ABSTRACT PUBLIC DatabaseModel
#
# This is an abstract class that hides details of a lot of the queries
# that we have to do to render the pages. Indivudual classes corresponding
# to database tables inherit from this, such as the Book class.
#
# In a lot of cases this saves us from having to write raw SQL
# every time we need to look something simple up. For example,
# to fetch all books, we can use Book::all(), which is just
# a shortcut to SELECT * FROM books.
#
# Of course we are still writing SQL, it's just mostly in
# this class and done behind the scenes so we don't have to
# repeat the basic queries all over the place.
#
###

class DatabaseModel {

  ###
  #
  # PRIVATE STATIC handle_results
  # Converts a results hash to wrapper
  # model objects to add functionality.
  #
  ###

  public static function handle_results($results, $class = null) {
    if (!$class) {
      $class = get_called_class();
    }

    if ($results == false) {
      return null;
    }
    
    $models = [];

    while($row = $results->fetch_assoc()) {
      // PHP metaprogramming sucks
      eval('$model = new ' . $class . '($row);');
      $models[] = $model;
    }

    return $models;
  }

  ###
  #
  # PRIVATE STATIC query
  # Performs the actual query.
  #
  ###

  private static function query($query) {
    global $db;
    return $db->query($query);
  }

  ###
  #
  # PRIVATE STATIC from_self
  # Selects from the current table, filling in
  # the rest of the SQL automatically.
  #
  ###

  private static function from_self($select, $where, $filters = null) {
    global $db;

    if (is_array($where)) {
      $where = "where " . implode(" AND ", $where);
    } else if ($where) {
      $where = "where " . $where;
    }

    $results = self::query($select . " from " . static::table_name() . ' ' . $where . ' ' . $filters);
    return self::handle_results($results);
  }

  ###
  #
  # PUBLIC STATIC all
  # Selects everything from this table.
  #
  ###

  public static function all() {
    return self::from_self('select *', null);
  }

  ###
  #
  # PUBLIC STATIC where
  # Selects everything that matches the where params.
  # Example: Book::where("author_id = 1");
  #
  ###

  public static function where($params) {
    $params = self::handle_params($params);
    return self::from_self('select *', $params);
  }

  ###
  #
  # PUBLIC STATIC find
  # Selects the *first* that matches the where params.
  # Example: Book::find("id = 1")
  #
  ###

  public static function find($params) {
    $params = self::handle_params($params);
    $results = self::from_self('select *', $params, 'LIMIT 1');

    if (is_array($results)) {
      return $results[0];
    }
    return $results;
  }

  ###
  #
  # PRIVATE STATIC handle_params
  # Converts a hash of params into a query string.
  #
  ###

  private static function handle_params(...$params) {
    $handled_params = array_map(function($param) {
      if (!is_array($param)) {
        return $param;
      }

      $param = self::filter_params($param);

      return implode(" AND ", array_map(function($key, $value) {
        if (is_string($value)) {
          $value = "\"$value\"";
        }

        return "$key = $value";
      }, array_keys($param), array_values($param)));
    }, $params);

    return self::merge_conditions($handled_params);
  }

  ###
  #
  # PRIVATE STATIC filter_params
  # Filters params based on the strong_params static method
  # which must be defined on all subclasses.
  #
  ###

  private static function filter_params($params) {
    $params_kept = [];
    $allowed = static::strong_params();

    foreach($params as $key => $value) {
      if (in_array($key, $allowed)) {
        $params_kept[$key] = $value;
      }
    }

    return $params_kept;
  }

  ###
  #
  # PROTECTED STATIC merge_conditions
  # Merges two or more condition strings
  #
  ###

  protected static function merge_conditions($conds) {
    return implode(" ", array_filter($conds));
  }

  ###
  #
  # PUBLIC STATIC new
  # Inserts a new copy of this model
  #
  ###

  public static function new($params) {
    global $db;

    $params = self::filter_params($params);

    foreach(static::required_fields() as $field) {
      if (!isset($params[$field])) {
        return null;
      }
    }

    $fields = implode(', ', array_keys($params));
    $values = implode(', ', array_map(function($param) {
      return is_string($param) ? "\"$param\"" : $param;
    }, array_values($params)));

    $insert = "INSERT INTO " . static::table_name() . " ($fields) VALUES ($values);";

    echo $insert;

    $success = self::query($insert);

    if (!$success) {
      return null;
    }

    eval('$model = new ' . get_called_class() . '($params);');
    return $model;
  }

  # --- END OF STATIC METHODS ---

  ###
  #
  # PUBLIC __construct
  # Returns a wrapper object around the results hash.
  #
  ###

  public function __construct($hash) {
    $this->hash = $hash;
  }

  ###
  #
  # PUBLIC __call
  # Returns the value of a property.
  # (This is the missing method, it's called when
  # an undefined method is called on the object)
  #
  ###

  public function __call($name, $arguments) {
    if (array_key_exists($name, $this->hash)) {
      return $this->hash[$name];
    }

    $has_many = $this->check_has_many($name); 
    if ($has_many) return $has_many;

    $belongs_to = $this->check_belongs_to($name);
    if ($belongs_to) return $belongs_to;
  }

  ###
  #
  # PRIVATE check_has_many
  # Checks if a has_many relationship exists
  # on a subclass.
  #
  ###

  private function check_has_many($name) {
    if (!method_exists($this, 'has_many')) {
      return;
    }

    $has_many = $this->has_many();

    if (!array_key_exists($name, $has_many)) {
      return;
    }

    $hm_info = $has_many[$name];

    $model = $hm_info[0];
    $fk = $hm_info[1];

    return $model::where([
      $fk => $this->id()
    ]);
  }

  ###
  #
  # PRIVATE check_belongs_to
  # Checks if a belongs_to relationship exists
  # on a subclass.
  #
  ###

  private function check_belongs_to($name) {
    if (!method_exists($this, 'belongs_to')) {
      return;
    }

    $belongs_to = $this->belongs_to();

    if (!array_key_exists($name, $belongs_to)) {
      return;
    }
    
    $bt_info = $belongs_to[$name];

    $model = $bt_info[0];
    $fk = $bt_info[1];

    return $model::find([
      'id' => $this->hash[$fk]
    ]);
  }

  ###
  #
  # PUBLIC to
  # Passes the current model to a callback.
  #
  ###

  public function to($callback) {
    return $callback($this);
  }
}

?>