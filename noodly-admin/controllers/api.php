<?php

class Api_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
  }

  public function avatar_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('avatar', ASSETS_PATH.'media/avatars/');
  }

  public function check_email() {
    $post = $_POST;
    $this->load_model('user');

    // check if email exists;
    $user = $this->user_model->get_one(array('email' => $post['email']));
    if (count($user) && isset($_POST['id']) && $_POST['id'] !== $user['uuid']) {
      $this->response(array('code' => 0, 'name' => $user['firstname']));
    } else {
      $this->response(array('code' => 1));
    }
  }

  public function send_message() {
    $this->load_model('user');
    $this->load_model('message');

    $admins = $this->user_model->get('uuid', array('role' => 'super_admin', 'status' => 1));

    $new_data = array(
      'admin_uuid' => 0,
      'firstname' => $_POST['firstname'],
      'lastname' => $_POST['lastname'],
      'email' => $_POST['contact-email'],
      'phone' => $_POST['contact-phone'],
      'message' => $_POST['contact-message'],
      'created_at' => date('Y-m-d H:i:s')
    );
    $subject = $_POST['firstname']." sent you a message - ".date('Y-m-d H:i:s');
    $link = '/messages';
    $view_data = array();
    $view_data['message'] = $_POST['contact-message'];

    try {
      foreach ($admins as $admin) {
        $new_data['admin_uuid'] = $admin['uuid'];
        $this->message_model->create($new_data);

        $this->send_email($admin['uuid'], 0, $subject, $link, 'send_message', $view_data);
      }      
      $this->response(array('status' => 'success', 'message' => 'Message is sent successfully!'), 200);
    } catch (Exception $e) {
      $this->response(array('status' => 'fail', 'message' => 'Message sending is failed. Please try again.'), 500);
    }
  }
}