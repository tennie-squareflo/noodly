<?php
include_once('../common/initialize.php');

function get_session_value($name) {
  return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}

function is_logged() {
  if (get_session_value('isLoggedIn') === true) {
    return true;
  }
  return false;
}

function redirect_not_logged() {
  if (!is_logged()) {
    header('Location: login.php');
  }
}

?>