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
      if ($user['role'] === 'super_admin') {
        $_SESSION['user'] = array(
          'uuid' => $user['uuid'],
          'name' => $user['firstname'],
          'avatar' => $user['avatar'],
          'role' => 'admin',
          'user_status' => (intval($user['status']) === 1),
          'role_status' => 1,
          'pid' => $pid
        );
        return true;
      }
      else {
        $role = $this->db->where(array('pid' => $pid, 'uuid' => $user['uuid']))->limit(1)->get('match_user_role', '*');

        if (count($role)) {
          if ($role['status'] > 1) {
            return 3;
          }
          $_SESSION['user'] = array(
            'uuid' => $user['uuid'],
            'name' => $user['firstname'],
            'avatar' => $user['avatar'],
            'role' => $role['role'],
            'role_status' => (intval($role['status']) === 1),
            'user_status' => (intval($user['status']) === 1),
            'pid' => $pid
          );
          return true;
        }
      }

      return 2;

    }

    return 1;   // user does not exist 1
  }

  function is_logged_in() {
    return isset($_SESSION['user']);
  }

  function is_profile_ready() {
    return isset($_SESSION['user']) && isset($_SESSION['user']['user_status']) && intval($_SESSION['user']['user_status']) === 1;
  }
}
