<?php
  require 'header.php';
  $author = Author::find($_GET);
  title($author->name());
?>

<main>
  <h1 class="title">
    <?php echo $author->name() ?>
  </h1>

  <img src="<?php echo $author->picture() ?>" style="max-height: 200px;">

  <section style="margin-top: 1em">
    <?php echo $author->biography() ?>
  </section>

  <h2 class="subtitle">
    Books By This Author
  </h2>

  <?php
    if ($author->books()) {
      foreach($author->books() as $book) {
        render_partial('book_min', ['book' => $book]);
      }
    }
  ?>
</main>

<?php require 'footer.php'; ?>