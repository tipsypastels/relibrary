<?php

class AuthorWithMostBooks {
  public function fetch() {
    return $this->wrap($this->query());
  }

  private function wrap($query) {
    return DatabaseModel::handle_results($query, 'Author')[0];
  }

  private function query() {
    return DatabaseModel::query("
      SELECT 
        authors.id
      FROM
        authors
      JOIN
        books
      ON
        books.author_id = authors.id
      GROUP BY
        authors.id
      ORDER BY
        COUNT(books.id) DESC
      LIMIT
        1
    ");
  }
}

?>