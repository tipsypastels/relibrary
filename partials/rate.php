<form class="b-form" method="post" action="rate.php">
  <h3>Leave a Rating</h3>

  <input type="hidden" name="book_id" value="<?php echo $book->id() ?>">
  <input type="hidden" name="customer_id" value="<?php echo current_user()->id() ?>">

  <select name="score">
    <option value=1>1 / 5</option>
    <option value=2>2 / 5</option>
    <option value=3>3 / 5</option>
    <option value=4>4 / 5</option>
    <option value=5>5 / 5</option>
  </select>

  <input type="submit" value="Rate Book">
</form>