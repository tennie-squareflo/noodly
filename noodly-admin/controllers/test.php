<?php
class Test_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
  }

  function send_mail() {
    $this->load_helper('sendgrid_mail');

    $params = array(
      'to' => 'everdev0923@gmail.com',
      'from' => 'donotreply@noodly.io',
      'subject' => 'Sendgrid is working',
      'html' => '<a href="http://noodly.io">Check mail</a>',
      
    );

    var_dump(sendgridMail($params));
  }

  function php_info() {
    phpinfo();
  }
}