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

  function edit($id = 0) {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/edit.js');

    $this->load_model('category');

    $this->view_data['categories'] = $this->category_model->get_categories($this->pid);
    
    $this->load_view('/admin/edit_story', $this->view_data);
  }

  function action($type) {
    var_dump($type);
    var_dump($_POST);
    switch ($type) {

    }
  }

  function upload_image() {

  }

  function preview($id) {}
} 