<?php
  require('header.php');
  authenticate_user();

  if (!request_method_is('post')) {
    redirect_to('dashboard');
    exit();
  }

  $id = current_user()->id();

  var_dump(DatabaseModel::query("
    UPDATE customers
    SET
      name = \"${_POST['name']}\",
      email = \"${_POST['email']}\",
      phone = ${_POST['phone']},
      address = \"${_POST['address']}\",
      password = \"${_POST['password']}\"
    WHERE id = $id
  "));

  # reset the cache
  $_SESSION['customer']->hash = $_POST;

  redirect_to('dashboard');
?>
