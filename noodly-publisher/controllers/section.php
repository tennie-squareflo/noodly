<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Section_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('publisher');
    $this->load_model('category');
    $this->load_model('user');
    $this->view_data['style_files'] = array('custom/publisher/category/list.css');
    $this->view_data['script_files'] = array('custom/publisher/category/list.js');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['categories'] = $this->category_model->get_categories($pid, 0);
      $this->load_view('/admin/admin/categories', $this->view_data);
    } else {
      echo "No permission";
    }
  }

  function edit($id = 0) {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/category/edit.js');

    $this->load_model('category');

    $this->view_data['category'] = $this->category_model->get_one($id);
    $this->view_data['is_new'] = count($this->view_data['category']) === 0;
    
    $this->load_view('/admin/admin/edit_category', $this->view_data);
  }

  function action($type) {
    $post = $_POST;
    $this->load_model('category');
    switch ($type) {
      case 'edit': {
        $id = $post['id'];
        try {
          $new_data = array(
            'name' => $post['name'],
            'slug' => $post['slug'],
            'image' => !empty($post['image']) ? json_decode($post['image'])->file : '',
            'pid' => $_SESSION['user']['pid']
          );
          if ($id) {
            $this->category_model->update($new_data, $id);
          } else {
            $id = $this->category_model->create($new_data);
          }
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
        }
        $this->response(array(
          'message' => "A Section ".($post['id'] == '0' ? 'Created' : 'Updated')." Successfully!",
          'id' => $id
        ), 200);
      }
      break;
      case 'delete':
        $id = $post['id'];
        try {
          $this->category_model->delete($id);
          $this->response(array(
            'message' => "A Section Deleted Successfully!",
          ), 200);
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'delete_selected':
        $ids = $post['selectedIds'];
        // var_dump($id);exit;
        try {
          $this->category_model->deleteRows($ids);
          $this->response(array(
            'message' => "Sections Deleted Successfully!",
          ), 200);
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
    }
  }

  function get_slug() {
    $title = $_POST['title'];
    $slug = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($title));
    $this->load_model('category');
    $this->load_helper('string_helper');
    while ($this->category_model->slug_exists($slug)) {
      $slug .= generate_random_string(1);
    }
    $this->response(array('slug' => $slug));
  }
} 