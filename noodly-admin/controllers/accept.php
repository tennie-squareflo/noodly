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
        'role' => $user['role'],
        'name' => $user['firstname'],
        'avatar' => $user['avatar'],
        'status' => (intval($user['status']) === 1)
      );
      header("Location: ".BASE_URL."my-account");
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
    $view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'custom/admin/users/complete_profile.js');
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
      'status' => 1,
      'facebookurl' => test_input($_POST['facebookurl']),
      'twitterurl' => test_input($_POST['twitterurl']),
      'instagramurl' => test_input($_POST['instagramurl']),
      'youtubeurl' => test_input($_POST['youtubeurl']),
      'vimeourl' => test_input($_POST['vimeourl']),
      'soundcloudurl' => test_input($_POST['soundcloudurl']),
      'websiteurl' => test_input($_POST['websiteurl']),
      'otherurl' => test_input($_POST['otherurl']),
      'role' => test_input(isset($_POST['role']) ? $_POST['role'] : ''),
      'shortbio' => test_input($_POST['shortbio'])
    );

    $role = isset($_POST['role']) ? $_POST['role'] : '';
    $proles = isset($_POST['prole']) ? $_POST['prole'] : array();

    $id = $_POST['id'];


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

    if ($id) {      // update
      $user = $this->user_model->get_one($id);
      if ($user['password'] != $_POST['password']) {
        $new_data['password'] = md5(test_input($_POST['password']));
      }
  
      //check validation
      if ($_POST['password'] != $_POST['confirm_password']) {
        $this->response(array('code' => 1, 'message' => 'Passwords do not match!'), 400);
        return;
      }
        
      //
      if ($this->user_model->update($new_data, $id) && $this->user_model->update_roles($id, $proles)) {
        if (intval($user['status']) === 1) {
          $this->response(array('code' => 0, 'message' => 'Profile Updated Successfully.', 'navigate' => false));
        }
        else {
          $this->load_model('publisher');
          $publisher = $this->publisher_model->get_one(0);
          $subject = 'Welcome to '.$publisher['domain'];
  
          if ($this->send_email($id, $pid, $subject, '', 'profile_complete', array())) {
            $this->response(array('code' => 0, 'message' => 'Thanks for updating your profile. Please check your inbox for a confirmation E-mail, with a button to sign in.', 'navigate' => false));
          } else {
            $this->response(array('code' => 1, 'message' => 'Confirmation E-mail is not sent, please try again.'), 500);
          }
        }
      } else {
        $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
      }
    } else {      // add user
      try {
        $new_data['email'] = $_POST['email'];
        $new_data['password'] = md5($_POST['password']);
        $id = $this->user_model->create($new_data);
        $this->user_model->update_roles($id, $proles);
        $this->response(array('code' => 0, 'message' => 'User Created Successfully', 'navigate' => false, 'id' => $id));
      } catch (Exception $e) {
        $this->response(array('code' => 1, 'message' => $e->getMessage(), 'navigate' => false), 500);
      }
    }
    
  }
}