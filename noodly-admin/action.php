<?php
  require_once('../common/initialize.php');

  $get = $_GET;
  $post = $_POST;
  $db = new Database($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);

  switch ($get['action']) {
    case 'login':
      login($post['email'], $post['password'], $db);
    break;
  }

  function login($email, $password, $db) {
    $res = $db->where('email', $email)->where('password', md5($password))->limit(1)->get('users');
    if ($res) {
      $_SESSION['isLoggedIn'] = true;
      $_SESSION['uuid'] = $res['uuid'];
      echo json_encode(true);
    } else {
      echo json_encode(false);
    }
  }
?>