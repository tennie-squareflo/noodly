<?php
class Admin_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
    if (!$this->check_logged_in()) {
      header('Location: login');
    }
  }
  function check_logged_in() {
    $this->load_model('auth');
    return $this->auth_model->is_logged_in();
  }
}