<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Publishers_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('publisher');
  }

  function action($action) {
    $id = intval($_POST['id']);
    
    $this->load_helper('validation');
    switch ($action) {
      case 'edit': {
        $new_data = array(
          'name' => test_input($_POST['name']),
          'domain' => test_input(empty($_POST['domain']) ? '' : $_POST['domain']),
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
        
        if ($new_data['domain'] && !test_domain($new_data['domain'])) {
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
        } else if ($id === -1) { // admin update
          if ($this->publisher_model->update($new_data, 0)) {
            $this->response(array('code' => 0, 'id' => 0, 'message' => 'Publisher updated successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
          }
        }
        else {
          if ($this->publisher_model->update($new_data, $id)) {
            $this->response(array('code' => 0, 'id' => $id, 'message' => 'Publisher updated successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
          }
        }
        break; 
      }
      case 'delete':
        if ($this->publisher_model->delete($id))  {
          $this->response(array('code' => 0, 'message' => 'Publisher deleted successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher deletion failed!'), 500);
        }
        break;
    }
  }

  function logo_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('logo', ASSETS_PATH.'media/logos/');
  }
  function admin_logo_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('adminlogo', ASSETS_PATH.'media/logos/');
  }
  function favicon_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('favicon', ASSETS_PATH.'media/logos/');
  }
}
