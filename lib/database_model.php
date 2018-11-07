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
  # PRIVATE STATIC table_name
  # Returns the name of a subclass to this model, converted to table name form.
  # Table names are always lowercase and plural.
  # Book => books
  #
  ###

  private static function table_name() {
    return strtolower(get_called_class()) . 's';
  }

  ###
  #
  # PRIVATE STATIC handle_results
  # Passes results to a callback, or 
  # returns them as a results object if
  # the callback is blank.
  #
  ###

  private static function handle_results($results, $callback = null) {
    if (!is_null($callback)) {
      while($row = $results->fetch_assoc()) {
        $callback($row);
      }
    }

    return $results;
  }

  ###
  #
  # PUBLIC STATIC from_self
  # Selects from the current table, filling in
  # the rest of the SQL automatically.
  #
  ###

  public static function from_self($select, $where, $callback = null) {
    global $db;

    if (is_array($where)) {
      $where = " where " . implode(" AND ", $where);
    } else if ($where) {
      $where = " where " . $where;
    }

    $results = $db->query($select . " from " . self::table_name() . $where);
    return self::handle_results($results, $callback);
  }

  ###
  #
  # PUBLIC STATIC all
  # Selects everything from this table.
  #
  ###

  public static function all($callback = null) {
    return self::from_self('select *', null, $callback);
  }

  ###
  #
  # PUBLIC STATIC where
  # Selects everything that matches the where params.
  # Example: Book::where("author_id = 1");
  #
  ###

  public static function where($params, $callback = null) {
    return self::from_self('select *', $params, $callback);
  }

  ###
  #
  # PUBLIC STATIC find
  # Selects the *first* that matches the where params.
  # Example: Book::find("id = 1")
  #
  ###

  public static function find($params, $callback = null) {
    $params = self::merge_conditions($params, "LIMIT 1");
    return self::from_self('select *', $params, $callback);
  }

  ###
  #
  # PROTECTED STATIC merge_conditions
  # Merges two condition strings
  #
  ###

  protected static function merge_conditions($c1, $c2, $join = " ") {
    if (!$c1) {
      return $c2;
    }

    if (!$c2) {
      return $c1;
    }

    return $c1 . " " . $c2;
  }
}

?>