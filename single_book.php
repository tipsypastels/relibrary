<?php require 'header.php' ?>

<?php

Book::find("id = " . $_GET['id'], function($book) {
  echo $book['name'];
});

?>