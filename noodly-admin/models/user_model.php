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
      status,
      (SELECT count(id) from match_user_role mur where mur.uuid = users.uuid) publishers_count
      ";
    return $this->get($select, $where, $limit);
  }
}
