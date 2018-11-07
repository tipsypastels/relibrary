<?php

if ($_GET && $_GET['id']) {
  require 'single_book.php';
} else {
  require 'book_list.php';
}

?>