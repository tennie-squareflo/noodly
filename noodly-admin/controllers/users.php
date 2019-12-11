<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Users_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('user');
    $this->load_model('publisher');
    $this->load_model('match_user_role');
  }

  function index() {
    $view_data['script_files'] = array('custom/admin/users/list.js');
    $view_data['script_files'] = array('custom/admin/users/invite_user.js');
    $users = $this->user_model->get_users();
    $view_data['publishers'] = $this->publisher_model->get_list();

    foreach ($users as $key => $user) {
      $users[$key]['publishers'] = $this->match_user_role_model->get_related_publishers($user['uuid']);
    }

    $view_data['users'] = $users;
    $this->load_view('users/users', $view_data);
  }

  function edit($id = 0) {
    $view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $view_data['script_files'] = array('custom/admin/users/complete_profile.js');
    $view_data['user_id'] = intval($id);
    $view_data['user'] = $this->user_model->get_one(intval($id));
    $view_data['edit_user'] = true;
    if (intval($id) !== 0 && empty($view_data['user'])) {
      header("Location: ".BASE_URL."users/edit");
      return;
    }
    $view_data['publishers'] = $this->publisher_model->get_list();
    $this->load_view('users/edit_user', $view_data);
  }

  function action($action) {
    var_dump($action);
    var_dump($_POST);
    exit();

    $id = intval($_POST['id']);
    
    $this->load_helper('validation');
    switch ($action) {
      case 'delete':
        if ($this->user_model->delete($id))  {
          $this->response(array('code' => 0, 'message' => 'User deleted successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'User deletion failed!'), 500);
        }
        break;
      case 'invite': {
        $new_data = array(
          'firstname',
          'email',
          'role', 
        );
        if ($this->send_invitation($id)) {
          $this->response(array('code' => 0, 'message' => 'Invitation sent successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Invitation is not sent!'), 500);
        }
        break;
      }
    }
  }

  function send_invitation($id, $update = false) {
    $this->load_model('environment');

    $user = $this->user_model->get_one($id);
    $publisher = $this->publisher_model->get_one($user['pid']);
    $env = $this->environment_model->get_admin_env();

    $to = $user['email'];
    $from = $publisher['email'];
    $subject = 'Welcome to '.$publisher['domain'];

    $headers = "From: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $expiration_time = time() + (60 * $env['email_expiration_time']);

    $invite_token = array(
      'uuid' => $user['uuid'],
      'expiration_time' => $expiration_time
    );
    $this->user_model->update(array('status' => $expiration_time), $user['uuid']);

    $this->load_library('encryption', true);

    if (ENV === 'local') {
      $domain = $publisher['domain'] == '' 
                ? 'dev.noodly.com/admin' 
                : 'dev.noodly.com/'.$publisher['domain'];
      $server = 'dev.noodly.com';
    } else {
      $domain = $publisher['domain'] == '' ? 'noodly.io' : $publisher['domain'].'.noodly.io';
      $server = $domain;
    }
    
    $view_data['accept_url'] = $domain.'/accept/invitation/'.Encryption::encrypt($invite_token);
    $view_data['user'] = $user;
    $view_data['publisher'] = $publisher;
    $view_data['env'] = $env;
    $view_data['domain'] = $domain;
    $view_data['server'] = $server;

    $view_data['update'] = $update;

    $body = $this->single_load_view('email_template/invite_user', $view_data, true);
    
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => $to,
      'from' => $from,
      'subject' => $subject,
      'html' => $body,
    );
    
    if (sendgridMail($params)) {
      return true;
    } else {
      return false;
    }
  }
}
