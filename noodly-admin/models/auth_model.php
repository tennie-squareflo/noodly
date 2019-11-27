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
        'name' => $res['firstname'].$res['lastname']
      );
      return true;
    }

    return false;
  }

  function is_logged_in() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'super_admin';
  }
}
