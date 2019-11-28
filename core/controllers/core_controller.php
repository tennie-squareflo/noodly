<?php
class Core_Controller {
  private $view_path;
  private $base_path;
  private $role;
  function __construct($role) {
    $this->role = $role;
    $this->base_path = $this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH;
    $this->view_path = ($this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH).VIEW_PATH;
  }

  function load_view($filename, $vars = array()) {
    if (substr($filename, -4) !== '.php') {
      $filename .= '.php';
    }
    extract($vars);
    include ($this->view_path.$filename);
  }

  function load_model($model) {
    if ($this->load_class($model, $this->base_path.'models/', '_model')) {
      return true;
    }
    if ($this->load_class($model, CORE_PATH.'models/' ,'_model')) {
      return true;
    }
    return false;
  }

  function load_helper($helper) {
    $filename = $helper.'_helper';
    if ($this->load_file($filename, $this->base_path.'helpers/')) {
      return true;
    }
    if ($this->load_file($filename, CORE_PATH.'helpers/')) {
      return true;
    }
    return false;
  }

  function load_class($name, $path, $suffix = '') {
    $class_name = $name.$suffix;
    if ($this->load_file($class_name, $path)) {
      $this->$class_name = new $class_name();
      return true;
    }
    return false;
  }

  function load_file($file, $path) {
    if (file_exists($path.$file.'.php')) {
      require_once($path.$file.'.php');
      return true;
    }
    return false;
  }

  function response($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
    exit();
  }

  function load_library($library) {
    if ($this->load_class($library, $this->base_path.'libraries/')) {
      return true;
    }

    if ($this->load_class($library, CORE_PATH.'libraries/')) {
      return true;
    }

    return false;
  }

  // function load_third_party($file, $path, $classname) {
  //   if (file_exists($path.$file.'.php')) {
  //     require_once($path.$file.'.php');
  //     $this->$classname = new $classname();
  //     return true;
  //   }
  //   return false;
  // }

}