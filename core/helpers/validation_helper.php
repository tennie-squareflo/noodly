<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function test_domain($string) {
  $matches = array();
  preg_match('/[A-Za-z0-9][A-Za-z0-9-]*[A-Za-z0-9]/', $string, $matches);
  return count($matches) === 1 && $string === $matches[0];
}