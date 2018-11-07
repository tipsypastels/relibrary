<?php

require 'database_model.php';

$db = new mysqli(
  /* db host */  'localhost', 
  /* username */ 'root', 
  /* password */ '',
  /* db name */  'relibrary'
);

// TODO handle errors
// if ($db->connect_error) {
//   die("Uh oh.");
// } else {
//   print("Connected!");
// }

?>