<?php

class Book extends DatabaseModel {
  public static function table_name() {
    return 'books';
  }

  public static function strong_params() {
    return ['id'];
  }

  public function link() {
    return "books.php?id=" . $this->id();
  }
}

?>