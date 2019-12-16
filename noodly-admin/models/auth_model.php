<?php
class Auth_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  
  function login($email, $password) {
    // get user
    $user = $this->get_one(array('role' => 'super_admin', 'email' => $email, 'password' => md5($password)));
    if (count($user)) {
      $_SESSION['user'] = array(
        'uuid' => $user['uuid'],
        'role' => $user['role'],
        'name' => $user['firstname'],
        'avatar' => $user['avatar'],
        'status' => (intval($user['status']) === 1)    // if the profile is completed, `status` is 1, otherwise `status` is 0
      );
      return true;
    }

    return false;
  }

  function is_logged_in() {
    return isset($_SESSION['user']);
  }

  function is_profile_ready() {
    return isset($_SESSION['user']) && intval($_SESSION['user']['status']) === 1;
  }
}
