<?php

class BookRating extends DatabaseModel {
  public static function table_name() {
    return 'book_ratings';
  }

  public static function strong_params() {
    return ['book_id', 'customer_id', 'score'];
  }

  public static function required_fields() {
    return self::strong_params();
  }

  public function belongs_to() {
    return [
      'customer' => ['Customer', 'customer_id'],
      'book' => ['Book', 'book_id']
    ];
  }
}