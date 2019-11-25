<?php
foreach ($_SERVER as $key => $value) {
  echo "$key $value<br/>";
}

$host_url = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];

$current_role = '';
$publisher_domain = '';

if (ENV === 'production') {
  $current_role = $host_url === 'noodly.io' || $host_url === 'www.noodly.io' ? 'admin' : 'publisher';
} else {
  $current_role = substr($request_uri, 0, 6) === '/admin' ? 'admin' : 'publisher';
  $publisher_domain = strstr(substr($request_uri, 1), '/', true);
  $request_uri = strstr(substr($request_uri, 1), '/');
}

echo "Current Role: $current_role<br/>";
echo "Request URI: $request_uri<br/>";
echo "Publisher domain: $publisher_domain<br/>";


?>