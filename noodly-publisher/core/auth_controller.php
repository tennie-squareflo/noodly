<?php
class Auth_Controller extends Core_Controller {

  public $publisher_domain;
  public $publisher;
  public $view_data;

  function __construct($no_auth = false, $no_profile = false) {
    parent::__construct(PUBLISHER_DOMAIN);
    $this->init();

    if (!$this->check_logged_in() && !$no_auth) {
      header("Location: ".BASE_URL."login");
      exit();
    }
    if (!$this->profile_ready() && !$no_profile) {
      header("Location: ".BASE_URL."accept/complete_profile");
      exit();
    }
  }

  function init() {
    $this->publisher_domain = PUBLISHER_DOMAIN;
    $this->load_model("publisher");
    $this->publisher = $this->publisher_model->get_one(array("domain" => $this->publisher_domain));
    $this->view_data['publisher'] = $this->publisher;
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
    if (substr($page, 6) === '/admin') {
      $layout_url = "/admin/layout";
    } else {
      $layout_url = "/common/layout";
    }

    if ($return === true) {
      $result = "";
      $result .= parent::load_view("$layout_url/html_header", $vars);
      $result .= parent::load_view("$layout_url/header", $vars);
      $result .= parent::load_view($page, $vars);
      $result .= parent::load_view("$layout_url/footer", $vars);
      return $result;
    } else {
      parent::load_view("$layout_url/html_header", $vars);
      parent::load_view("$layout_url/header", $vars);
      parent::load_view($page, $vars);
      parent::load_view("$layout_url/footer", $vars);
    }

  }

  function single_load($page, $vars = array(), $return = false) {
    if ($return === true) {
      $result = "";
      $result .= parent::load_view($page, $vars, $return);
      return $result;
    } else {
      parent::load_view($page, $vars);
    }
  }
}