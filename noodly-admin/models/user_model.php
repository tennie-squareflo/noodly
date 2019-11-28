<?php
class User_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  
  function get_users($where = array(), $limit = 0) {
    $select = 
      "uuid,
      email, 
      concat(concat(firstname, ' '), lastname) name, 
      role, 
      phonenumber, 
      profile_ready,
      (SELECT p.name FROM publishers p WHERE p.pid = users.pid) publishername";
    return $this->get($select, $where, $limit);
  }
}
