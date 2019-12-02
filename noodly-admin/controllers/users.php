<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Users_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('user');
  }

  function index() {
    $view_data['script_files'] = array('custom/admin/users/list.js');
    $view_data['users'] = $this->user_model->get_users();
    $this->load_view('users/users', $view_data);
  }

  function edit($id = 0) {
    $view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $view_data['script_files'] = array('custom/admin/users/register.js');
    $view_data['user_id'] = intval($id);
    $view_data['user'] = $this->user_model->get_one(intval($id));
    $this->load_model('publisher');
    $view_data['publishers'] = $this->publisher_model->get_list();
    $this->load_view('users/edit_user', $view_data);
  }

  function action($action) {
    $id = intval($_POST['id']);
    
    $this->load_helper('validation');
    switch ($action) {
      case 'edit': {
        $new_data = array(
          'firstname' => test_input($_POST['firstname']),
          'lastname' => test_input($_POST['lastname']),
          'role' => test_input($_POST['role']),
          'pid' => test_input($_POST['pid']),
          'phonenumber' => test_input($_POST['phonenumber']),
          'email' => test_input($_POST['email']),
          'country' => test_input($_POST['country']),
          'state' => test_input($_POST['state']),
          'address1' => test_input($_POST['address1']),
          'address2' => test_input($_POST['address2']),
          'city' => test_input($_POST['city']),
          'zipcode' => test_input($_POST['zipcode'])
        );
        //check validation
        if (empty($new_data['email'])) {
          $this->response(array('code' => 1, 'message' => 'Email is required!'), 400);
          return;
        }
        if (empty($new_data['role'])) {
          $this->response(array('code' => 1, 'message' => 'Role is required!'), 400);
          return;
        }
        if ($new_data['role'] !== 'super_admin' && empty($new_data['pid'])) {
          $this->response(array('code' => 1, 'message' => 'Publisher is required!'), 400);
          return;
        }

        if (empty($new_data['pid'])) {
          $new_data['pid'] = 0;
        }

        if (empty($new_data['firstname']) || 
            empty($new_data['lastname']) || 
            empty($new_data['phonenumber']) || 
            empty($new_data['country']) || 
            empty($new_data['state']) || 
            empty($new_data['address1']) || 
            empty($new_data['city']) || 
            empty($new_data['zipcode'])) {
              $new_data['profile_ready'] = 0;
            }
        $message = $new_data['profile_ready'] === 0 ? "<br/>Profile is not completed! Please send invitation to complete profile." : "";
        //
        if ($id === 0) { // create
          $new_id = $this->user_model->create($new_data);
          if ($new_id !== false) {
            $this->response(array('code' => 0, 'id' => $new_id, 'message' => "User created successfully!$message"));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher creation failed!'), 500);
          }
        } else {
          if ($this->user_model->update($new_data, $id)) {
            $this->response(array('code' => 0, 'id' => $id, 'message' => "User updated successfully!$message"));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
          }
        }
        break; 
      }
      case 'delete':
        if ($this->user_model->delete($id))  {
          $this->response(array('code' => 0, 'message' => 'User deleted successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'User deletion failed!'), 500);
        }
        break;
      case 'invite': {
        $user = $this->user_model->get_one($id);

        if (mail($user['email'], 'From Noodly', 'Click here to go noodly.io !')) {
          $this->response(array('code' => 0, 'message' => 'Invitation sent successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Invitation is not sent!'), 500);
        }
        break;
      }
    }
  }

  // function logo_upload() {
  //   $this->load_library('slim_image_uploader');
  //   $this->slim_image_uploader->image_upload('logo', ASSETS_PATH.'media/logos/');
  // }
}
