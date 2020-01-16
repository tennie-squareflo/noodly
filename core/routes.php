<?php
$host_url = $_SERVER['HTTP_HOST'];
$request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'].'/' : '/';

$current_role = '';
$publisher_domain = '';

$request_uri = str_replace('..', '', $request_uri);
$request_uri = str_replace('//', '/', $request_uri);

foreach ($ROUTING as $key => $value) {
  $request_uri = str_replace($key, $value, $request_uri);
}

if (substr($request_uri, -4) === '.php') {
  $request_uri = substr($request_uri, 0, strlen($request_uri) - 4);
}

if (ENV === 'server') {
  $current_role = $host_url === 'noodly.io' || $host_url === 'www.noodly.io' ? 'admin' : 'publisher';
  $publisher_domain = strstr($host_url, '.', true);
} else {
  $current_role = substr($request_uri, 1, 5) === 'admin' ? 'admin' : 'publisher';
  $publisher_domain = strstr(substr($request_uri, 1), DIRECTORY_SEPARATOR, true);
  $request_uri = strstr(substr($request_uri, 1), DIRECTORY_SEPARATOR);
}
$base_path =  $current_role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH;

if (ENV == 'local') {
  if ($current_role === 'admin') {
    define('BASE_URL', '/admin/');
  } else {
    define('BASE_URL', '/'.$publisher_domain.'/');
  }
} else {
  define('BASE_URL', '/');
}

define('PUBLISHER_DOMAIN', $publisher_domain);