<?php

class Error_Controller extends Core_Controller{
  function __construct() {
    parent::__construct(PUBLISHER_DOMAIN);
  }
  function error404() {
    $this->load_view('common/error/error404');
  }
  function expired() {
    $this->load_view('common/error/expired');
  }
  function invalid_token() {
    $this->load_view('common/error/invalid_token');
  }
}

