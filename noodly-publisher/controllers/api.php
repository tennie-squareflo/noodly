<?php

class Api_Controller extends Core_Controller {
  function __construct() {
    parent::__construct(PUBLISHER_DOMAIN);
  }

  public function avatar_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('avatar', ASSETS_PATH.'media/avatars/');
  }

  public function story_image_upload($type) {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload($type, ASSETS_PATH.'media/stories/');
  }

  public function section_image_upload($type) {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload($type, ASSETS_PATH.'media/sections/');
  }

  public function about_image_upload($type) {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload($type, ASSETS_PATH.'media/logos/');
  }

  public function check_email() {
    $post = $_POST;
    $this->load_model('user');

    // check if email exists;
    $user = $this->user_model->get_one(array('email' => $post['email']));
    if (count($user)) {
      $this->response(array('code' => 0, 'name' => $user['firstname']));
    } else {
      $this->response(array('code' => 1));
    }
  }

  public function check_story_url() {
    $post = $_POST;
    $this->load_model('story');
    
    $story = $this->story_model->get_one(array('url' => $post['url']));
    $this->response(array('code' => 0, 'exist' => count($story) !== 0 && $story['sid'] != $post['id']));
  }

  public function get_story_paragraph() {
    $id = $_POST['pid'];

    $this->load_model('paragraph');
    $paragraph = $this->paragraph_model->get_one($id);
    $this->response(array(
      'type' => $paragraph['type'],
      'content' => $paragraph['content'],
      'caption' => $paragraph['caption'],
      'nextPid' => $paragraph['next_pid']
    ));
  }

  // send messages to all super admins & publisher_admins
  public function send_message() {
    $this->load_model('publisher');
    $this->load_model('message');

    $admins = $this->publisher_model->get_admins($this->pid);

    $new_data = array(
      'admin_uuid' => 0,
      'firstname' => $_POST['firstname'],
      'lastname' => $_POST['lastname'],
      'email' => $_POST['email'],
      'phone' => $_POST['phone'],
      'message' => $_POST['message'],
      'created_at' => date('Y-m-d H:i:s')
    );

    try {
      foreach ($admins as $admin) {
        $new_data['admin_uuid'] = $admin['uuid'];
        $this->message_model->create($new_data);
      }      
      $this->response(array('status' => 'success', 'message' => 'Message is sent successfully!'), 200);
    } catch (Exception $e) {
      $this->response(array('status' => 'fail', 'message' => 'Message sending is failed. Please try again.'), 500);
    }
  }
}