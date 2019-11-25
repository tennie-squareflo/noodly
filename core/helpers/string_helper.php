<?php

function generate_random_string($charset = 'abcdefghijklmnopqrstuvwxyz0123456789', $length = 10) {
  $charactersLength = strlen($charset);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}