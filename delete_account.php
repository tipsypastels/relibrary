<?php
  require 'header.php';
  authenticate_user();

  $id = current_user()->id();

  DatabaseModel::query("
    DELETE FROM 
      customers
    WHERE
      id = $id
  ");

  redirect_to('logout');
?>