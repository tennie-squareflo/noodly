<?php
include_once('../common/initialize.php');

function get_session_value($name) {
  return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}

function is_logged() {
  if (get_session_value('isLoggedIn') === true) {
    return true;
  }
  return false;
}

function redirect_not_logged() {
  if (!is_logged()) {
    header('Location: login.php');
  }
}

function get_dashboard_info($role) {
}

function get_publishers($db, $limit = 0) {
  $select = 
    "p.pid, 
    p.name, 
    p.domain, 
    (SELECT count(uuid) FROM users u WHERE u.pid = p.pid AND u.role='subscriber') subscribers, 
    (SELECT count(uuid) FROM users u WHERE u.pid = p.pid AND u.role='contributor') contributors, 
    (SELECT count(sid) FROM stories s WHERE (SELECT pid FROM users u WHERE u.uuid = s.uuid) = p.pid) stories,
    (SELECT ifnull(sum(visits), 0) FROM stories s WHERE (SELECT pid FROM users u WHERE u.uuid = s.uuid) = p.pid) visits";
  if ($limit > 0) {
    $db->limit($limit);
  }
  return $db->get('publishers p', $select);
}

function get_publishers_count($db) {
  return $db->limit(1)->get('publishers p', 'count(p.pid) count')['count'];
}

function get_stories_count($db, $publisher = 0, $contributor = 0) {
  if ($publisher != 0) {
    $db->where('pid', $publisher);
  }
  if ($contributor != 0) {
    $db->where('uuid', $contributor);
  }
  return $db->limit(1)->get('users u', 'count(u.uuid) count')['count'];
}

function get_contributors_count($db, $publisher = 0) {
  if ($publisher != 0) {
    $db->where('pid', $publisher);
  }
  $db->where('role', 'contributor');
  return $db->limit(1)->get('users u', 'count(u.uuid) count')['count'];
}

function get_publisher_info($db, $publisher_id) {
  return $db->limit(1)->where('pid', $publisher_id)->get('publishers');
}
?>