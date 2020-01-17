<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Home_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function index() {
    $this->load_view('common/home', $this->view_data);
  }

  function contact() {
    $this->load_view('common/contact', $this->view_data);
  }

  function story($slug) {
    $this->load_model('story');
    $this->load_model('category');
    $this->load_model('user');

    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/story_view.js');

    $story = $this->story_model->get_one(array('url' => $slug));

    $this->view_data['post'] = $story;
    $this->view_data['category'] = $this->category_model->get_one($this->view_data['post']['cid']);
    $this->view_data['author'] = $this->user_model->get_one($this->view_data['post']['uuid']);
    
    $this->load_view('/common/preview_story', $this->view_data);
  }
} 