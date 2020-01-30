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
    $this->view_data['current_page'] = 'latest';
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->view_data['stories'] = $this->story_model->get_published_recent_stories($this->pid, 0);
    $this->load_view('common/stories', $this->view_data);
  }

  function contact() {
    $this->load_model('category');
    $this->view_data['script_files'] = array('custom/publisher/contact/index.js');
    $this->view_data['current_page'] = 'contactus';
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->load_view('common/contact', $this->view_data);
  }

  function aboutus() {
    $this->load_model('story');
    $this->load_model('category');
    $this->load_model('user');
    $this->view_data['current_page'] = 'aboutus';
    $this->view_data['stories_count'] = $this->story_model->get_stories_count($this->pid, 0);
    $this->view_data['contributors'] = $this->publisher_model->get_active_contributors($this->pid);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    // $this->view_data['subscribers_count'] = $this->user_model->get_subscribers_count($uuid);
    $this->load_view('common/aboutus', $this->view_data);
  }

  function popular() {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['current_page'] = 'popular';
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->view_data['stories'] = $this->story_model->get_published_popular_stories($this->pid, 0);
    $this->load_view('common/stories', $this->view_data);
  }

  function contributors() {
    $this->load_model('category');
    $this->load_model('publisher');
    $this->view_data['current_page'] = 'contributors';
    $this->view_data['contributors'] = $this->publisher_model->get_active_contributors($this->pid);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->load_view('common/contributors', $this->view_data);
  }

  function channels() {
    $this->load_model('category');
    $this->view_data['current_page'] = 'channels';
    $this->view_data['channels'] = $this->category_model->get_channels($this->pid, 'az');
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->load_view('common/channels', $this->view_data);
  }

  function channel_view($slug) {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['current_page'] = 'channels';
    $channel = $this->category_model->get_one(array('slug' => $slug));
    $this->view_data['current_channel'] = $channel;
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->view_data['stories'] = $this->story_model->get_published_channel_stories($this->pid, 0, $channel['cid']);
    $this->load_view('common/stories', $this->view_data);
  }

  function hashtag_view($hash) {
    $this->load_model('category');
    $this->load_model('story');
    $this->load_model('publisher');
    $this->view_data['current_page'] = 'channels';
    $this->view_data['categories'] = $this->category_model->get_categories($this->pid, 0);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->view_data['stories'] = $this->story_model->get_stories_by_hashtag($this->pid, 0, $hash);
    $this->load_view('common/stories', $this->view_data);
  }
  
  function signup() {
    $this->load_model('category');
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
    $this->load_view('common/signup', $this->view_data); 
  }
} 