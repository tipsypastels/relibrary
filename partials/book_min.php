<article class="book-min flex v-center" data-book-id="<?php echo $book->id() ?>" data-author-id="<?php echo $book->author()->id() ?>">

  <?php fa($book->featured() ? 'torah' : 'book') ?>

  <div class="meta">
    <a class="name" href="<?php echo $book->link() ?>">
      <?php echo $book->name() ?>
    </a>

    <?php $a_link = $book->author()->link() ?>

    <a class="author" href="<?php echo $a_link ?>">
      By <?php echo $book->author()->name() ?>
    </a>
  </div>
</article>