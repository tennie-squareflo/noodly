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
    if (! ini_get('short_open_tag'))
		{
			echo eval('?>'.preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($this->view_path.$filename))));
    } else {
      include ($this->view_path.$filename);
    }
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

  function load_class($name, $path, $suffix = '') {
    $class_name = $name.$suffix;
    if (file_exists($path.$class_name.'.php')) {
      require_once($path.$class_name.'.php');
      $this->$class_name = new $class_name();
      return true;
    }
    return false;
  }

  function response($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data);
  }
}