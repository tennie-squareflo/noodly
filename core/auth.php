<?php
require_once('models/auth_model.php');
$auth_model = new Auth_Model();
$user = $auth_model->auth();

$admin_no_auth = array('/login', '/error', '/action');
$other_no_auth = array();

$allowed = false;

if ($current_role === 'admin') {
  if ($user === null || $user['role'] != 'super_admin') { // false
    $allowed = false;
    foreach ($admin_no_auth as $url) {
      if (substr($request_uri, 0, strlen($url)) === $url) {
        $allowed = true;
        break;
      }
    }
  } else { // true
    $allowed = true;
  }
} else {
  if ($user === null) { // not logged in
    $allowed = false;
    foreach ($other_no_auth as $url) {
      if (substr($request_uri, 0, strlen($url)) === $url) {
        $allowed = true;
        break;
      }
    }
  } else { // true
    $allowed = true;
  }
}

?>