<?php
class Admin_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
    if (!$this->check_logged_in()) {
      header("Location: ".BASE_URL."login");
    }
  }

  function check_logged_in() {
    $this->load_model('auth');
    return $this->auth_model->is_logged_in();
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

  function single_load_view($page, $vars = array(), $return = false) {
    if ($return === true) {
      $result = '';
      $result .= parent::load_view($page, $vars, $return);
      return $result;
    } else {
      parent::load_view($page, $vars);
    }
  }
}