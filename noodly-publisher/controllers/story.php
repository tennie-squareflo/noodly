<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Story_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('publisher');
    $this->load_model('story');
    $this->load_model('user');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['stories'] = $this->story_model->get_recent_stories($pid, 0);
      $this->load_view('/admin/admin/stories', $this->view_data);
    } else {    // contributor
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['stories'] = $this->story_model->get_recent_stories($pid, $uuid);
      $this->load_view('/admin/contributor/stories', $this->view_data);
    }
  }
} 