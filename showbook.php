<?php require 'header.php' ?>

<?php

$book = Book::find($_GET);
echo $book->name();
print_r($book->author());

?>