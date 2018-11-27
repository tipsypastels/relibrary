<?php
  require 'header.php';
?>

<?php
  if (!request_method_is('get') || !isset($_GET['search'])) {
    redirect_to('search');
    exit();
  }

  $search = new SiteSearch($_GET['search']);
  $results = $search->fetch();

  if (!$results) {
    redirect_to('no_results');
    exit();
  }

  $title = sizeof($results) . ' Result';

  if (sizeof($results) !== 1) {
    $title .= 's';
  }

  title($title);
?>

<main class="flex column flex-centered">
  <h1 class="title"><?php echo $title ?></h1>

  <section id="page-buttons">
    <a class="btn block" href="index.php">
      Back Home
    </a>
  </section>

  <?php
    foreach($results as $book) {
      render_partial('book_min', ['book' => $book]);
    }
  ?>
</main>

<?php require 'footer.php' ?>