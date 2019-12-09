<?php
class Auth_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  function login($email, $password) {
    $res = $this->get_one(array('role' => 'super_admin', 'email' => $email, 'password' => md5($password)));
    if (count($res)) {
      $_SESSION['user'] = array(
        'uuid' => $res['uuid'],
        'pid' => $res['pid'],
        'role' => $res['role'],
        'name' => $res['firstname'].$res['lastname'],
        'avatar' => $res['avatar'],
        'status' => $res['status'] === 1
      );
      return true;
    }

    return false;
  }

  function is_logged_in() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'super_admin';
  }

  function is_profile_ready() {
    return isset($_SESSION['user']) && intval($_SESSION['user']['status']) === 1;
  }
}
