<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Accept_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function invitation($cypher) {
    $this->load_library('encryption', true);
    $token = Encryption::decrypt($cypher);
    if ($token == NULL || !is_array($token)) {
      header("Location: ".BASE_URL."error/invalid_token");
      return;
    }
    if ($token['expiration_time'] < time()) {
      header("Location: ".BASE_URL."error/expired");
      return;
    } else {
      $this->load_model('user');
      $user = $this->user_model->get_one($token['uuid']);
      $_SESSION['user'] = array(
        'uuid' => $user['uuid'],
        'pid' => $user['pid'],
        'role' => $user['role'],
        'name' => $user['firstname'].$user['lastname'],
        'status' => $user['status'] === 1
      );
      header("Location: ".BASE_URL."accept/complete_profile");
    }
  }

  function complete_profile()  {
    $this->load_model('user');
    if (empty($_SESSION['user'])) {
      header("Location: ".BASE_URL."error/invalid_token");
      return;
    }
    $user = $this->user_model->get_one($_SESSION['user']['uuid']);

    $view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $view_data['script_files'] = array('custom/admin/users/complete_profile.js');
    $view_data['user_id'] = intval($user['uuid']);
    $view_data['user'] = $user;
    $this->load_model('publisher');
    $view_data['publishers'] = $this->publisher_model->get_list();
    $this->load_view('users/edit_user', $view_data);
  }

  function save_profile() {
    $this->load_model('user');
    $this->load_helper('validation');

    $new_data = array(
      'firstname' => test_input($_POST['firstname']),
      'lastname' => test_input($_POST['lastname']),
      'phonenumber' => test_input($_POST['phonenumber']),
      'country' => test_input($_POST['country']),
      'state' => test_input($_POST['state']),
      'address1' => test_input($_POST['address1']),
      'address2' => test_input($_POST['address2']),
      'city' => test_input($_POST['city']),
      'zipcode' => test_input($_POST['zipcode']),
      'avatar' => !empty($_POST['avatar']) ? json_decode($_POST['avatar'])->file : '',
      'status' => 1
    );
    $id = $_SESSION['user']['uuid'];
    $user = $this->user_model->get_one($id);
    if ($user['password'] != $_POST['password']) {
      $new_data['password'] = test_input($_POST['password']);
    }

    //check validation
    if ($_POST['password'] != $_POST['confirm_password']) {
      $this->response(array('code' => 1, 'message' => 'Passwords do not match!'), 400);
      return;
    }

    $required_fields = array('firstname' => 'First Name', 
                            'password' => 'Password', 
                            'phonenumber'=>'Phone Number', 
                            'country' => 'Country',
                            'state' => 'State',
                            'address1' => 'Address',
                            'city' => 'City',
                            'zipcode' => 'ZipCode');

    foreach ($required_fields as $key => $value) {
      if (isset($new_data[$key]) && empty($new_data[$key])) {
        $this->response(array('code' => 1, 'message' => "$value is required!"), 400);
        return;
      }
    }
    
    //
    if ($this->user_model->update($new_data, $id)) {
      if (intval($user['status']) === 1) {
        $this->response(array('code' => 0, 'message' => 'Profile Updated Successfully.'));
      }
      else {
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

        $this->load_library('encryption', true);

        if (ENV === 'development') {
          $domain = $publisher['domain'] === 'noodly.io' 
                    ? 'dev.noodly.com/admin' 
                    : 'dev.noodly.com/'.substr($publisher['domain'], 0, -strlen('.noodly.io'));
        } else {
          $domain = $publisher['domain'];
        }
        
        $view_data['user'] = $user;
        $view_data['publisher'] = $publisher;
        $view_data['env'] = $env;
        $view_data['domain'] = $domain;

        $body = $this->single_load_view('email_template/profile_complete', $view_data, true);
        if (ENV === 'production') {
          if (mail($to, $subject, $body, $headers)) {
            $this->response(array('code' => 0, 'message' => 'Thanks for updating your profile. Please check your inbox for a confirmation E-mail, with a button to sign in.'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Confirmation E-mail is not sent, please try again.'), 500);
          }
        } else {
          var_dump($body);
        }
      }
    } else {
      $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
    }
  }
}