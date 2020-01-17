<?php

function generate_random_string($length = 10, $charset = 'abcdefghijklmnopqrstuvwxyz0123456789') {
  $charactersLength = strlen($charset);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function get_user_types($role, $article = false) {
  switch ($role) {
    case 'super_admin':
      return $article ? 'a Super Admin' : 'Super Admin';
    case 'admin':
      return $article ? 'an Admin' : 'Admin';
    case 'contributor':
      return $article ? 'a Contributor' : 'Contributor';
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

function display_date($mydate) {
  $months = ['01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
  $mm = date("m", strtotime($mydate));
  $mm_str = $months[$mm];
  $yy = date("Y", strtotime($mydate));
  $dd = date("d", strtotime($mydate));
  return $mm_str.' '.$dd.', '.$yy;
}

function time_diff_format($str_time) {
  $now = time();
  $time = $now - strtotime($str_time);

  if ($time < 60) {
    return $time." sec".($time === 1 ? "" : "s")." ago";
  } else if ($time < 60 * 60) {
    return round($time / 60)." min".(round($time / 60) === 1 ? "" : "s")." ago";
  } else if ($time < 60 * 60 * 24) {
    return round($time / 60 / 60)." hr".(round($time / 60 / 60) === 1 ? "" : "s")." ago";
  } else if ($time < 60 * 60 * 24 * 30) {
    return round($time / 60 / 60 / 24)." day".(round($time / 60 / 60 / 24) === 1 ? "" : "s")." ago";
  } else {
    return date('Y-m-d', strtotime($str_time));
  }
}