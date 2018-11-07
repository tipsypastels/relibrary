<?php

class Book extends DatabaseModel {
  public static function strong_params() {
    return ['id'];
  }
}

?>