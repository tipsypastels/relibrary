<?php

class Customer extends DatabaseModel {
  public static function table_name() {
    return 'customers';
  }

  public static function strong_params() {
    return self::required_fields();
  }

  public static function required_fields() {
    return [
      'name', 
      'email',
      'phone', 
      'address',
      'password'
    ];
  }

  public function first_name() {
    return explode(' ', $this->name())[0];
  }

  public function ratings_link() {
    return "ratings.php?customer_id=" . $this->id();
  }

  public function renting($book) {
    $rental = BookRental::where([
      'book_id'     => $book->id(),
      'customer_id' => $this->id()
    ]);

    if (!$rental) return false;
    return sizeof($rental);
  }

  public function has_many() {
    return [
      'rentals' => ['BookRental', 'customer_id']
    ];
  }
}

?>