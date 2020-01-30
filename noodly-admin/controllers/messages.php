<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Messages_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('message');
    $this->load_helper('string');
    $this->view_data['script_files'] = array('custom/common/message/list.js');
    $this->view_data['messages'] = $this->message_model->get('*', array('admin_uuid' => $_SESSION['user']['uuid']));
    $this->load_view('messages', $this->view_data);
  }

  function delete() {
    $ids = $_POST['selectedIds'];
    $this->load_model('message');
    try {
      $this->message_model->deleteRows($ids);
      $this->response(array('message' => 'Deleted successfully!'));
    } catch (Exception $e) {
      $this->response(array('message' => 'Message deletion failed.'), 500);
    }
  }
} 