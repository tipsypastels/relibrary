<?php
  require 'header.php';
  session_start();

  if (isset($_SESSION['customer'])) {
    redirect_to('dashboard');
  } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = Customer::new($_POST);
    var_dump($customer);

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