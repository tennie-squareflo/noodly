<?php
class Story_Model extends Core_Model{
  function __construct() {
    parent::__construct('stories', 'sid');
  }
  
  function get_stories_count($pid = 0, $uuid = 0) {
    if ($pid !== 0) {
      $this->db->where(array('pid' => $pid));
    }
    if ($uuid != 0) {
      $this->db->where(array('uuid' => $uuid));
    }
    return $this->count();
  }

  function get_recent_stories($pid = 0, $uuid = 0, $limit = 0) {
    $select = "
      stories.sid,
      stories.title,
      stories.visits,
      stories.created_at,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = stories.uuid) username,
      (SELECT publishers.name FROM publishers where publishers.pid = stories.pid) publishername,
      stories.status,
      (SELECT categories.name FROM categories WHERE categories.cid = stories.cid) categoryname
    ";
    if ($pid !== 0) {
      $this->db->where(array('pid' => $pid));
    }
    if ($uuid != 0) {
      $this->db->where(array('uuid' => $uuid));
    }
    return $this->get($select, array(), $limit, 'sid');
  }
  function slug_exists($slug) {
    return $this->count(array('url' => $slug)) > 0;
  }
}
