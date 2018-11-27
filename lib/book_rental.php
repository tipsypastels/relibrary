<?php 

class BookRental extends DatabaseModel {
  public static function table_name() {
    return 'book_rentals';
  }

  public static function strong_params() {
    return ['book_id', 'customer_id', 'return_due'];
  }

  public static function required_fields() {
    return static::strong_params();
  }

  public function belongs_to() {
    return [
      'book' => ['Book', 'book_id']
    ];
  }

  public function overdue() {
    return time() > $this->return_due();
  }
}