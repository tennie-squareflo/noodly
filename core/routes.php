<?php
$host_url = $_SERVER['HTTP_HOST'];
$request_uri = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '/login';

$current_role = '';
$publisher_domain = '';

if (substr($request_uri, -4) === '.php') {
  $request_uri = substr($request_uri, 0, strlen($request_uri) - 4);
}

if (ENV === 'production') {
  $current_role = $host_url === 'noodly.io' || $host_url === 'www.noodly.io' ? 'admin' : 'publisher';
  $publisher_domain = strstr($host_url, '.', true);
} else {
  $current_role = substr($request_uri, 1, 5) === 'admin' ? 'admin' : 'publisher';
  $publisher_domain = strstr(substr($request_uri, 1), DIRECTORY_SEPARATOR, true);
  $request_uri = strstr(substr($request_uri, 1), DIRECTORY_SEPARATOR);
}
$base_path =  $current_role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH;
?>