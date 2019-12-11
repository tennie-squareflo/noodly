<?php

class Match_User_Role_Model extends Core_Model {
  function __construct() {
    parent::__construct('match_user_role', 'id');
  }

  // get related publisher ids from a uuid
  function get_related_publishers($uuid) {
    return $this->get('pid', array('uuid' => $uuid), 5);
  }
}