<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Subscriptions_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('subscription');
  }

  function index() {
    $this->view_data['script_files'] = array('custom/publisher/subscription/list.js');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $this->view_data['subscriptions'] = $this->subscription_model->get_subscription($this->pid);
      $this->load_view('/admin/admin/subscriptions', $this->view_data);
    } else {
      $this->view_data['subscriptions'] = $this->subscription_model->get_contributor_subscription($this->pid, $_SESSION['user']['uuid']);
      $this->load_view('/admin/contributor/subscriptions', $this->view_data);
    }
  }

  function action($type) {
    $post = $_POST;
    switch ($type) {
      case 'delete':
        $id = $post['id'];
        try {
          $this->subscription_model->delete($id);
          $this->response(array(
            'message' => "A Subscription Deleted Successfully!",
          ), 200);
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'delete_selected':
        $ids = $post['selectedIds'];
        // var_dump($id);exit;
        try {
          $this->subscription_model->deleteRows($ids);
          $this->response(array(
            'message' => "Subscriptions Deleted Successfully!",
          ), 200);
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
    }
  }
} 