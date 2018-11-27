<?php require 'header.php' ?>

<?php
  $book = Book::find($_GET);

  if (!$book) {
    redirect_to('not_found');
    exit();
  }

  title($book->name());
?>

<main id="showbook" class="flex column flex-centered">
  <h1 class="title">
    <?php echo $book->name() ?>
  </h1>

  <h2 class="subtitle">
    By <?php echo $book->author()->name() ?>
  </h2>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>

    <?php if (signed_in()): ?>
      <?php if (!current_user()->renting($book)): ?>
        <?php if ($book->in_stock()): ?>
          <a href="<?php echo $book->rent_link() ?>" class="btn block">
            Rent This Book
          </a>
        <?php else: ?>
          <div class="btn disabled block">
            Out of Stock :(
          </div>
        <?php endif; ?>
      <?php endif; ?>

    <?php else: ?>
      <a href="index.php" class="btn block">
        Login to Reserve
      </a>
    <?php endif; ?>
    
    <a href="<?php echo $book->ratings_link() ?>" class="btn block">
      View Ratings
    </a>
  </section>

  <?php if (current_user()->renting($book)): ?>
    <section id="renting">
      <div class="divider"></div>

      You are renting this book. <a href="rentals.php">View your rentals.</a>
    </section>
  <?php endif; ?>

  <section id="book">
    <div class="divider"></div>

    <strong>
      About
    </strong>
    <p>
      <?php echo $book->description() ?>
    </p>
  </section>
</main>

<?php require 'footer.php' ?>