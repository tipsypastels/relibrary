<?php

require "lib/base.php";
require "partials/base.php";

session_start();

?>

<!-- 
  Rather than manually using LINK REL, all css files are automatically compiled into this STYLE tag.
-->

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <?php foreach(glob('stylesheets/*.css') as $ss): ?>
      <style>
        <?php require($ss); ?>
      </style>
    <?php endforeach; ?>
  </head>

  <body>