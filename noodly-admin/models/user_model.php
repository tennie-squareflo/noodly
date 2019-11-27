<?php
class User_Model extends Core_Model{
  function __construct() {
    parent::__construct('users', 'uuid');
  }
  
}
