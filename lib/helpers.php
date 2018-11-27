<?php

function redirect_to($page, $get = '') {
  header("Location: $page.php?$get");
}

function signed_in() {
  return isset($_SESSION['customer']) && $_SESSION['customer'] != null;
}

function current_user() {
  if (signed_in()) {
    return $_SESSION['customer'];
  }
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

function fa($name, $group = 'fas') { ?>
  <i class="<?php echo $group ?> fa-<?php echo $name ?>"></i>
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