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
    $text = $this->text;

    return DatabaseModel::query("
      SELECT DISTINCT
        books.name,
        books.id,
        books.author_id
      FROM
        books
      WHERE
        books.name LIKE '%$text%'
    ;");
  }
}

?>