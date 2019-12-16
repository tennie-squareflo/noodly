<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Index_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function index() {
    var_dump($_SESSION);
    $this->load_view('common/home', $this->view_data);
  }
} 