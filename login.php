<?php
  require 'header.php';
  session_start();

  if (isset($_SESSION['customer'])) {
    redirect_to('dashboard');
  } else if (request_method_is('post') && isset($_POST['password'])) {
    $customer = Customer::find($_POST);

    if ($customer) {
      $_SESSION['customer'] = $customer;
      redirect_to('dashboard');
    } else {
      redirect_to('index');
    }
  } else {
    redirect_to('index');
  }
?>