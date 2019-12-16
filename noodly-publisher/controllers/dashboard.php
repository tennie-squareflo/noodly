<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Dashboard_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function index() {
  }
} 