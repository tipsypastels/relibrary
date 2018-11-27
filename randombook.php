<?php
  require 'header.php';

  $ids = Book::ids();
  $key = array_rand($ids);

  $bid = $ids[$key];
  redirect_to('show_book', "id=$bid");
?>