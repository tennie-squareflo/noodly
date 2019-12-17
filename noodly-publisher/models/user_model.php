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
}
