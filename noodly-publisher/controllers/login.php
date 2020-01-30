<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Login_Controller extends Auth_Controller {
	function __construct() {
		parent::__construct(true, true);
	}
	function index() {
		session_unset();
		$this->view_data['script_files'] = array(
			'custom/publisher/login/login.js'
		);
		$this->load_view('/admin/login',$this->view_data);
	}

	function login() {
		$this->load_model('auth');

		$email = $_POST['email'];
		$password = $_POST['password'];
    $res = $this->auth_model->login($email, $password, $this->publisher['pid']);
    if ($res === true) {
			$this->response(array('code' => true));
		} else {
			$this->response(array('code' => $res), 401);
		}
	}
}
