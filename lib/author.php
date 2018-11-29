<?php

class Author extends DatabaseModel {
  public static function table_name() {
    return 'authors';
  }

  public static function strong_params() {
    return ['id'];
  }

  public static function with_most_books() {
    $finder = new AuthorWithMostBooks();
    return $finder->fetch();
  }

  public function has_most_books() {
    return Author::with_most_books()->id() == $this->id();
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