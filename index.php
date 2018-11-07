<?php require 'header.php'; ?>

<h1>It worked! You're on Relibrary! (Nothing here yet)</h1>

<?php

Book::find("id = 1", function($book) {
  echo $book['name'];
});

?>