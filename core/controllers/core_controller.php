<?php
class Core_Controller {
  private $view_path;
  private $base_path;

  public $publisher_domain;
  public $view_data;
  public $publisher;
  public $user;
  public $env;
  
  /*
  ** user role
  ** role => admin / contributor
  ** user_status 
  ** role_status
  */
  public $role;
  
  function __construct($role) {
    $this->base_path = $this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH;
    $this->view_path = ($this->role === 'admin' ? ADMIN_PATH : PUBLISHER_PATH).VIEW_PATH;

    $this->load_helper('string');

    // set publisher information
    $this->load_model("publisher");
    if ($role === 'admin') {
      $this->publisher = $this->publisher_model->get_one(0);
      $this->publisher_domain = '';
    } else {
      $this->publisher_domain = PUBLISHER_DOMAIN;
      $this->publisher = $this->publisher_model->get_one(array("domain" => $this->publisher_domain));
    }

    // load environment
    $this->load_model("environment");
    $this->env = $this->environment_model->getByPid($this->publisher['pid']);

    // set user and role information
    if ($_SESSION['user']) {
      $this->user = $_SESSION['user']['info'];
      $this->role = $_SESSION['user']['role'];
    } else {
      $this->user = null;
      $this->role = null;
    }

    // set default view data
    $this->view_data['publisher'] = $this->publisher;
    $this->view_data['user'] = $this->user;
    $this->view_data['role'] = $this->role;
    $this->view_data['env'] = $this->env;
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

  // send email to user from publisher with subject, link, data
  function send_email($receiver_uuid, $view, $subject, $link, $view_data) {
    
    $this->load_model('user');    
    $receiver = $this->user_model->get_one($receiver_uuid);

    $to = $receiver['email'];
    $from = $this->publisher['email'];
    
    $headers = "From: $this->publisher[name]\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    if (ENV === 'local') {
      $domain = $this->publisher['domain'] == '' 
                ? 'dev.noodly.com/admin' 
                : 'dev.noodly.com/'.$this->publisher['domain'];
      $server = 'dev.noodly.com';
    } else {
      $domain = $this->publisher['domain'] == '' ? 'noodly.io' : $this->publisher['domain'].'.noodly.io';
      $server = $domain;
    }
    
    $view_data['accept_url'] = $domain.$link;
    $view_data['receiver'] = $receiver;
    $view_data['publisher'] = $this->publisher;
    $view_data['env'] = $this->env;
    $view_data['domain'] = $domain;
    $view_data['server'] = $server;

    $body = $this->single_load('email_template/'.$view, $view_data, true);
    
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => $to,
      'from' => $from,
      'fromname' => $this->publisher['name'],
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
    $env = $this->environment_model->get_env();

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