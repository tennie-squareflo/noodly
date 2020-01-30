<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Settings_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('publisher');
    $this->load_model('environment');
  }

  function index() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js');
    $this->load_view('/admin/admin/settings', $this->view_data);
  }

  function admin_setting() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/no-ui-slider/nouislider.min.css');
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js', 'vendors/custom/no-ui-slider/nouislider.js');
    $this->view_data['publisher_id'] = $this->publisher['pid'];
    $this->view_data['pbulisher'] = $this->publisher_model->get_one(intval($this->view_data['publisher_id']));
    $this->view_data['admins'] = $this->environment_model->get_env(intval($this->view_data['publisher_id']));
    $this->load_view('/admin/admin/settings/admin', $this->view_data);
  }

  function email_setting() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js');
    $this->view_data['publisher_id'] = $this->publisher['pid'];
    $this->view_data['emails'] = $this->environment_model->get_env(intval($this->view_data['publisher_id']));
    $this->load_view('/admin/admin/settings/email', $this->view_data);
  }

  function website_setting() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js');
    $this->view_data['publisher_id'] = $this->publisher['pid'];
    $this->view_data['publisher'] = $this->publisher_model->get_one(intval($this->view_data['publisher_id']));
    $this->view_data['website'] = $this->environment_model->get_env(intval($this->view_data['publisher_id']));
    $this->load_view('/admin/admin/settings/website', $this->view_data);
  }

  function notifications_setting() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js');
    $this->view_data['publisher_id'] = $this->publisher['pid'];
    $this->view_data['notifications'] = $this->environment_model->get_env(intval($this->view_data['publisher_id']));
    $this->load_view('/admin/admin/settings/notifications', $this->view_data);
  }

  function about_setting() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/quill/quill.snow.css',);
    $this->view_data['script_files'] = array('custom/publisher/settings/settings.js', 'vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/quill/quill.min.js', 'vendors/custom/slim/slim.jquery.min.js');
    $this->view_data['publisher_id'] = $this->publisher['pid'];
    $this->view_data['aboutus'] = $this->environment_model->get_env(intval($this->view_data['publisher_id']));
    $this->load_view('/admin/admin/settings/about', $this->view_data);
  }

  function action($action) {
    $id = $this->publisher['pid'];
    
    $this->load_helper('validation');
    switch ($action) {
      case 'notifications': {
        $new_data = array(
          'email_invitation_subject' => test_input($_POST['invite_subject']),
          'email_invitation_title' => test_input($_POST['invite_heading']),
          'email_invitation_message' => test_input($_POST['invite_message']),
          'email_new_user_subject' => test_input($_POST['new_subject']),
          'email_new_user_title' => test_input($_POST['new_heading']),
          'email_new_user_message' => test_input($_POST['new_message'])
        );
        if ($this->environment_model->update_env($new_data, $id)) {
          $this->response(array('code' => 0, 'id' => $id, 'message' => 'Notifications updated successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
        }
        break;
      }
      case 'about': {
        $new_data = array(
          'about_content' => $_POST['content'],
          'about_image' => json_decode($_POST['imageurl'])->file,
          'about_video' => test_input($_POST['videourl'])
        );
        if ($this->environment_model->update_env($new_data, $id)) {
          $this->response(array('code' => 0, 'id' => $id, 'message' => 'Notifications updated successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
        }
        break;
      }
      case 'email': {
        $new_data = array(
          'email_logo' => json_decode($_POST['logo'])->file,
          'email_background_image' => json_decode($_POST['logo_back'])->file,
          'email_logo_size' => test_input($_POST['logo_size']),
          'email_background_color' => test_input($_POST['color_bg']),
          'email_heading_color' => test_input($_POST['color_heading']),
          'email_foreground_color' => test_input($_POST['color_text']),
          'email_button_color' => test_input($_POST['color_button']),
          'email_button_text_color' => test_input($_POST['color_button_text'])
        );
        if ($this->environment_model->update_env($new_data, $id)) {
          $this->response(array('code' => 0, 'id' => $id, 'message' => 'Notifications updated successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
        }
        break;
      }
      case 'website': {
        $new_data = array(
          'website_logo' => json_decode($_POST['logo'])->file,
          'website_logo_size' => test_input($_POST['logo_size']),
          'email_background_color' => test_input($_POST['color_bg']),
          'email_foreground_color' => test_input($_POST['color_text']),
        );
        if ($this->environment_model->update_env($new_data, $id)) {
          $this->response(array('code' => 0, 'id' => $id, 'message' => 'Notifications updated successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
        }
        break;
      }
      case 'admin': {
        $new_data = array(
          'admin_logo' => json_decode($_POST['logo'])->file,
          'admin_logo_size' => test_input($_POST['logo_size']),
          'admin_color_primary' => test_input($_POST['color_primary']),
          'admin_color_secondary' => test_input($_POST['color_secondary']),
        );
        if ($this->environment_model->update_env($new_data, $id)) {
          $this->response(array('code' => 0, 'id' => $id, 'message' => 'Notifications updated successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
        }
        break;
      }
      case 'edit': {
        $new_data = array(
          'name' => test_input($_POST['name']),
          'domain' => test_input($_POST['domain']),
          'logo' => !empty($_POST['logo']) ? json_decode($_POST['logo'])->file : '',
          'adminlogo' => !empty($_POST['adminlogo']) ? json_decode($_POST['adminlogo'])->file : '',
          'phonenumber' => test_input($_POST['phone']),
          'email' => test_input($_POST['email']),
          'country' => test_input($_POST['country']),
          'state' => test_input($_POST['state']),
          'address1' => test_input($_POST['address1']),
          'address2' => test_input($_POST['address2']),
          'city' => test_input($_POST['city']),
          'zipcode' => test_input($_POST['zipcode']),
          'facebookurl' => test_input($_POST['facebookurl']),
          'twitterurl' => test_input($_POST['twitterurl']),
          'instagramurl' => test_input($_POST['instagramurl'])
        );
        foreach($new_data as $key => $value) {
          if (empty($value) && $key !== 'address2') {
            $this->response(array('code' => 2, 'message' => lcfirst($key).' is required.'), 400);
            return;
          }
        }
        if (!test_domain($new_data['domain'])) {
          $this->response(array('code' => 2, 'message' => "Domain name \"$new_data[domain]\" is invalid."), 400);
          return;
        }
        if ($id === 0) { // create
          $new_id = $this->publisher_model->create($new_data);
          if ($new_id !== false) {
            $this->response(array('code' => 0, 'id' => $new_id, 'message' => 'Publisher created successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher creation failed!'), 500);
          }
        } else {
          if ($this->publisher_model->update($new_data, $id)) {
            $this->response(array('code' => 0, 'id' => $id, 'message' => 'Publisher updated successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
          }
        }
        break; 
      }
    }
  }

  function logo_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('logo', ASSETS_PATH.'media/logos/');
  }
  function bg_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('logo_back', ASSETS_PATH.'media/email_background/');
  }
  function admin_logo_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('adminlogo', ASSETS_PATH.'media/logos/');
  }
}
