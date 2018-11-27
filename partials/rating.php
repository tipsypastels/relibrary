<div class="rating" style="margin-bottom: 1em;">
  <div>
    <strong>
      <?php echo $rating->book()->name() ?> - 
      <?php echo $rating->score() ?> / 5
    </strong>
  </div>

  <div>
    <em>
      by

      <?php echo $rating->customer()->name() ?>
    </em>
  </div>
</div>