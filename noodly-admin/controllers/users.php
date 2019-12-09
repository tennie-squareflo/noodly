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
    $view_data['edit_user'] = true;
    if (intval($id) !== 0 && empty($view_data['user'])) {
      header("Location: ".BASE_URL."users/edit");
      return;
    }
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
          'pid' => test_input(empty($_POST['pid']) ? 0 : $_POST['pid']),
          'phonenumber' => test_input($_POST['phonenumber']),
          'email' => test_input($_POST['email']),
          'country' => test_input($_POST['country']),
          'state' => test_input($_POST['state']),
          'address1' => test_input($_POST['address1']),
          'address2' => test_input($_POST['address2']),
          'city' => test_input($_POST['city']),
          'zipcode' => test_input($_POST['zipcode']),
          'avatar' => !empty($_POST['avatar']) ? json_decode($_POST['avatar'])->file : '',
          'status' => 0
        );
        //check validation
        if (empty($new_data['firstname'])) {
          $this->response(array('code' => 1, 'message' => 'First Name is required!'), 400);
          return;
        }
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
        //
        if ($id === 0) { // create
          if ($_POST['password'] !== '') {
            $new_data['password'] = md5($_POST['password']);
          }
          $new_id = $this->user_model->create($new_data);
          if ($new_id !== false && $this->send_invitation($new_id)) {
            $this->response(array('code' => 0, 'id' => $new_id, 'message' => "User created successfully! Invitation Sent."));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher creation failed!'), 500);
          }
        } else {
          $user = $this->user_model->get_one($id);
          if ($user['password'] != $_POST['password']) {
            $new_data['password'] = md5(test_input($_POST['password']));
          }
          if ($this->user_model->update($new_data, $id) && $this->send_invitation($id, true)) {
            $this->response(array('code' => 0, 'id' => $id, 'message' => "User updated successfully!"));
          } else {
            $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
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
        if ($this->send_invitation($id)) {
          $this->response(array('code' => 0, 'message' => 'Invitation sent successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Invitation is not sent!'), 500);
        }
        break;
      }
    }
  }

  function avatar_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('avatar', ASSETS_PATH.'media/avatars/');
  }

  function send_invitation($id, $update = false) {
    $this->load_model('publisher');
    $this->load_model('environment');

    $user = $this->user_model->get_one($id);
    $publisher = $this->publisher_model->get_one($user['pid']);
    $env = $this->environment_model->get_admin_env();

    $to = $user['email'];
    $from = $publisher['email'];
    $subject = 'Welcome to '.$publisher['domain'];

    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $expiration_time = time() + (60 * $env['email_expiration_time']);

    $invite_token = array(
      'uuid' => $user['uuid'],
      'expiration_time' => $expiration_time
    );
    $this->user_model->update(array('status' => $expiration_time), $user['uuid']);

    $this->load_library('encryption', true);

    if (ENV === 'local') {
      $domain = $publisher['domain'] == '' 
                ? 'dev.noodly.com/admin' 
                : 'dev.noodly.com/'.$publisher['domain'];
      $server = 'dev.noodly.com';
    } else {
      $domain = $publisher['domain'] == '' ? 'noodly.io' : $publisher['domain'].'.noodly.io';
      $server = $domain;
    }
    
    $view_data['accept_url'] = $domain.'/accept/invitation/'.Encryption::encrypt($invite_token);
    $view_data['user'] = $user;
    $view_data['publisher'] = $publisher;
    $view_data['env'] = $env;
    $view_data['domain'] = $domain;
    $view_data['server'] = $server;

    $view_data['update'] = $update;

    $body = $this->single_load_view('email_template/invite_user', $view_data, true);
    
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => $to,
      'from' => $from,
      'subject' => $subject,
      'html' => $body,
    );
    var_dump($body);
    if (sendgridMail($params)) {
      return true;
    } else {
      return false;
    }
  }
}
