<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Story_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->load_model('publisher');
    $this->load_model('story');
    $this->load_model('user');
    $this->view_data['script_files'] = array('custom/publisher/story/list.js');
    $this->view_data['style_files'] = array('custom/publisher/story/list.css');
    if ($_SESSION['user']['role'] === 'admin') { // if admin
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['stories'] = $this->story_model->get_recent_stories($pid, 0);
      $this->load_view('/admin/admin/stories', $this->view_data);
    } else {    // contributor
      $pid = $_SESSION['user']['pid'];
      $uuid = $_SESSION['user']['uuid'];
      $this->view_data['stories'] = $this->story_model->get_recent_stories($pid, $uuid);
      $this->load_view('/admin/contributor/stories', $this->view_data);
    }
  }

  function edit($id = 0) {
    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/quill/quill.snow.css', 'custom/publisher/story/edit.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/quill/quill.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/edit.js');

    $this->load_model('story');
    $this->load_model('paragraph');
    $this->load_model('category');

    $this->view_data['post'] = $this->story_model->get_one($id);
    $this->view_data['paragraphs'] = $this->paragraph_model->get_paragraphs($id);
    $this->view_data['categories'] = $this->category_model->get_category_names($this->pid);
    $this->view_data['is_new'] = count($this->view_data['post']) === 0;
    
    $this->load_view('/admin/edit_story', $this->view_data);
  }

  function action($type) {
    $post = $_POST;
    $this->load_model('story');
    $this->load_model('paragraph');
    switch ($type) {
      case 'edit': {
        $main_data = $post['data']['mainForm'];
        if (isset($post['data']['otherForms'])) {
          $other_data = $post['data']['otherForms'];
        } else {
          $other_data = array();
        }

        try {
          if ($main_data['id'] == '0') {// insert new data
            $new_story_data = array(
              'title' => $main_data['title'],
              'cid' => $main_data['cid'],
              'uuid' => $_SESSION['user']['uuid'],
              'thumb_image' => !empty($main_data['thumb_image']) ? json_decode($main_data['thumb_image'])->file : '',
              'cover_image' => !empty($main_data['cover_image']) ? json_decode($main_data['cover_image'])->file : '',
              'summary' => $main_data['summary'],
              'visits' => 0,
              'status' => $post['type'] === 'save' ? ($_SESSION['user']['role'] === 'admin' ? 'PUBLISHED' : 'SUBMITTED') : 'DRAFT',
              'pid' => $_SESSION['user']['pid'],
              'created_at' => date('Y-m-d H:i:s'),
              'first_paragraph' => $main_data['first_paragraph'],
              'url' => $main_data['url'],
              'first_pid' => 0
            );
            $new_story_id = $this->story_model->create($new_story_data);
            $blocks_data = array();
            for ($i = 0; $i < count($other_data); $i++) {
              $blocks_data[$i] = array(
                'type' => $other_data[$i]['type'],
                'content' => ($other_data[$i]['type'] !== 'image' ? $other_data[$i]['content'] : (!empty($other_data[$i]['content']) ? json_decode($other_data[$i]['content'])->file : '')),
                'sid' => $new_story_id
              );
              $blocks_data[$i]['pid'] = $this->paragraph_model->create($blocks_data[$i]);
            }

            // update relation ids
            if (count($blocks_data) > 0) {
              $this->story_model->update(array('first_pid' => $blocks_data[0]['pid']), $new_story_id);

              for ($i = 0; $i < count($other_data); $i++) {
                $next_pid = $prev_pid = 0;
                if ($i > 0) {
                  $prev_pid = $blocks_data[$i - 1]['pid'];
                }
                if ($i < count($other_data) - 1) {
                  $next_pid = $blocks_data[$i + 1]['pid'];
                }
                $this->paragraph_model->update(array('prev_pid' => $prev_pid, 'next_pid' => $next_pid), $blocks_data[$i]['pid']);
              }
            }
          } else {
            $new_story_id = $main_data['id'];
            $new_story_data = array(
              'title' => $main_data['title'],
              'cid' => $main_data['cid'],
              'uuid' => $_SESSION['user']['uuid'],
              'thumb_image' => !empty($main_data['thumb_image']) ? json_decode($main_data['thumb_image'])->file : '',
              'cover_image' => !empty($main_data['cover_image']) ? json_decode($main_data['cover_image'])->file : '',
              'summary' => $main_data['summary'],
              'first_paragraph' => $main_data['first_paragraph'],
              'url' => $main_data['url'],
            );
            if (count($other_data) === 0) {
              $new_story_data['first_pid'] = 0;
            }
            $this->story_model->update($new_story_data, $main_data['id']);
            $existing_blocks = $this->paragraph_model->get('*', array('sid' => $main_data['id']), 0, 'pid', 'ASC');
            $blocks_data = array();
            $deleteids = array();
            for ($i = 0; $i < max(count($existing_blocks), count($other_data)); $i++) {
              if ($i < count($other_data)) {
                $blocks_data[$i] = array(
                  'type' => $other_data[$i]['type'],
                  'content' => ($other_data[$i]['type'] !== 'image' ? $other_data[$i]['content'] : (!empty($other_data[$i]['content']) ? json_decode($other_data[$i]['content'])->file : '')),
                  'caption' => ($other_data[$i]['type'] == 'image' ? $other_data[$i]['caption'] : (!empty($other_data[$i]['caption']) ? $other_data[$i]['caption'] : '')),
                  'sid' => $new_story_id
                );
  
                if ($i < count($existing_blocks)) {
                  $this->paragraph_model->update($blocks_data[$i], $existing_blocks[$i]['pid']);
                  $blocks_data[$i]['pid'] = $existing_blocks[$i]['pid'];
                } else {
                  $blocks_data[$i]['pid'] = $this->paragraph_model->create($blocks_data[$i]);
                }
              } else {
                $deleteids[] = $existing_blocks[$i]['pid'];
              }
            }

            if (count($deleteids)) {
              $this->paragraph_model->deleteRows($deleteids);
            }
            // update relation ids
            if (count($blocks_data) > 0) {
              $this->story_model->update(array('first_pid' => $blocks_data[0]['pid']), $new_story_id);

              for ($i = 0; $i < count($other_data); $i++) {
                $next_pid = $prev_pid = 0;
                if ($i > 0) {
                  $prev_pid = $blocks_data[$i - 1]['pid'];
                }
                if ($i < count($other_data) - 1) {
                  $next_pid = $blocks_data[$i + 1]['pid'];
                }
                $this->paragraph_model->update(array('prev_pid' => $prev_pid, 'next_pid' => $next_pid), $blocks_data[$i]['pid']);
              }
            }
          }
        } catch (Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
        $this->response(array(
          'message' => "A Story ".($main_data['id'] == '0' ? 'Created' : 'Updated')." Successfully!",
          'id' => $new_story_id
        ), 200);
      }
      break;
      case 'submit':
        $id = $post['id'];
        try {
          $this->story_model->update(array('status' => 'SUBMITTED'), $id);
          $this->response(array('message' => "This Story Submitted Successfully!"));
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'publish':
        $id = $post['id'];
        try {
          $this->story_model->update(array('status' => 'PUBLISHED'), $id);
          $this->response(array('message' => "This Story Published Successfully!"));
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'block':
        $id = $post['id'];
        try {
          $this->story_model->update(array('status' => 'BLOCKED'), $id);
          $this->response(array('message' => "This Story Blocked Successfully!"));
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'activate':
        $id = $post['id'];
        try {
          $this->story_model->update(array('status' => 'PUBLISHED'), $id);
          $this->response(array('message' => "This Story Activated Successfully!"));
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'delete':
        $id = $post['id'];
        try {
          $this->story_model->delete($id);
          $this->paragraph_model->delete(array('sid' => $id));
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
        }
      break;
      case 'delete_selected':
        $ids = $post['selectedIds'];
        try {
          $this->story_model->deleteRows($ids);
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

  function preview($slug) {
    $this->load_model('story');
    $this->load_model('paragraph');
    $this->load_model('category');
    $this->load_model('user');

    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/edit.js');

    $story = $this->story_model->get_one(array('url' => $slug));

    $this->view_data['post'] = $story;
    $this->view_data['paragraphs'] = $this->paragraph_model->get_paragraphs($story['sid']);
    $this->view_data['category'] = $this->category_model->get_one($this->view_data['post']['cid']);
    $this->view_data['author'] = $this->user_model->get_one($this->view_data['post']['uuid']);
    
    $this->load_view('/common/preview_story', $this->view_data);
  }

  function get_slug() {
    $title = $_POST['title'];
    $slug = preg_replace('/[^a-zA-Z0-9]+/', '-', strtolower($title));
    $this->load_model('story');
    $this->load_helper('string_helper');
    while ($this->story_model->slug_exists($slug)) {
      $slug .= generate_random_string(1);
    }
    $this->response(array('slug' => $slug));
  }
} 