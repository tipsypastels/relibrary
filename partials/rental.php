<?php 
  $book = $rental->book();
  render_partial('book_min', ['book' => $book]);
?>

<div id="rental-meta">
  <div class="rented">
    Rented <?php echo rlytime($rental->checked_out()); ?>
  </div>

  <div class="due">
    Due Dec 4th, 2018
  </div>

  <?php if ($rental->overdue()): ?>
    <div class="overdue">
      Overdue
    </div>
  <?php endif; ?>
</div>
