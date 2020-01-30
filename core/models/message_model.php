<?php
class Message_Model extends Core_Model{
  function __construct() {
    parent::__construct('messages', 'mid');
  }
}
