<?php

class Category_Model extends Core_Model {
  function __construct() {
    parent::__construct('categories', 'cid');
  }

  function get_categories($pid) {
    $categories = $this->get('*', array('pid' => $pid));
    $result = array();
    foreach ($categories as $category) {
      $result[$category['cid']] = $category['name'];
    }
    return $result;
  }
}