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

  function get_role($uuid, $pid) {
    $roles = $this->db->limit(1)->where(array('uuid' => $uuid, 'pid' => $pid))->get('match_user_role');
    return count($roles) === 0 ? false : $roles;
  }

  function set_publisher_role($uuid, $pid, $role, $status = 0) {
    $res = $this->db->insert('match_user_role', array('uuid' => $uuid, 'pid' => $pid, 'role' => $role, 'status' => $status));
    return $res;
  }

  function update_role($data, $uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->update('match_user_role', $data);
  }
}
