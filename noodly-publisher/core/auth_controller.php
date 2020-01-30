<?php
class Auth_Controller extends Core_Controller {

  function __construct($no_auth = false, $no_profile = false) {
    parent::__construct(PUBLISHER_DOMAIN);

    if (!$no_auth && !$this->check_logged_in()) {
      header("Location: ".BASE_URL."login");
      exit();
    }
    if (!$no_profile && !$this->profile_ready()) {
      header("Location: ".BASE_URL."my-account");
      exit();
    }
  }

  function redirect_auth() {
    if (!$this->check_logged_in()) {
      header("Location: ".BASE_URL."login");
      exit();
    }
    if (!$this->profile_ready()) {
      header("Location: ".BASE_URL."my-account");
      exit();
    }
  }

  function check_logged_in() {
    $this->load_model("auth");
    return $this->auth_model->is_logged_in();
  }

  function profile_ready() {
    $this->load_model("auth");
    return $this->auth_model->is_profile_ready();
  }

  function load_view($page, $vars = array(), $return = false) { 
    if (substr($page, 0, 6) === '/admin') {
      $layout_url = "/admin/layout";
    } else {
      $layout_url = "/common/layout";
    }

    if ($return === true) {
      $result = "";
      $result .= parent::load_view("$layout_url/html_header", $vars);
      if (!(substr($page, 0, 6) === '/admin' && !isset($_SESSION['user']))) {
        $result .= parent::load_view("$layout_url/header", $vars);
      }
      $result .= parent::load_view($page, $vars);
      $result .= parent::load_view("$layout_url/footer", $vars);
      return $result;
    } else {
      parent::load_view("$layout_url/html_header", $vars);
      if (!(substr($page, 0, 6) === '/admin' && !isset($_SESSION['user']))) {
        parent::load_view("$layout_url/header", $vars);
      }
      parent::load_view($page, $vars);
      parent::load_view("$layout_url/footer", $vars);
    }

  }
}