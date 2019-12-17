<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Message_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_view('/admin/');
  }
} 