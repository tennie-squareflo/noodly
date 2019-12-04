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

  function load_view($filename, $vars = array(), $return = false) {
    if (substr($filename, -4) !== '.php') {
      $filename .= '.php';
    }
    extract($vars);
    if ($return === true) {
      ob_start();
    }
    
    include ($this->view_path.$filename);

    if ($return === true) {
      $result = ob_get_clean();
      return $result;
    }
    
  }

  function load_model($model, $static = false) {
    if ($this->load_class($model, $this->base_path.'models/', '_model', $static)) {
      return true;
    }
    if ($this->load_class($model, CORE_PATH.'models/' ,'_model', $static)) {
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

  function load_class($name, $path, $suffix = '', $static = false) {
    $class_name = $name.$suffix;
    if ($this->load_file($class_name, $path)) {
      if ($static === false) {
        $this->$class_name = new $class_name();
      }
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

  function load_library($library, $static = false) {
    if ($this->load_class($library, $this->base_path.'libraries/', '', $static)) {
      return true;
    }

    if ($this->load_class($library, CORE_PATH.'libraries/', '', $static)) {
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