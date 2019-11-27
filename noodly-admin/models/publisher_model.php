<?php
class Publisher_Model extends Core_Model{
  function __construct() {
    parent::__construct('publishers p', 'pid');
  }
  function get_publishers($where = array(), $limit = 0) {
    $select = 
      "p.pid, 
      p.name, 
      p.domain, 
      (SELECT count(uuid) FROM users u WHERE u.pid = p.pid AND u.role='subscriber') subscribers, 
      (SELECT count(uuid) FROM users u WHERE u.pid = p.pid AND u.role='contributor') contributors, 
      (SELECT count(sid) FROM stories s WHERE (SELECT pid FROM users u WHERE u.uuid = s.uuid) = p.pid) stories,
      (SELECT ifnull(sum(visits), 0) FROM stories s WHERE (SELECT pid FROM users u WHERE u.uuid = s.uuid) = p.pid) visits";
    return $this->get($select, $where, $limit);
  }
}
