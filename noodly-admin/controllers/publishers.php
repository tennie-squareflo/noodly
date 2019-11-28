<?php
require_once(ADMIN_PATH.'core/admin_controller.php');

class Publishers_Controller extends Admin_Controller {
  function __construct() {
    parent::__construct();
    $this->load_model('publisher');
  }
  function index() {
    $view_data['script_files'] = array('custom/admin/publisher-register/publisher.js');
    $view_data['publishers'] = $this->publisher_model->get_publishers();
    $this->load_view('publishers/publishers', $view_data);
  }

  function edit($id = 0) {
    $view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $view_data['script_files'] = array('custom/admin/publisher-register/register.js');
    $view_data['publisher_id'] = $id;
    $view_data['publisher'] = $this->publisher_model->get_one($id);
    $this->load_view('publishers/edit_publisher', $view_data);
  }

  function action($action) {
    $id = $_POST['id'];
    $this->load_helper('validation');
    switch ($action) {
      case 'edit': {
        $new_data = array(
          'name' => test_input($_POST['name']),
          'domain' => test_input($_POST['domain']),
          'logo' => !empty($_POST['logo']) ? json_decode($_POST['logo'])->file : '',
          'phonenumber' => test_input($_POST['phone']),
          'email' => test_input($_POST['email']),
          'country' => test_input($_POST['country']),
          'state' => test_input($_POST['state']),
          'address1' => test_input($_POST['address1']),
          'address2' => test_input($_POST['address2']),
          'city' => test_input($_POST['city']),
          'zipcode' => test_input($_POST['zipcode'])
        );
        foreach($new_data as $key => $value) {
          if (empty($value) && $key !== 'logo' && $key !== 'address2') {
            $this->response(array('code' => 2, 'message' => 'Invalid input!'), 400);
            return;
          }
        }
        if ($id === 0) { // create
          $new_id = $this->publisher_model->create($new_data);
          if ($new_id !== false) {
            $this->response(array('code' => 0, 'id' => $new_id, 'message' => 'Publisher created successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher creation failed!'), 500);
          }
        } else {
          if ($this->publisher_model->update($new_data, $id)) {
            $this->response(array('code' => 0, 'id' => $id, 'message' => 'Publisher updated successfully!'));
          } else {
            $this->response(array('code' => 1, 'message' => 'Publisher update failed!'), 500);
          }
        }
        break; 
      }
      case 'delete':
        if ($this->publisher_model->delete($id))  {
          $this->response(array('code' => 0, 'message' => 'Publisher deleted successfully!'));
        } else {
          $this->response(array('code' => 1, 'message' => 'Publisher deletion failed!'), 500);
        }
        break;
    }
  }

  function logo_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('logo', ASSETS_PATH.'media/logos/');
  }
}
