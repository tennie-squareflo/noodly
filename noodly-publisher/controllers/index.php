<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Index_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
    header("Location: ".BASE_URL."home");
  }
} 