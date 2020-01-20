<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Index_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function index() {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['stories'] = $this->story_model->get_published_recent_stories($this->pid, 0);
    $this->load_view('common/home', $this->view_data);
  }

  function contact() {
    $this->load_view('common/contact', $this->view_data);
  }

  function popular() {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['stories'] = $this->story_model->get_published_popular_stories($this->pid, 0);
    $this->load_view('common/popular', $this->view_data);
  }
} 