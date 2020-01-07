<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Users_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('user');
    $this->load_model('publisher');
    $this->load_model('match_user_role');

    $this->load_helper('string_helper');
  }

  function index() {
    $view_data['script_files'] = array('custom/admin/users/list.js', 'custom/admin/users/invite_user.js');
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
    $view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'custom/admin/users/complete_profile.js');
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

    
    $this->load_helper('validation');
    switch ($action) {
      case 'delete': {
        $id = intval($_POST['id']);
        if ($this->user_model->delete($id))  {
          $this->response(array('code' => 0, 'message' => 'User deleted successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'User deletion failed!'), 500);
        }
        break;
      }
      case 'invite': {
        $this->load_model('user');
        $post = $_POST;
        $new_user = false;
        $new_role = false;

        if (!isset($post['pid']) || $post['pid'] === '') {
          $post['pid'] = 0;
        }

        // check if user already exists.
        $user = $this->user_model->get_one(array('email' => $post['email']));
        
        if (count($user)) { // if user already exists
          // check if the user is a super admin
          if ($user['role'] === 'super_admin' && $post['role'] !== 'super_admin') {
            $this->response(array('code' => 2, 'message' => 'Can not send invitation to a super admin'), 400);
          }

          // check if the user already has a role in that publisher.
          if ($post['role'] !== 'super_admin') {
            $role = $this->user_model->get_role($user['uuid'], $post['pid']);
            if (!($role === false || $role['role'] === $post['role'])) {
              $this->response(array('code' => 2, 'message' => 'This user has already a different role in this publisher'), 500);
            }
          } else if ($user['role'] !== 'super_admin') {
            $this->response(array('code' => 2, 'message' => 'Can not invite this user as a super admin'), 500);
          }
        } else { // create a user
          $user = array(
            'email' => test_input($post['email']),
            'firstname' => test_input($post['firstname']),
            'role' => $post['role'] === 'super_admin' ? 'super_admin' : '',
            'status' => 0
          );
          $user['uuid'] = $this->user_model->create($user);
          $new_user = true;
          if ($user['uuid'] === false) {
            $this->response(array('code' => 3, 'message' => 'User creation failed, please try again.'), 500);
          }
        }

        // set role if publisher
        if ($post['role'] !== 'super_admin' 
            && $this->user_model->get_role($user['uuid'], $post['pid']) === false) {

          if (!($this->user_model->set_publisher_role($user['uuid'], $post['pid'], $post['role'])
              && $new_role = true)) {
            $this->response(array('code' => 3, 'message' => 'Role setting failed.'), 500);
          }
        }

        // send invitation
        //echo "Invited user($user[uuid]) to publisher($post[pid]) with role($post[role]): new user?(".($new_user?'true':'false').") new role? (".($new_role?'true':'false').") ";
        
        if ($this->send_invitation($user['uuid'], $post['pid'], $new_user, $new_role)) {
          if ($new_user === false && $new_role === false) {
            $message = 'Re Invitation is sent successfully';
          } else {
            $message = 'Invitation is sent successfully';
          }
          $this->response(array('code' => 0, 'message' => $message));
        } else {
          $this->response(array('code' => 1, 'message' => 'Email is not sent, please try again!'), 500);
        }

        break;
      }
      default:
      break;
    }
  }

  function send_invitation($id, $pid, $new_user, $new_role) {
    $this->load_model('environment');
    $this->load_helper('string');

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
    $view_data['role'] = $role;
    $view_data['new_user'] = $new_user;
    $view_data['new_role'] = $new_role;

    if ($this->send_email($id, $pid, $subject, $link, 'invite_user', $view_data)) {
      return true;
    } else {
      return false;
    }
  }
}
