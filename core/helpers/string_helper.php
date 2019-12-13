<?php

function generate_random_string($charset = 'abcdefghijklmnopqrstuvwxyz0123456789', $length = 10) {
  $charactersLength = strlen($charset);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function get_user_types($role) {
  switch ($role) {
    case 'super_admin':
      return 'Super Admin';
    case 'admin':
      return 'Publisher Admin';
    case 'contributor':
      return 'Contributor';
  }
  return '';
}