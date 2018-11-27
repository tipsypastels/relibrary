<?php
  require 'header.php';
  authenticate_user();
?>

<form class="b-form" method="post" action="edit_account.php">
  <div class="field">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?php echo current_user()->name() ?>">
  </div>

  <div class="field">
    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo current_user()->email() ?>">
  </div>

  <div class="field">
    <label for="phone">Phone</label>
    <input type="tel" name="phone" value="<?php echo current_user()->phone() ?>">
  </div>

  <div class="field">
    <label for="address">Address</label>
    <input type="text" name="address" value="<?php echo current_user()->address() ?>">
  </div>

  <div class="field">
    <label for="password">Password</label>
    <input type="password" name="password" value="<?php echo current_user()->password() ?>">
  </div>

  <input type="submit" value="Update Account">
</form>

<a href="delete_account.php" class="btn block">Delete my Account</a>