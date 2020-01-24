<?php

class Client_Model extends Core_Model {
  function __construct() {
    parent::__construct('clients', 'cid');
  }

  function get_clients() {
    $result = $this->get('*');
    return $result;
  }
}