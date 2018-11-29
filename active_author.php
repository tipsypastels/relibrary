<?php
  require 'header.php';
  $aid = Author::with_most_books()->id();
  redirect_to('show_author', "id=$aid");  
?>