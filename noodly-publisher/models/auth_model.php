<?php
class Auth_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  
  /**
   * true - login success
   * 1 - user does not exist
   * 2 - user have no role to this publisher
   * 3 - user have not accepted the invitation.
   */
  function login($email, $password, $pid) {
    // get user
    $user = $this->get_one(array('email' => $email, 'password' => md5($password)));
    if (count($user)) {
      $role = $this->db->where(array('pid' => $pid, 'uuid' => $user['uuid']))->limit(1)->select('match_user_role', '*');

      if (count($role)) {
        if ($role['status'] > 1) {
          return 3;
        }
        $_SESSION['user'] = array(
          'uuid' => $user['uuid'],
          'name' => $res['firstname'],
          'avatar' => $res['avatar'],
          'status' => (intval($res['status']) === 1),
          'pid' => $pid
        );
        return true;
      }

      return 2;

    }

    return 1;   // user does not exist 1
  }

  function is_logged_in() {
    return isset($_SESSION['user']);
  }

  function is_profile_ready() {
    return isset($_SESSION['user']) && intval($_SESSION['user']['status']) === 1;
  }
}
