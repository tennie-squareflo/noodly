<?php
class Core_Controller {
  private $view_path;
  private $base_path;
  private $role;

  public $publisher_domain;
  public $view_data;
  public $pid;
  
  function __construct($role) {
    $this->role = $role;
    $this->base_path = $this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH;
    $this->view_path = ($this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH).VIEW_PATH;
    $this->load_helper('string');

    if ($role === 'admin') {
      $this->pid = 0;
    } else {
      $this->publisher_domain = PUBLISHER_DOMAIN;
      $this->load_model("publisher");
      $publisher = $this->publisher_model->get_one(array("domain" => $this->publisher_domain));
      $this->pid = $publisher['pid'];
      $this->view_data['publisher'] = $publisher;
    }

    $this->load_model('environment');
    $this->view_data['_env'] = $this->environment_model->get_env($this->pid);
    
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

  function single_load($page, $vars = array(), $return = false) {
    if ($return === true) {
      $result = "";
      $result .= Core_Controller::load_view($page, $vars, $return);
      return $result;
    } else {
      Core_Controller::load_view($page, $vars);
    }
  }

  function send_email($uuid, $pid, $subject, $link, $view, $view_data) {
    $this->load_model('user');
    $this->load_model('publisher');
    $this->load_model('environment');
    $this->load_model('match_user_role');
    $this->load_helper('string');

    $user = $this->user_model->get_one($uuid);
    $publisher = $this->publisher_model->get_one($pid);
    $env = $this->environment_model->get_env($pid);
    $role = $this->match_user_role_model->get_one(array('uuid' => $uuid, 'pid' => $pid));

    $to = $user['email'];
    $from = $publisher['email'];
    
    $headers = "From: $publisher[name]\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if (ENV === 'local') {
      $domain = $publisher['domain'] == '' 
                ? 'dev.noodly.com/admin' 
                : 'dev.noodly.com/'.$publisher['domain'];
      $server = 'dev.noodly.com';
    } else {
      $domain = $publisher['domain'] == '' ? 'noodly.io' : $publisher['domain'].'.noodly.io';
      $server = $domain;
    }
    
    $view_data['accept_url'] = $domain.$link;
    $view_data['user'] = $user;
    $view_data['publisher'] = $publisher;
    $view_data['role'] = $role;
    $view_data['env'] = $env;
    $view_data['domain'] = $domain;
    $view_data['server'] = $server;

    $body = $this->single_load('email_template/'.$view, $view_data, true);
    
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => $to,
      'from' => $from,
      'fromname' => $publisher['name'],
      'subject' => $subject,
      'html' => $body,
    );
    
    if (sendgridMail($params)) {
      return true;
    } else {
      return false;
    }
  }

  function send_grid_mail($user, $pid, $subject, $link, $view, $view_data) {
    $this->load_model('publisher');
    $this->load_model('environment');
    $this->load_helper('string');

    $publisher = $this->publisher_model->get_one($pid);
    $env = $this->environment_model->get_env($pid);

    $to = $user['email'];
    $from = $publisher['email'];
    
    $headers = "From: $publisher[name]\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if (ENV === 'local') {
      $domain = $publisher['domain'] == '' 
                ? 'dev.noodly.com/admin' 
                : 'dev.noodly.com/'.$publisher['domain'];
      $server = 'dev.noodly.com';
    } else {
      $domain = $publisher['domain'] == '' ? 'noodly.io' : $publisher['domain'].'.noodly.io';
      $server = $domain;
    }
    
    $view_data['accept_url'] = $domain.$link;
    $view_data['user'] = $user;
    $view_data['publisher'] = $publisher;
    $view_data['env'] = $env;
    $view_data['domain'] = $domain;
    $view_data['server'] = $server;

    $body = $this->single_load('email_template/'.$view, $view_data, true);
    
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => $to,
      'from' => $from,
      'fromname' => $publisher['name'],
      'subject' => $subject,
      'html' => $body,
    );
    
    if (sendgridMail($params)) {
      return true;
    } else {
      return false;
    }  
  }
}