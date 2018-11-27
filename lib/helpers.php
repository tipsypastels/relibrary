<?php

function redirect_to($page, $get = '') {
  header("Location: $page.php?$get");
}

function signed_in() {
  return isset($_SESSION['customer']);
}

function current_user() {
  return $_SESSION['customer'];
}

function current_name() {
  return current_user()->first_name();
}

function authenticate_user($goto = 'index', $or = null) {
  if (!signed_in() || $or) {
    redirect_to($goto);
    exit();
  }
}

function fa($name) { ?>
  <i class="fas fa-<?php echo $name ?>"></i>
<?php }

function title($title) { ?>
  <title><?php echo $title ?></title>
<?php }

function rlytime($time) {
  return date('M jS, o', strtotime($time));
}

function request_method_is($verb) {
  return $_SERVER['REQUEST_METHOD'] === strtoupper($verb);
}

?>