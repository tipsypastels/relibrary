<?php

class Book extends DatabaseModel {
  public static function table_name() {
    return 'books';
  }

  public static function strong_params() {
    return ['id', 'author_id'];
  }

  public function link() {
    return "showbook.php?id=" . $this->id();
  }
}

?>