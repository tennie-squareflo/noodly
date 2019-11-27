<?php

//define('ENV', 'production');
define('ENV', 'development');

// error reporting

switch (ENV)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

// core path
if (ENV === 'development') {
	define('BASE_PATH', '');
} else {
	define('BASE_PATH', 'noodly/');
}
define('CORE_PATH', BASE_PATH.'core'.DIRECTORY_SEPARATOR);
define('ADMIN_PATH', BASE_PATH.'noodly-admin'.DIRECTORY_SEPARATOR);
define('PUBLISHER_PATH', BASE_PATH.'noodly-publisher'.DIRECTORY_SEPARATOR);
define('ASSETS_PATH', DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR);
define('VIEW_PATH', 'views'.DIRECTORY_SEPARATOR);

// initialize
require_once(CORE_PATH.'session.php');
require_once(CORE_PATH.'constants.php');
require_once(CORE_PATH.'app.php');

// core modules
require_once(CORE_PATH.'models/core_model.php');
require_once(CORE_PATH.'controllers/core_controller.php');

// parse url
require_once(CORE_PATH.'routes.php');
require_once(CORE_PATH.'load_modules.php');
