<?php

class Category_Model extends Core_Model {
  function __construct() {
    parent::__construct('categories', 'cid');
  }

  function get_categories($pid) {
    $select = "
      categories.*,
      (select count(stories.sid) from stories where stories.cid = categories.cid) storiescount,
      (select sum(visits) from stories where stories.cid = categories.cid) visits
    ";
    $categories = $this->get($select, array('pid' => $pid));
    $result = array();
    foreach ($categories as $category) {
      $result[$category['cid']] = $category;
    }
    return $result;
  }

  function get_category_names($pid) {
    $categories = $this->get('cid, name', array('pid' => $pid));
    $result = array();
    foreach ($categories as $category) {
      $result[$category['cid']] = $category['name'];
    }
    return $result;
  }

  function get_trend_channels($pid) {
    $query = "SELECT categories.*,
    (select count(stories.sid) from stories where stories.cid = categories.cid) storiescount,
    (select sum(visits) from stories where stories.cid = categories.cid) visits FROM categories WHERE pid = ".$pid." ORDER BY visits DESC LIMIT 5";
    // echo $query;exit;
    return $this->db->query($query, true);
  }

  function slug_exists($slug) {
    return $this->count(array('slug' => $slug)) > 0;
  }
}