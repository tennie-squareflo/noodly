<?php

class Error_Controller extends Core_Controller{
  function __construct() {
    parent::__construct('admin');
  }
  function error404() {
    $this->load_view('error/error404');
  }
}

