<?php
  require('header.php');
?>

<main>
  <h1 class="title">All Books</h1>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>
  </section>

  <section id="books">
    <?php
      foreach(Book::all() as $book) {
        render_partial('book_min', ['book' => $book]);
      }
    ?>  
  </section>
</main>