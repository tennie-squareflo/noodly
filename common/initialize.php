<?php

require_once 'constants.php';
require_once 'session.php';
require_once 'config.php';
require_once 'database.php';

$db = new Database($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);

require_once('utilities.php');
if (strpos($_SERVER['REQUEST_URI'], 'login') === false) {
  redirect_not_logged();
}