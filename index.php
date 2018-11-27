<?php   
  require 'header.php'; 
  title('Relibrary');
?>

<main class="flex column flex-centered">
  <h1 class="title">Relibrary</h1>

  <section id="page-buttons">
    <a href="randombook.php" class="btn block">
      Random Book
    </a>

    <a href="search.php" class="btn block">
      Search Books
    </a>

    <?php if (signed_in()): ?>
      <a href="dashboard.php" class="btn block">
        Your Dashboard
      </a>

      <a href="logout.php" class="btn block">
        Log Out
      </a>
    <?php endif; ?>
  </section>

  <?php if (!signed_in()): ?>
    <section id="login" class="flex">
      <?php render_partial('login_form') ?>
      <?php render_partial('signup_form') ?>
    </section>
  <?php endif; ?>
</main>

<?php require 'footer.php'; ?>