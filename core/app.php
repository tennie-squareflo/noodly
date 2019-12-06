<?php
require_once('database.php');

class App {
  public static $_instance;
  public $db;

  private $db_config = array(
    'server' => array(
        'host' => '45.33.88.101',
        'user' => 'noodlyad_admin',
        'password' => 'root!@#!@#123',
        'database' => 'noodlyad_db',
    ),
    'local' => array(
      'host' => '127.0.0.1',
      'user' => 'noodlyad_admin',
      'password' => 'root!@#!@#123',
      'database' => 'noodlyad_db',
    )
  );

  function __construct() {
    $this->db = new Database($this->db_config[ENV]['host'], $this->db_config[ENV]['user'], $this->db_config[ENV]['password'], $this->db_config[ENV]['database']);
  }

  public static function get_instance() {
    if (!(self::$_instance instanceof self)) {
      self::$_instance = new App();
    }
    return self::$_instance;
  }
}