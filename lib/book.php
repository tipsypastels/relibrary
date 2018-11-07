<?php

class Book extends DatabaseModel {
  public static function table_name() {
    return 'books';
  }
  
  public static function strong_params() {
    return ['id'];
  }

  // TODO having relibrary in here is a hack

  public function link() {
    return "/relibrary/books.php?id=" . $this->id();
  }
}

?>