<?php
class Publisher_Model extends Core_Model{

  function __construct() {
    parent::__construct('publishers', 'pid');
  }

  function get_users_count($type, $pid) {
    switch ($type) {
      case 'admin': case 'contributor': {
        return $this->db->where(array('pid' => $pid, 'role' => $type))->limit(1)->get('match_user_role', 'count(uuid) cnt')['cnt'];
      }
      case 'subscriber': {
        return $this->db->where(array('refid' => $pid, 'type' => 'publisher'))->limit(1)->get('subscription', 'count(uuid) cnt')['cnt'];
      }
    }
  }

  function get_contributors($pid) {
    $select = "
      match_user_role.uuid, 
      match_user_role.status, 
      (SELECT users.email FROM users WHERE users.uuid = match_user_role.uuid) email,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = match_user_role.uuid) username,
      (SELECT count(sid) FROM stories WHERE stories.uuid = match_user_role.uuid AND stories.pid = $pid) stories,
      (SELECT count(id) FROM subscription WHERE subscription.refid = match_user_role.uuid AND type='contributor') subscribers
    ";
    return $this->db->where(array('pid' => $pid, 'role' => 'contributor'))->get('match_user_role', $select);
  }

  function get_active_contributors($pid) {
    $select = "
      match_user_role.uuid, 
      match_user_role.status, 
      (SELECT users.email FROM users WHERE users.uuid = match_user_role.uuid) email,
      (SELECT users.shortbio FROM users WHERE users.uuid = match_user_role.uuid) shortbio,
      (SELECT users.avatar FROM users WHERE users.uuid = match_user_role.uuid) avatar,
      (SELECT users.facebookurl FROM users WHERE users.uuid = match_user_role.uuid) facebookurl,
      (SELECT users.twitterurl FROM users WHERE users.uuid = match_user_role.uuid) twitterurl,
      (SELECT users.instagramurl FROM users WHERE users.uuid = match_user_role.uuid) instagramurl,
      (SELECT users.youtubeurl FROM users WHERE users.uuid = match_user_role.uuid) youtubeurl,
      (SELECT users.vimeourl FROM users WHERE users.uuid = match_user_role.uuid) vimeourl,
      (SELECT users.soundcloudurl FROM users WHERE users.uuid = match_user_role.uuid) soundcloudurl,
      (SELECT users.websiteurl FROM users WHERE users.uuid = match_user_role.uuid) websiteurl,
      (SELECT users.otherurl FROM users WHERE users.uuid = match_user_role.uuid) otherurl,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = match_user_role.uuid) username,
      (SELECT count(sid) FROM stories WHERE stories.uuid = match_user_role.uuid AND stories.pid = $pid) stories,
      (SELECT count(id) FROM subscription WHERE subscription.refid = match_user_role.uuid AND type='contributor') subscribers
    ";
    return $this->db->where(array('pid' => $pid, 'role' => 'contributor'))->get('match_user_role', $select);
  }

  function get_all_admins($pid) {
    $select = "
      match_user_role.uuid, 
      match_user_role.status, 
      (SELECT users.email FROM users WHERE users.uuid = match_user_role.uuid) email,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = match_user_role.uuid) username,
      (SELECT count(sid) FROM stories WHERE stories.uuid = match_user_role.uuid AND stories.pid = $pid) stories
    ";
    return $this->db->where(array('pid' => $pid, 'role' => 'admin'))->get('match_user_role', $select);
  }

  function get_admins($pid) {
    $padmins = $this->db->where(array('pid' => $pid, 'status' => 1, 'role' => 'admin'))->get('match_user_role');
    $ids = array();
    foreach ($padmins as $padmin) {
      $ids[] = $padmin['uuid'];
    }
    $sadmins = $this->db->where(array('role' => 'super_admin', 'status' => 1))->get('users');
    foreach ($sadmins as $sadmin) {
      $ids[] = $sadmin['uuid'];
    }
    return $this->db->where(array('uuid' => $ids))->get('users');
  }
}
