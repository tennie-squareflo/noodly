<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Settings_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('environment');
  }

  function index() {
    $view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $view_data['script_files'] = array('custom/admin/settings/settings.js');
    $view_data['_env'] = $this->environment_model->get_env();
    $this->load_view('settings/settings', $view_data);
  }

  function edit() {
    $new_data = array(
      'email_expiration_time' => $_POST['email_expiration_time'],
      'email_background_color' => $_POST['email_background_color'],
      'email_foreground_color' => $_POST['email_foreground_color'],
      'email_background_image' => !empty($_POST['email_background_image']) ? json_decode($_POST['email_background_image'])->file : '',
    );
    if ($this->environment_model->update_env($new_data)) {
      $this->response(array('code' => 0, 'message' => 'Settings updated successfully!'));
    } else {
      $this->response(array('code' => 1, 'message' => 'Settings update failed!'), 500);
    }
  }

  function email_background_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('email_background_image', ASSETS_PATH.'media/email_background/');
  }
}
