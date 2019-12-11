<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Dashboard_Controller extends Admin_Controller {
  function index() {
    $this->load_model('publisher');
    $this->load_model('user');
    $this->load_model('story');
    $this->load_model('match_user_role');

    // get 5 publishers
    $view_data['publishers'] = $this->publisher_model->get_publishers(array(), 5);
    // count all publishers
    $count['publishers'] = $this->publisher_model->count();
    // count all contributors
    $count['contributors'] = $this->match_user_role_model->count(array('role' => 'contributor'));
    // count all stories
    $count['stories'] = $this->story_model->count();

    $view_data['count'] = $count;
    
    $this->load_view('dashboard', $view_data);
  }
}
