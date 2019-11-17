<?php

//$env = 'development';
$env = 'production';

$configSetting['production'] = array(
    'database' => array(
        'host' => '45.33.88.101',
        'user' => 'noodlyad_admin',
        'password' => 'root!@#!@#123',
        'database' => 'noodlyad_db',
    ),
);

$configSetting['development'] = array(
    'database' => array(
        'host' => '127.0.0.1',
        'user' => 'noodlyad_admin',
        'password' => 'root!@#!@#123',
        'database' => 'noodlyad_db',
    ),
);

$base_url = $env === 'development' ? '/noodly-admin/' : '/';
$assets_url = $base_url.'assets/';

$config = $configSetting[$env];
