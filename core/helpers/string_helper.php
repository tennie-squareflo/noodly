<?php

function generate_random_string($length = 10, $charset = 'abcdefghijklmnopqrstuvwxyz0123456789') {
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

function number_k($number) {
  $units = ['', 'K', 'M', 'G', 'T'];
  $number = intval($number);
  $selected_unit = 0;
  if ($number === 0) {
    return '--';
  }
  while ($number > 100) {
    $number /= 1000;
    $selected_unit ++;
  }
  return round($number, 2).' '.$units[$selected_unit];
}

function time_diff_format($str_time) {
  $now = time();
  $time = $now - strtotime($str_time);

  if ($time < 60) {
    return $time." second(s) ago";
  } else if ($time < 60 * 60) {
    return round($time / 60)." minute(s) ago";
  } else if ($time < 60 * 60 * 24) {
    return round($time / 60 / 60)." hour(s) ago";
  } else if ($time < 60 * 60 * 24 * 30) {
    return round($time / 60 / 60 / 24)." day(s) ago";
  } else {
    return date('Y-m-d', strtotime($str_time));
  }
}