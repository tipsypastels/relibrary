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

abstract class DatabaseModel {

  ###
  #
  # PRIVATE STATIC handle_results
  # Converts a results hash to wrapper
  # model objects to add functionality.
  #
  ###

  private static function handle_results($results) {
    $models = [];

    while($row = $results->fetch_assoc()) {
      // PHP metaprogramming sucks
      eval('$model = new ' . get_called_class() . '($row);');
      $models[] = $model;
    }

    return $models;
  }

  ###
  #
  # PUBLIC STATIC from_self
  # Selects from the current table, filling in
  # the rest of the SQL automatically.
  #
  ###

  public static function from_self($select, $where) {
    global $db;

    if (is_array($where)) {
      $where = " where " . implode(" AND ", $where);
    } else if ($where) {
      $where = " where " . $where;
    }

    $results = $db->query($select . " from " . static::table_name() . $where);
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
    $params = self::handle_params($params, "LIMIT 1");
    $results = self::from_self('select *', $params);

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
    return $this->hash[$name];
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