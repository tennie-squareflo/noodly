<?php
class Environment_Model extends Core_Model{
  function __construct() {
    parent::__construct('environment', 'eid');
  }

  function get_env($pid = 0) {
    $result = $this->get('env_name, env_value', array('pid' => $pid));

    if (count($result) === 0) {
      // load admin settings
      $admin_env = $this->get('env_name, env_value', array('pid' => 0));
      foreach ($admin_env as $env) {
        $new_data = array(
          'env_name' => $env['env_name'],
          'env_value' => (strpos($env['env_name'], 'about_') === false ? $env['env_value'] : ''),
          'pid' => $pid
        );
        $this->create($new_data);
      }
      $result = $this->get('env_name, env_value', array('pid' => $pid));
    }

    $res = array();
    foreach ($result as $env) {
      $res[$env['env_name']] = $env['env_value'];
    }
    return $res;
  }

  function update_env($env, $pid = 0) {
    foreach ($env as $key => $value) {
      $this->update(array('env_value' => $value), array('env_name' => $key, 'pid' => $pid));
    }
  }
}
