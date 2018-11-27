<?php
  require 'header.php';

  authenticate_user();

  if (!request_method_is('post')) {
    redirect_to('index');
    exit();
  }

  BookRating::new($_POST);

  $uid = current_user()->id();
  redirect_to('ratings', "customer_id=$uid");
?>