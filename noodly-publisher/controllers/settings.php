<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Settings_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('environment');
  }

  function index() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/common/settings/settings.js');
    $this->load_view('/admin/admin/settings/settings', $this->view_data);
  }

  function publisher() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/common/settings/publisher.js');
    $this->load_view('/admin/admin/settings/publisher', $this->view_data);
  }

  function logo() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'custom/common/settings/logo.js');
    $this->load_view('/admin/admin/settings/logo', $this->view_data);
  }
  
  function website() {
    $this->view_data['script_files'] = array('custom/common/settings/website.js');
    $this->load_view('/admin/admin/settings/website', $this->view_data);
  }
  function notification() {
    $this->view_data['script_files'] = array('custom/common/settings/notification.js');
    $this->load_view('/admin/admin/settings/notification', $this->view_data);
  }
  function about() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/quill/quill.snow.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/quill/quill.min.js', 'custom/common/settings/about.js');
    $this->load_view('/admin/admin/settings/about', $this->view_data);
  }

  function about_image_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('about_image', ASSETS_PATH.'media/images/');
  }

  function edit() {
    try {
      if (!empty($_POST['about_image'])) {
        $_POST['about_image'] = json_decode($_POST['about_image'])->file;
      }
      if (!empty($_POST['light_back_logo'])) {
        $_POST['light_back_logo'] = json_decode($_POST['light_back_logo'])->file;
      }
      if (!empty($_POST['dark_back_logo'])) {
        $_POST['dark_back_logo'] = json_decode($_POST['dark_back_logo'])->file;
      }
      if (!empty($_POST['favicon'])) {
        $_POST['favicon'] = json_decode($_POST['favicon'])->file;
      }
      $this->environment_model->update_env($_POST, $this->pid);
      $this->response(array('message' => 'Settings updated successfully!'));
    } catch(Exception $e) {
      $this->response(array('message' => 'Error occured! Please try again.'), 500);
    }
  }

  function email_background_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('email_background_image', ASSETS_PATH.'media/email_background/');
  }



  function logo_upload($type) {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload($type, ASSETS_PATH.'media/logos/');
  }
}
