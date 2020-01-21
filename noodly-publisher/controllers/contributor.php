<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Contributor_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('publisher');
    $this->view_data['script_files'] = array('custom/publisher/contributors/invite_contributor.js', 'custom/publisher/contributors/list.js');
    $this->view_data['style_files'] = array('custom/publisher/contributors/list.css');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['contributors'] = $this->publisher_model->get_contributors($pid);
      $this->load_view('/admin/admin/contributors', $this->view_data);
    } else {    // contributor
      header("Location: ".BASE_URL."error/access_denied");
    }
  }

  function invite() {
    $this->load_helper('validation');
    $this->load_model('user');
    $post = $_POST;
    $new_user = false;
    $new_role = false;

    $user = $this->user_model->get_one(array('email' => $post['email']));
    $pid = $_SESSION['user']['pid'];
    if (count($user)) {
      if ($user['role'] === 'super_admin') {
        $this->response(array('code' => 2, 'message' => 'Can not send invitation to super admin'), 400);
      }

      $role = $this->user_model->get_role($user['uuid'], $pid);
      if (!($role === false || $role['role'] === 'contributor')) {
        $this->response(array('code' => 2, 'message' => 'This user has already a different role in this publisher'), 500);
      }
    } else {
      $user = array(
        'email' => test_input($post['email']),
        'firstname' => test_input($post['firstname']),
        'role' => '',
        'status' => 0
      );
      $user['uuid'] = $this->user_model->create($user);
      $new_user = true;
      if ($user['uuid'] === false) {
        $this->response(array('code' => 3, 'message' => 'User creation failed, please try again.'), 500);
      }
    }

    if ($this->user_model->get_role($user['uuid'], $pid) === false) {
      if (!($this->user_model->set_publisher_role($user['uuid'], $pid, 'contributor')
        && $new_role = true)) {
        $this->response(array('code' => 3, 'message' => 'Role setting failed.'), 500);
      }
    }

    if ($this->send_invitation($user['uuid'], $pid, $new_user, $new_role)) {
      if ($new_user === false && $new_role === false) {
        $message = 'Re Invitation is sent successfully';
      } else {
        $message = 'Invitation is sent successfully';
      }
      $this->response(array('code' => 0, 'message' => $message));
    } else {
      $this->response(array('code' => 1, 'message' => 'Email is not sent, please try again!'), 500);
    }
  }

  function send_invitation($id, $pid, $new_user, $new_role) {
    $this->load_model('environment');

    $user = $this->user_model->get_one($id);
    $publisher = $this->publisher_model->get_one($pid);
    $env = $this->environment_model->get_env();
    $role = $this->user_model->get_role($id, $pid);

    if ($pid != 0) {
      $subject = 'Invitation to join '.$publisher['name'].' as '.get_user_types($role['role'], true);
    } else {
      $subject = 'Invitation to join '.$publisher['name'].' as a Super Admin';
    }

    $expiration_time = time() + (60 * $env['email_expiration_time']);

    $invite_token = array(
      'uuid' => $user['uuid'],
      'expiration_time' => $expiration_time
    );
    $this->user_model->update_role(array('status' => $expiration_time), $id, $pid);
    if ($user['status'] == 0) {
      $this->user_model->update(array('status' => $expiration_time), $id);
    }

    $this->load_library('encryption', true);

    $link = '/accept/invitation/'.Encryption::encrypt($invite_token);
    
    $view_data['new_user'] = $new_user;
    $view_data['new_role'] = $new_role;
    $view_data['role'] = $role['role'];

    return $this->send_email($id, $pid, $subject, $link, 'invite_user', $view_data);
  }

  function action($action) {
    $id = $_POST['id'];
    $pid = $_SESSION['user']['pid'];
    $this->load_model('user');
    $this->load_model('publisher');
    $publisher = $this->publisher_model->get_one($pid);
    switch ($action) {
      case 'invite':
        if ($this->send_invitation($id, $pid, false, false)) {
          $this->response(array('code' => 0, 'message' => 'Reinvitation is sent successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Email is not sent. Please try again.'), 400);
        }
      break;
      case 'block':
        if ($this->user_model->block_user_role($id, $pid)) {
          $text['title'] = 'Your '.$publisher['name'].' Account has been suspended';
          $text['message'] = 'We are sorry to inform you that your '.$publisher['name'].' account has been suspended. Please contact the administrator.';
          $view_data['text'] = $text;
          $this->send_email($id, $pid, 'Your '.$publisher['name'].' Account Blocked', '', 'user_state_change', $view_data);
          $this->response(array('code' => 0, 'message' => 'The role is blocked successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Something went wrong. Please try again.'), 400);
        }
      break;
      case 'admin':
        if ($this->user_model->update_role(array('role' => 'admin'), $id, $pid)) {
          $text['title'] = 'Your '.$publisher['name'].' Account Role has been changed';
          $text['message'] = 'Your '.$publisher['name'].' account has been changed, please log in and check your role';
          $view_data['text'] = $text;
          $this->send_email($id, $pid, 'Your '.$publisher['name'].' Account Blocked', '', 'user_state_change', $view_data);
          $this->response(array('code' => 0, 'message' => 'The role is changed successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Something went wrong. Please try again.'), 400);
        }
      break;
      case 'delete':
        if ($this->user_model->delete_user_role($id, $pid)) {
          $text['title'] = 'Your '.$publisher['name'].' Account has been removed';
          $text['message'] = 'We are sorry to inform you that your '.$publisher['name'].' account has been removed. Please contact the administrator.';
          $view_data['text'] = $text;
          $this->send_email($id, $pid, 'Your '.$publisher['name'].' Account Removed', '', 'user_state_change', $view_data);
          $this->response(array('code' => 0, 'message' => 'The role is removed successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Something went wrong. Please try again.'), 400);
        }
      break;
      case 'activate':
        if ($this->user_model->activate_user_role($id, $pid)) {
          $text['title'] = 'Your '.$publisher['name'].' Account has been Activated';
          $text['message'] = 'We are sorry to inform you that your '.$publisher['name'].' account has been activated. Please contact the administrator if needed.';
          $view_data['text'] = $text;
          $this->send_email($id, $pid, 'Your '.$publisher['name'].' Account Activated', '', 'user_state_change', $view_data);
          $this->response(array('code' => 0, 'message' => 'The role is activated successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Something went wrong. Please try again.'), 400);
        }
      break;
      case 'block_selected':
        if ($this->user_model->block_user_role($id, $pid)) {
          $text['title'] = 'Your '.$publisher['name'].' Account has been suspended';
          $text['message'] = 'We are sorry to inform you that your '.$publisher['name'].' account has been suspended. Please contact the administrator.';
          $view_data['text'] = $text;
          foreach ($id as $con_id) {
            $this->send_email($con_id, $pid, 'Your '.$publisher['name'].' Account Blocked', '', 'user_state_change', $view_data);
          }
          $this->response(array('code' => 0, 'message' => 'The role is blocked successfully.'));
        } else {
          $this->response(array('code' => 2, 'message' => 'Something went wrong. Please try again.'), 400);
        }
      break;
    }
  }

  function edit($id = 0) {
    $this->load_model('user');

    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'custom/admin/users/edit_users.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'custom/publisher/users/edit_user.js');
    $this->view_data['user_id'] = intval($id);
    $this->view_data['user'] = $this->user_model->get_one(intval($id));
    $this->view_data['edit_user'] = true;
    $this->load_view('/admin/edit_user', $this->view_data);
  }
} 