<?php

class SiteSearch {
  public function __construct($text) {
    global $db;
    $this->text = mysqli_real_escape_string($db, $text);
  }

  public function fetch() {
    return $this->wrap($this->query());    
  }

  private function wrap($query) {
    return DatabaseModel::handle_results($query, 'Book');
  }

  private function query() {
    global $db;
    $text = $this->text;

    return $db->query("
      SELECT DISTINCT
        books.*
      FROM
        books, authors
      WHERE
        books.name LIKE '%$text%'
      OR
        authors.name LIKE '%$text%'
    ;");
  }
}

?>