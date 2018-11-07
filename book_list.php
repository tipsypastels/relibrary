<?php require 'header.php' ?>

<ul>
  <?php foreach(Book::all() as $book): ?>
    <li>
      <a href="<?php echo $book->link() ?>">
        <?php echo $book->name() ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>