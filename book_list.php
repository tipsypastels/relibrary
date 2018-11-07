<?php require 'header.php' ?>

<ul>
  <?php
    Book::all(function($book) { ?>
      <li><?php
        echo $book['name'];
      ?></li>
    <?php });
  ?>
</ul>