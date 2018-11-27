<?php include('header.php') ?>

<?php
  if (empty($_GET)) {
    redirect_to('index');
    exit();
  }

  $ratings = BookRating::where($_GET);
  $book = null;

  if (isset($_GET['book_id'])) {
    $book = Book::find(['id' => $_GET['book_id']]);
  }
?>

<main>
  <h1 class="title">Ratings</h1>

  <?php if ($book && signed_in()): ?>
    <?php render_partial('rate', ['book' => $book]); ?>
  <?php endif; ?>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>

    <?php
      if ($book): ?>
        <a href="<?php echo $book->link() ?>" class="btn block">
          Back to Book
        </a>
      <?php endif;
    ?>
  </section>

  <?php if ($ratings): ?>
    <?php
      foreach($ratings as $rating) {
        render_partial('rating', ['rating' => $rating]);
      }
    ?>  
  <?php else: ?>
    No ratings found for the given parameters.
  <?php endif; ?>
</main>

<?php include('footer.php') ?>