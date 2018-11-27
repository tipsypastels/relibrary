<?php
  require 'header.php';
  session_start();

  if (session_destroy()) {
    redirect_to('index');
  }
?>