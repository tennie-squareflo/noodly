<?php
class Publisher_Model extends Core_Model{

  function __construct() {
    parent::__construct('publishers', 'pid');
  }

  function get_publishers($where = array(), $limit = 0) {
    $select = 
      "publishers.pid, 
      publishers.name, 
      publishers.domain, 
      (SELECT count(uuid) FROM subscription s WHERE s.refid = publishers.pid AND s.type='publisher') subscribers, 
      (SELECT count(uuid) FROM match_user_role u WHERE u.pid = publishers.pid AND u.role='contributor') contributors, 
      (SELECT count(sid) FROM stories s WHERE s.pid = publishers.pid) stories,
      (SELECT ifnull(sum(visits), 0) FROM stories s WHERE s.pid = publishers.pid) visits";
    return $this->get($select, $where, $limit);
  }

  function get_list() {
    $select = "publishers.pid, publishers.name, publishers.logo";
    $list = $this->get($select);
    $result = array();
    foreach ($list as $publisher) {
      $result[$publisher['pid']] = array('name' => $publisher['name'], 'logo' => $publisher['logo']);
    }
    return $result;
  }
  
}
