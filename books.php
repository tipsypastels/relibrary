<?php require 'header.php' ?>

<?php
  if ($_GET) {
    $books = Book::where($_GET);
  } else {
    $books = Book::all();
  }
?>

<ul>
  <?php foreach($books as $book): ?>
    <li>
      <a href="<?php echo $book->link() ?>">
        <?php echo $book->name() ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php require 'footer.php' ?>