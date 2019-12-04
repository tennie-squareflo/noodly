<?php

class Error_Controller extends Core_Controller{
  function __construct() {
    parent::__construct('admin');
  }
  function error404() {
    $this->load_view('error/error404');
  }
  function expired() {
    $this->load_view('error/expired');
  }
  function invalid_token() {
    $this->load_view('error/invalid_token');
  }
}

