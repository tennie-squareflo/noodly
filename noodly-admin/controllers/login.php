<?php
class Login_Controller extends Core_Controller {
	function __construct() {
		parent::__construct('admin');
	}
	function index() {
		session_unset();
		$vars['script_files'] = array(
			'custom/admin/login/login.js'
		);
		$this->load_view('layout/html_header', $vars);
		$this->load_view('login',$vars);
		$this->load_view('layout/footer', $vars);
	}
	function login() {
		$this->load_model('auth');

		$email = $_POST['email'];
		$password = $_POST['password'];
    
    if ($this->auth_model->login($email, $password)) {
			$this->response(array('code' => true));
		} else {
			$this->response(array('code' => false), 401);
		}
	}
}
