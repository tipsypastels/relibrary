<?php

function render_partial($name, $params = []) {
  foreach($params as $var => $value) {
    $$var = $value;
  }

  require "partials/$name.php";
}

?>