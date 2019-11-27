<?php
// if (!file_exists($base_path.'controllers'.$request_uri.'.php')) {
//   require_once($base_path.'controllers/error.php');
//   $error = new Error_Controller();
//   $error->error404();
//   exit();
// }

// require_once($base_path.'controllers'.$request_uri.'.php');
// $class_name = substr(strrchr($request_uri, '/'), 1).'_Controller';
// $controller_class = new $class_name();
// $handler = isset($_SERVER['HTTP_HANDLER']) ? $_SERVER['HTTP_HANDLER'] : 'index';
// $controller_class->$handler();

$path = '';
$func_name = '';
$class_name = '';
$args = array();
do {
  $request_uri = substr($request_uri, 1);
  if (strpos($request_uri, DIRECTORY_SEPARATOR) === false) {
    $request_uri = $request_uri.DIRECTORY_SEPARATOR;
  }
  $class_name = strstr($request_uri, DIRECTORY_SEPARATOR, true);
  $path .= DIRECTORY_SEPARATOR.$class_name;
  $request_uri = strstr($request_uri, DIRECTORY_SEPARATOR);

  if (file_exists($base_path.'controllers'.$path.'.php')) {
    break;
  }
  if (file_exists($base_path.'controllers'.$path.'/index.php')) {
    $path = $path.'/index';
    $class_name = 'index';
    break;
  }
} while ($request_uri !== '/');
if (file_exists($base_path.'controllers'.$path.'.php')) {
  require_once($base_path.'controllers'.$path.'.php');
  $class_name .= '_controller';
  $request_uri = substr($request_uri, 1);
  $controller_class = new $class_name();
  $args = $request_uri ? explode(DIRECTORY_SEPARATOR, $request_uri) : array();
  if (count($args) > 0 && method_exists($controller_class, $args[0]) && is_callable(array($controller_class, $args[0]))) {
    $func_name = $args[0];
    array_shift($args);
  } else {
    $func_name ='index';
  }
  call_user_func_array(array($controller_class, $func_name), $args);
} else {
  require_once($base_path.'controllers/error.php');
  $error = new Error_Controller();
  $error->error404();
  exit();
}
