<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Settings_Controller extends Auth_Controller {
  protected $db;
  function __construct() {
    parent::__construct();
    $this->db = App::get_instance()->db;
    $this->load_model('environment');
    $this->load_model('stripe');
    $this->stripe_model->setParentClass($this);
  }

  function index() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/common/settings/settings.js');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $this->load_view('/admin/admin/settings/settings', $this->view_data);
    } else {
      $this->load_view('/admin/contributor/settings/settings', $this->view_data);
    }
  }

  function publisher() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('custom/common/settings/publisher.js');
    $this->load_view('/admin/admin/settings/publisher', $this->view_data);
  }

  function logo() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'custom/common/settings/logo.js');
    $this->load_view('/admin/admin/settings/logo', $this->view_data);
  }
  
  function website() {
    $this->view_data['script_files'] = array('custom/common/settings/website.js');
    $this->load_view('/admin/admin/settings/website', $this->view_data);
  }
  function notification() {
    $this->view_data['script_files'] = array('custom/common/settings/notification.js');
    $this->load_view('/admin/admin/settings/notification', $this->view_data);
  }
  function stripe() {
    if(isset($_GET['action']) && $_GET['action'] == 'stripe-connect-response'){
        $dataToSave = $this->stripe_model->connect($_GET['code']);//,$_SESSION['stripe_connect_live'] == '1');

        $_SESSION['settings-stripe-message'] = $this->stripe_model->getlastResponseMessage();
        $_SESSION['settings-stripe-message-type'] = $this->stripe_model->getlastResponse();

        if($_SESSION['settings-stripe-message-type']){
            if ($_SESSION['user']['role'] === 'admin') { // if admin
                if(!$this->stripe_model->updatePublisherStripeData($dataToSave)){
                    $_SESSION['settings-stripe-message'] = false;
                    $_SESSION['settings-stripe-message-type'] = 'Could not save your Stripe account. Please try again or contact us. [e.s.1]';
                    return false;
                }
            } else {
                if(!$this->stripe_model->updateUserStripeData($dataToSave)){
                    $_SESSION['settings-stripe-message'] = false;
                    $_SESSION['settings-stripe-message-type'] = 'Could not save your Stripe account. Please try again or contact us. [e.s.2]';
                    return false;
                }
            }
        }

        header("Location: ".BASE_URL."settings/stripe");
        exit;
    } else if(isset($_POST['action']) && $_POST['action'] == 'stripe-connect'){
        $this->stripe_model->forwardToConnectPage();
    } else if(isset($_POST['action']) && $_POST['action'] == 'stripe-disconnect'){
        //$this->stripe_model->forwardToConnectPage();
        if($this->stripe_model->disconnect()){
            if ($_SESSION['user']['role'] === 'admin') { // if admin
                $b_success = $this->stripe_model->clearPublisherStripeData();
            } else {
                $b_success = $this->stripe_model->clearUserStripeData();
            }
            $this->lastResponseSuccess = $b_success;
            $this->lastResponseMessage = $b_success ? 'Your account is now disconnected' : 'Something went wrong, please try again or contact us [e.s.d.1]';
        }

        $_SESSION['settings-stripe-message'] = $this->stripe_model->getlastResponseMessage();
        $_SESSION['settings-stripe-message-type'] = $this->stripe_model->getlastResponse();

        header("Location: ".BASE_URL."settings/stripe");
        exit;
    }

    $this->view_data['stripe_message'] = '';
    $this->view_data['stripe_message_type'] = false;
    if(isset($_SESSION['settings-stripe-message'])){
        $this->view_data['stripe_message'] = $_SESSION['settings-stripe-message'];
        unset($_SESSION['settings-stripe-message']);
    }
    if(isset($_SESSION['settings-stripe-message-type'])){
        $this->view_data['stripe_message_type'] = $_SESSION['settings-stripe-message-type'];
        unset($_SESSION['settings-stripe-message-type']);
    }

    $this->view_data['script_files'] = array('custom/common/settings/stripe.js');

    if ($_SESSION['user']['role'] === 'admin') { // if admin
        $stripeSettings = $this->stripe_model->getStripeSettingsFromPublisher();
    } else {
        $stripeSettings = $this->stripe_model->getStripeSettingsFromUser();
    }
    $this->view_data['stripe_settings'] = $stripeSettings;

    $this->load_view('/admin/admin/settings/stripe', $this->view_data);
  }
  function about() {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/quill/quill.snow.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/quill/quill.min.js', 'custom/common/settings/about.js');
    $this->load_view('/admin/admin/settings/about', $this->view_data);
  }

  function about_image_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('about_image', ASSETS_PATH.'media/images/');
  }

  function edit() {
    try {
      if (!empty($_POST['about_image'])) {
        $_POST['about_image'] = json_decode($_POST['about_image'])->file;
      }
      if (!empty($_POST['light_back_logo'])) {
        $_POST['light_back_logo'] = json_decode($_POST['light_back_logo'])->file;
      }
      if (!empty($_POST['dark_back_logo'])) {
        $_POST['dark_back_logo'] = json_decode($_POST['dark_back_logo'])->file;
      }
      if (!empty($_POST['favicon'])) {
        $_POST['favicon'] = json_decode($_POST['favicon'])->file;
      }
      $this->environment_model->update_env($_POST, $this->pid);
      $this->response(array('message' => 'Settings updated successfully!'));
    } catch(Exception $e) {
      $this->response(array('message' => 'Error occured! Please try again.'), 500);
    }
  }

  function email_background_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('email_background_image', ASSETS_PATH.'media/email_background/');
  }



  function logo_upload($type) {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload($type, ASSETS_PATH.'media/logos/');
  }
}
