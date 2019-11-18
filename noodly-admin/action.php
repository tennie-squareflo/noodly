<?php
  require_once('../common/initialize.php');

  $get = $_GET;
  $post = $_POST;

  switch ($get['action']) {
    case 'login':
      login($post['email'], $post['password'], $db);
    break;
    case 'publish_register':
      publish_register($post, $db);
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

  function publish_register($data, $db) {
    $new_data = array(
      'name' => $data['name'],
      'domain' => $data['domain'],
      'logo' => json_decode($data['logo'])->file,
      'phonenumber' => $data['phone'],
      'email' => $data['email'],
      'country' => $data['country'],
      'state' => $data['state'],
      'address1' => $data['address1'],
      'address2' => $data['address2'],
      'city' => $data['city'],
      'zipcode' => $data['zipcode']
    );

    if ($data['id']) {  //update
      if ($db->where('pid', $data['id'])->update('publishers', $new_data)) {
        echo json_encode(array('code' => 0, 'id' => $data['id'], 'message' => 'Update succeeded!'));
      } else {
        echo json_encode(array('code' => 1, 'message' => 'Update failed!'));
      }
    } else {  //create
      if ($db->insert('publishers', $new_data)) {
        echo json_encode(array('code' => 0, 'id' => $db->insert_id(), 'message' => 'Create succeeded!'));
      } else {
        echo json_encode(array('code' => 1, 'message' => 'Create failed!'));
      }
    }
  }
?>