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
    $this->view_data['current_page'] = 'Latest';
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['stories'] = $this->story_model->get_published_recent_stories($this->pid, 0);
    $this->load_view('common/stories', $this->view_data);
  }

  function contact() {
    $this->view_data['current_page'] = 'Contactus';
    $this->load_view('common/contact', $this->view_data);
  }

  function popular() {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['current_page'] = 'Popular';
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['stories'] = $this->story_model->get_published_popular_stories($this->pid, 0);
    $this->load_view('common/stories', $this->view_data);
  }

  function contributors() {

    $this->load_model('publisher');
    $this->view_data['current_page'] = 'Contributors';
    $this->view_data['contributors'] = $this->publisher_model->get_active_contributors($this->pid);
    $this->load_view('common/contributors', $this->view_data);
  }

  function channels($channel) {
    
  }
} 