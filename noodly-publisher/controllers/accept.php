<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Accept_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function story($cypher) {
    $this->load_library('encryption', true);
    $token = Encryption::decrypt($cypher);
    $pid = $this->pid;
    if ($token === NULL || !is_array($token)) {
      header("Location: ".BASE_URL."error/invalid_token");
      return;
    }
    if ($token['expiration_time'] < time()) {
      header("Location: ".BASE_URL."error/expired");
      return;
    } else {
      $this->load_model('user');
      $this->load_model('match_user_role');
      $user = $this->user_model->get_one($token['uuid']);
      $role = $this->match_user_role_model->get_one(array('pid' => $pid, 'uuid' => $user['uuid']));

      if (count($role)) {
        $_SESSION['user'] = array(
          'uuid' => $user['uuid'],
          'name' => $user['firstname'],
          'avatar' => $user['avatar'],
          'role' => $user['role'] === 'super_admin' ? 'admin' : $role['role'],
          'role_status' => (intval($role['status']) === 1),
          'user_status' => (intval($user['status']) === 1),
          'pid' => $pid
        );

        header("Location: ".BASE_URL."story/edit/".$token['sid']);
      } else {
        header("Location: ".BASE_URL."error/invalid_token");
        return;
      }
    }
  }

  function approve_story($cypher) {
    $this->load_library('encryption', true);
    $token = Encryption::decrypt($cypher);
    $pid = $this->pid;
    if ($token === NULL || !is_array($token)) {
      header("Location: ".BASE_URL."error/invalid_token");
      return;
    } else {
      $this->load_model('story');
      $story = $this->story_model->get_one(array('url' => $token['slug']));

      if ($story['clientid'] !== $token['client_id'] || $story['status'] !== 'CLIENT-DRAFT') {
        header("Location: ".BASE_URL."error/expired");
        return;
      }

      $_SESSION['client'] = array(
        'slug' => $token['slug'],
        'client_id' => $token['client_id'],
        'client_email' => $token['client_email']
      );
      header("Location: ".BASE_URL."story/".$token['slug']);
    }
  }

  function invitation($cypher) {
    $this->load_library('encryption', true);
    $this->load_model('match_user_role');
    $token = Encryption::decrypt($cypher);
    $pid = $this->pid;
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
      $role = $this->match_user_role_model->get_one(array('pid' => $pid, 'uuid' => $user['uuid']));

      if (count($role)) {
        $_SESSION['user'] = array(
          'uuid' => $user['uuid'],
          'name' => $user['firstname'],
          'avatar' => $user['avatar'],
          'role' => $user['role'] === 'super_admin' ? 'admin' : $role['role'],
          'role_status' => (intval($role['status']) === 1),
          'user_status' => (intval($user['status']) === 1),
          'pid' => $pid
        );
        if (intval($user['status']) === 1)  { // if the user has completed profile 
          $this->match_user_role_model->update(array('status' => 1), array('pid' => $pid, 'uuid' => $user['uuid']));
          header("Location: ".BASE_URL."dashboard");
          return;
        } else {  // otherwise
          header("Location: ".BASE_URL."my-account");
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
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/length-limit/length-limit.js', 'custom/publisher/users/complete_profile.js');
    $this->view_data['user_id'] = intval($user['uuid']);
    $this->view_data['user'] = $user;
    $this->load_view('/admin/edit_user', $this->view_data);
  }

  function save_profile() {
    $id = $_SESSION['user']['uuid'];
    $pid = $_SESSION['user']['pid'];

    $new_data = $this->check_vaidation();

    //
    if ($this->user_model->update($new_data, $id) &&
      $this->match_user_role_model->update(array('status' => 1), array('uuid' => $id, 'pid' => $pid))) {
      if (isset($_SESSION['user']['role_status']) && intval($_SESSION['user']['role_status']) === 1) {
        $this->response(array('code' => 0, 'message' => 'Profile Updated Successfully.', 'navigate' => false));
      }
      else {
        $this->load_model('publisher');
        $publisher = $this->publisher_model->get_one($pid);
        $subject = 'Welcome to '.$publisher['domain'];
        $link = '/login';

        if ($this->send_email($id, $pid, $subject, $link, 'profile_complete', array())) {
          $this->response(array('code' => 0, 'message' => 'Thanks for updating your profile. Please check your inbox for a confirmation E-mail, with a button to sign in.', 'navigate' => true));
        } else {
          $this->response(array('code' => 1, 'message' => 'Confirmation E-mail is not sent, please try again.'), 500);
        }
      }
    } else {
      $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
    }
  }

  function update_profile() {
    //
    $id = $_POST['id'];
    $pid = $_SESSION['user']['pid']; // $this->pid
    $new_data = $this->check_vaidation();

    if ($this->user_model->update($new_data, $id) &&
      $this->match_user_role_model->update(array('status' => 1), array('uuid' => $id, 'pid' => $pid))) {
      $this->response(array('code' => 0, 'message' => 'Profile Updated Successfully.', 'navigate' => false));
      /**/
    } else {
      $this->response(array('code' => 1, 'message' => 'User update failed!'), 500);
    }
  }

  function check_vaidation() {
    $this->load_model('user');
    $this->load_model('match_user_role');
    $this->load_helper('validation');

    $new_data = array(
      'firstname' => test_input($_POST['firstname']),
      'lastname' => test_input($_POST['lastname']),
      'shortbio' => test_input($_POST['shortbio']),
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
    );
    $id = $_POST['id'];
    $pid = $_SESSION['user']['pid']; // $this->pid
    $user = $this->user_model->get_one($id);
    $role = $this->match_user_role_model->get_one(array('uuid' => $id, 'pid' => $pid));
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

    return $new_data;
  }

  function success() {
    $this->single_load('success', $this->view_data);
  }
}