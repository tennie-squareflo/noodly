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
      stories.cid,
      stories.title,
      stories.visits,
      stories.url,
      stories.thumb_image,
      stories.created_at,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = stories.uuid) username,
      (SELECT publishers.name FROM publishers where publishers.pid = stories.pid) publishername,
      stories.status,
      (SELECT categories.name FROM categories WHERE categories.cid = stories.cid) categoryname
    ";
    if ($pid !== 0) {
      $this->db->where(array('pid' => $pid));
    }
    if ($uuid !== 0) {
      $this->db->where(array('uuid' => $uuid));
    }
    return $this->get($select, array(), $limit, 'sid');
  }

  function get_channel_stories($pid =0, $uuid = 0, $cid = 0, $limit = 0) {
    $select = "
      stories.sid,
      stories.cid,
      stories.title,
      stories.visits,
      stories.url,
      stories.thumb_image,
      stories.created_at,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = stories.uuid) username,
      (SELECT publishers.name FROM publishers where publishers.pid = stories.pid) publishername,
      stories.status,
      (SELECT categories.name FROM categories WHERE categories.cid = stories.cid) categoryname
    ";
    if ($pid !== 0) {
      $this->db->where(array('pid' => $pid));
    }
    if ($uuid !== 0) {
      $this->db->where(array('uuid' => $uuid));
    }
    $this->db->where(array('cid' => $cid));
    return $this->get($select, array(), $limit, 'sid');
  }

  function get_published_recent_stories($pid = 0, $uuid = 0, $limit = 0) {
    $select = "
      stories.sid,
      stories.cid,
      stories.title,
      stories.visits,
      stories.url,
      stories.thumb_image,
      stories.created_at,
      (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) FROM users WHERE users.uuid = stories.uuid) username,
      (SELECT publishers.name FROM publishers where publishers.pid = stories.pid) publishername,
      stories.status,
      (SELECT categories.name FROM categories WHERE categories.cid = stories.cid) categoryname
    ";
    $this->db->where(array('status' => 'published'));
    if ($pid !== 0) {
      $this->db->where(array('pid' => $pid));
    }
    if ($uuid != 0) {
      $this->db->where(array('uuid' => $uuid));
    }
    $this->db->order_by('created_at', 'DESC');
    return $this->get($select, array(), $limit, 'sid');
  }

  function get_published_popular_stories($pid = 0, $uuid = 0, $limit = 0) {
    $query = "SELECT stories.sid, stories.cid, stories.title, stories.visits, stories.url, 
    stories.thumb_image, stories.created_at, 
    (SELECT concat(users.firstname, ' ', ifnull(users.lastname, '')) 
    FROM users WHERE users.uuid = stories.uuid) username, 
    (SELECT publishers.name FROM publishers where publishers.pid = stories.pid) publishername, 
    stories.status, 
    (SELECT categories.name FROM categories WHERE categories.cid = stories.cid) categoryname 
    FROM stories 
    WHERE 
      `status`='PUBLISHED'"
      .(($pid !== 0) ? " AND `pid` = $pid" : "")
      .(($uuid !== 0) ? " AND `uuid` = $uuid" : "")
    ." AND `created_at` BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW() ORDER BY `visits` DESC, `sid` DESC";
    
    return $this->db->query($query, true);
    //return $this->get($select, array(), $limit, 'sid');
  }
  
  function slug_exists($slug) {
    return $this->count(array('url' => $slug)) > 0;
  }

  function visits_plus($slug) {
    return $this->update(array('visits' => 'visits + 1'), array('url' => $slug), false);
  }

  function get_prev_story($sid, $pid) {
    $query = "SELECT * FROM stories WHERE sid > ".$sid." AND pid = ".$pid." AND status='PUBLISHED' ORDER BY sid ASC LIMIT 1";
    return $this->db->query($query, true);

  }

  function get_next_story($sid, $pid) {
    $query = "SELECT * FROM stories WHERE sid < ".$sid." AND pid = ".$pid." AND status='PUBLISHED' ORDER BY sid ASC LIMIT 1";
    return $this->db->query($query, true);

  }

  function increase_client_view($sid) {
    $query = "UPDATE stories SET client_view = client_view + 1 WHERE sid = $sid";
    return $this->db->query($query);
  }

  function get_stories_by_hashtag($pid, $uuid, $hashtag) {
    $condition = '';
    if ($pid) {
      $condition .= " AND pid = '$pid'";
    }
    if ($uuid) {
      $condition .= " AND uuid = '$uuid'";
    }
    return $this->db->query("SELECT * FROM stories WHERE hashtags like '%#$hashtag%' AND status='PUBLISHED' $condition", true);
  }

}
