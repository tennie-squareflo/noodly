<?php
class Admin_Controller extends Core_Controller {
  function __construct($no_auth = false, $no_profile = false) {
    parent::__construct('admin');
    if (!$this->check_logged_in() && !$no_auth) {
      header("Location: ".BASE_URL."login");
      exit();
    }
    if (!$this->profile_ready() && !$no_profile) {
      header("Location: ".BASE_URL."my-account");
      exit();
    }
  }

  function check_logged_in() {
    $this->load_model('auth');
    return $this->auth_model->is_logged_in();
  }

  function profile_ready() {
    $this->load_model('auth');
    return $this->auth_model->is_profile_ready();
  }

  function load_view($page, $vars = array(), $return = false) {  
    if ($return === true) {
      $result = '';
      $result .= parent::load_view('/layout/html_header', $vars);
      $result .= parent::load_view('/layout/header', $vars);
      $result .= parent::load_view($page, $vars);
      $result .= parent::load_view('/layout/footer', $vars);
      return $result;
    } else {
      parent::load_view('/layout/html_header', $vars);
      parent::load_view('/layout/header', $vars);
      parent::load_view($page, $vars);
      parent::load_view('/layout/footer', $vars);
    }
  }
}