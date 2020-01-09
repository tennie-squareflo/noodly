<?php
class User_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  
  function get_subscribers_count($uuid) {
    return $this->db->where(array('refid' => $uuid, 'type' => 'contributor'))->limit(1)->get('subscription', 'count(uuid) cnt')['cnt'];
  }

  function get_contributors($pid) {
    $select = "
      match_user_role.uuid,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname)) FROM users WHERE users.uuid = match_user_role.uuid) username,
      (SELECT count(stories.sid) FROM stories WHERE stories.uuid = match_user_role.uuid AND stories.pid = $pid) stories,
      (SELECT count(subscription.id) FROM subscription WHERE subscription.type = 'contributor' AND subscription.refid = match_user_role.uuid) subscribers
    ";
    return $this->db->where(array('pid' => $pid))->get('match_user_role', $select);
  }

  function set_publisher_role($uuid, $pid, $role, $status = 0) {
    $res = $this->db->insert('match_user_role', array('uuid' => $uuid, 'pid' => $pid, 'role' => $role, 'status' => $status));
    return $res;
  }

  function get_role($uuid, $pid) {
    $roles = $this->db->limit(1)->where(array('uuid' => $uuid, 'pid' => $pid))->get('match_user_role');
    return count($roles) === 0 ? false : $roles;
  }

  function update_role($data, $uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->update('match_user_role', $data);
  }

  function delete_user_role($uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->delete('match_user_role', $data);
  }

  function delete_multi_user_role($uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->delete('match_user_role', $data);
  }

  function block_user_role($uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->update('match_user_role', array('status' => 0));
  }

  function activate_user_role($uuid, $pid) {
    return $this->db->where(array('uuid' => $uuid, 'pid' => $pid))->update('match_user_role', array('status' => 1));
  }
}
