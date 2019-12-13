<?php
class Environment_Model extends Core_Model{
  function __construct() {
    parent::__construct('environment', 'eid');
  }
  function get_env($pid = 0) {
    $db_results = $this->get('*', array('pid' => $pid));
    $result = array();
    foreach ($db_results as $db_result) {
      $result[$db_result['env_name']] = $db_result['env_value'];
    }
    return $result;
  }

  function update_env($new_data, $pid = 0) {
    $this->begin_transaction();
    $success = true;
    foreach ($new_data as $key => $record) {
      $success = $this->update(array('env_value' => $record), array('env_name' => $key, 'pid' => $pid));
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
