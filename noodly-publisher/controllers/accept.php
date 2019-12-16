<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Accept_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function invitation($cypher) {
    $this->load_library('encryption', true);
    $this->load_model('match_user_role');
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
      $role = $this->match_user_role_model->get_one(array('pid' => $this->publisher['pid'], 'uuid' => $user['uuid']));

      if (count($role)) {
        if (intval($user['status']) === 1)  { // if the user has completed profile 
          $this->match_user_role_model->update(array('status' => 1), array('pid' => $this->publisher['pid'], 'uuid' => $user['uuid']));
          header("Location: ".BASE_URL."dashboard");
          return;
        } else {  // otherwise
          $_SESSION['user'] = array(
            'uuid' => $user['uuid'],
            'name' => $user['firstname'],
            'avatar' => $user['avatar'],
            'role' => $role['role'],
            'role_status' => (intval($role['status']) === 1),
            'user_status' => (intval($user['status']) === 1),
            'pid' => $this->publisher['pid']
          );
          header("Location: ".BASE_URL."accept/complete_profile");
          return;
        }
      } else {
        header("Location: ".BASE_URL."error/invalid_token");
        return;
      }
    }
  }

  function complete_profile()  {
    $this->load_model('user');
    if (empty($_SESSION['user'])) {
      header("Location: ".BASE_URL."error/invalid_token");
      return;
    }
    $user = $this->user_model->get_one($_SESSION['user']['uuid']);

    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/publisher/users/complete_profile.js');
    $this->view_data['user_id'] = intval($user['uuid']);
    $this->view_data['user'] = $user;
    $this->load_view('/admin/edit_user', $this->view_data);
  }

  function save_profile() {
    $this->load_model('user');
    $this->load_model('match_user_role');
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
    $role = $this->match_user_role_model->get_one(array('uuid' => $id, 'pid' => $this->publisher['pid']));
    if ($user['password'] != $_POST['password']) {
      $new_data['password'] = md5(test_input($_POST['password']));
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
    if ($this->user_model->update($new_data, $id) &&
      $this->match_user_role_model->update(array('status' => 1), array('uuid' => $id, 'pid' => $this->publisher['pid']))) {
      if (intval($role['status']) === 1) {
        $this->response(array('code' => 0, 'message' => 'Profile Updated Successfully.', 'navigate' => false));
      }
      else {
        $this->load_model('publisher');
        $this->load_model('environment');

        $user = $this->user_model->get_one($id);
        $publisher = $this->publisher_model->get_one($this->publisher['pid']);
        $env = $this->environment_model->get_env();

        $to = $user['email'];
        $from = $publisher['email'];
        $subject = 'Welcome to '.$publisher['domain'];

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
        
        $view_data['user'] = $user;
        $view_data['publisher'] = $publisher;
        $view_data['env'] = $env;
        $view_data['domain'] = $domain;
        $view_data['server'] = $server;

        $body = $this->single_load('/common/email_template/profile_complete', $view_data, true);
        
        // sene email via sendgrid
        $this->load_helper('sendgrid_mail');

        $params = array(
          'to' => $to,
          'from' => $from,
          'subject' => $subject,
          'html' => $body,
        );

        if (sendgridMail($params)) {
          $this->response(array('code' => 0, 'message' => 'Thanks for updating your profile. Please check your inbox for a confirmation E-mail, with a button to sign in.', 'navigate' => true));
        } else {
          $this->response(array('code' => 1, 'message' => 'Confirmation E-mail is not sent, please try again.'), 500);
        }
      }
    } else {
      $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
    }
  }

  function success() {
    echo 'success page';
  }
}