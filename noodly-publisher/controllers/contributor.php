<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Contributor_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('publisher');
    $view_data['script_files'] = array('custom/publisher/contributors/invite_contributor.js');

    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['contributors'] = $this->publisher_model->get_contributors($pid);
      $this->load_view('/admin/admin/contributors', $this->view_data);
    } else {    // contributor
      header("Location: ".BASE_URL."error/access_denied");
    }
  }
} 