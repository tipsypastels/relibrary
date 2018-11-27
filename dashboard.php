<?php 
  require 'header.php'; 
  title('Relibrary');

  if (!signed_in()) {
    redirect_to('index');
    exit();
  }
?>

<main class="flex column flex-centered">
  <h1 class="title">Welcome <?php echo current_name() ?></h1>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>

    <a href="rentals.php" class="btn block">
      Your Rentals
    </a>

    <a href="<?php echo current_user()->ratings_link() ?>" class="btn block">
      Your Ratings
    </a>

    <a href="logout.php" class="btn block">
      Log Out
    </a>
  </section>

  <?php if (!signed_in()): ?>
    <section id="login">
      <?php render_partial('login_form') ?>
      <?php render_partial('signup_form') ?>
    </section>
  <?php endif; ?>
</main>

<?php require 'footer.php'; ?>