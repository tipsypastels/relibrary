<?php require 'header.php' ?>

<?php

$book = Book::find($_GET);
print_r($book);

?>