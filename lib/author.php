<?php

class Author extends DatabaseModel {
  public static function table_name() {
    return 'authors';
  }

  public static function strong_params() {
    return ['id'];
  }

  public function link() {
    return "show_author.php?id" . $this->id();
  }

  public function has_many() {
    return [
      'books' => ['Book', 'author_id']
    ];
  }
}

?>