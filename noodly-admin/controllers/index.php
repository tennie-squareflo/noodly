<?php
class Index_Controller extends Core_Controller {
  function __construct() {
		parent::__construct('admin');
	}
  function index() {
    $this->single_load('home');
  }
}
