<?php 
  require 'header.php'; 
  title('Search Relibrary');
?>

<main class="flex column flex-centered">
  <h1 class="title">Search</h1>

  <form action="results.php" method="get">
    <input type="text" name="search" placeholder="Enter your query" autofocus>
    <input type="submit" value="Search!">
  </form>

  <section id="page-buttons">
    <a href="index.php" class="btn block">
      Back Home
    </a>

    <a href="featured.php" class="btn block">
      Featured Books
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
</main>

<?php require 'footer.php'; ?>