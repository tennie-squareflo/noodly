<?php
foreach ($_SERVER as $key => $value) {
  echo "$key $value<br/>";
}

$host_url = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];

$current_role = '';
if (ENV === 'production') {
  $current_role = $host_url === 'noodly.io' || $host_url === 'www.noodly.io' ? 'admin' : 'publisher';
} else {
  $current_role = substr($request_uri, 0, 6) === '/admin' ? 'admin' : 'publisher';
  $request_uri = substr($request_uri, strlen($current_role));
}

echo "Current Role: $current_role<br/>";
echo "Request URI: $request_uri<br/>";


?>