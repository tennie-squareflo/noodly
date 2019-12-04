<?php
class Environment_Model extends Core_Model{
  function __construct() {
    parent::__construct('environment', 'eid');
  }
  function get_admin_env() {
    $db_results = $this->get('*', array('pid' => 0));
    $result = array();
    foreach ($db_results as $db_result) {
      $result[$db_result['env_name']] = $db_result['env_value'];
    }
    return $result;
  }

  function update_admin_env($new_data) {
    $this->begin_transaction();
    $success = true;
    foreach ($new_data as $key => $record) {
      $success = $this->update(array('env_value' => $record), array('env_name' => $key, 'pid' => 0));
      if ($success === false) {
        break;
      }
    }
    if ($success === true) {
      $this->trans_commit();
      return true;
    }

    $this->trans_rollback();
    return false;
  }
}
