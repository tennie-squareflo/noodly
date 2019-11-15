<?php

include_once 'session.php';
include_once 'config.php';
include_once 'database.php';

$mysql = new Database($config['database']['host'], $config['database']['user'], $config['database']['password'], $config['database']['database']);
$session = new Session();
