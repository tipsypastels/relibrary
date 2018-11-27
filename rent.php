<?php
  require 'header.php';

  $book = Book::find(['id' => $_GET['book_id']]);
  authenticate_user(!$book);

  $old_rental = BookRental::find([
    'customer_id' => current_user()->id(),
    'book_id'     => $book->id()
  ]);

  print_r($old_rental);

  if (!$old_rental) {
    BookRental::new([
      'customer_id' => current_user()->id(),
      'book_id'     => $book->id(),
      'return_due'  => mktime(null, null, null, null, date('j') + 7)
    ]);
  }

  redirect_to('rentals');
?>