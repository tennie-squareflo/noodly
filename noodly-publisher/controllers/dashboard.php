<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Dashboard_Controller extends Auth_Controller {
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
      $this->view_data['contributors_cnt'] = $this->publisher_model->get_users_count('contributor', $pid);
      $this->view_data['stories_cnt'] = $this->story_model->get_stories_count($pid);
      $this->view_data['subscribers_cnt'] = $this->publisher_model->get_users_count('subscriber', $pid);
      $this->view_data['latest_stories'] = $this->story_model->get_recent_stories($pid, 0, 5);
      $this->load_view('/admin/admin/dashboard', $this->view_data);
    } else {    // contributor
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['stories_cnt'] = $this->story_model->get_stories_count($pid);
      $this->view_data['subscribers_cnt'] = $this->user_model->get_subscribers_count($uuid);
      $this->view_data['latest_stories'] = $this->story_model->get_recent_stories($pid, $uuid, 5);
      $this->load_view('/admin/contributor/dashboard', $this->view_data);
    }
  }
} 