<?php

class Book extends DatabaseModel {
  public static function table_name() {
    return 'books';
  }

  public static function strong_params() {
    return ['id', 'author_id'];
  }

  public function link() {
    return "show_book.php?id=" . $this->id();
  }

  public function rent_link() {
    return "rent.php?book_id=" . $this->id();
  }

  public function belongs_to() {
    return [
      'author' => ['Author', 'author_id']
    ];
  }

  public function has_many() {
    return [
      'ratings' => ['BookRating', 'book_id']
    ];
  }

  public function average_rating() {
    return $this->aggregate_ratings('AVG');
  }

  public function rating_count() {
    return $this->aggregate_ratings('COUNT');
  }

  private function aggregate_ratings($agg) {
    $id = $this->id();

    $results = DatabaseModel::query("
      SELECT
        $agg(score)
      FROM
        book_ratings
      WHERE
        book_id = $id
    ");

    while($row = $results->fetch_assoc()) {
      return intval(array_values($row)[0]);
    }
  }

  public function ratings_link() {
    return "ratings.php?book_id=" . $this->id();
  }

  public function in_stock() {
    $stock =  $this->total_amount() - sizeof($this->rentals());
    if ($stock < 0) $stock = 0;
    return $stock;
  }

  public function rentals() {
    return BookRental::where(['book_id' => $this->id()]);
  }
}

?>