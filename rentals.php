<?php
  require 'header.php';
  authenticate_user();
?>

<main>
  <h1 class="title">
    Rentals
  </h1>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>

    <a href="dashboard.php" class="btn block">
      Back to Dashboard
    </a>
  </section>

  <?php
    if (current_user()->rentals()) {
      foreach(current_user()->rentals() as $rental) {
        render_partial('rental', ['rental' => $rental]);
      }
    } else {
      echo "You have no rentals.";
    }
  ?>
</main>
