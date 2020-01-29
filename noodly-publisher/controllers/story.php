<?php
require_once(PUBLISHER_PATH.'core/auth_controller.php');

class Story_Controller extends Auth_Controller {
  function __construct() {
    parent::__construct(true, true);
  }

  function index($slug = '') {
    if ($slug === '') {
      $this->redirect_auth();

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
    } else {
      $this->view_story($slug, false);
    }
  }

  function edit($id = 0) {
    $this->redirect_auth();

    $this->view_data['style_files'] = array('vendors/custom/slim/slim.min.css', 'vendors/custom/quill/quill.snow.css', 'custom/publisher/story/edit.css');
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/quill/quill.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/edit.js');

    $this->load_model('story');
    $this->load_model('paragraph');
    $this->load_model('category');
    $this->load_model('client');

    $this->view_data['post'] = $this->story_model->get_one($id);
    $this->view_data['clients'] = $this->client_model->get_clients();
    $this->view_data['paragraphs'] = $this->paragraph_model->get_paragraphs($id);
    $this->view_data['categories'] = $this->category_model->get_category_names($this->pid);
    $this->view_data['is_new'] = count($this->view_data['post']) === 0;
    
    $this->load_view('/admin/edit_story', $this->view_data);
  }

  function change_status($sid, $status) {
    $this->load_model('story');
    $new_story_data = array(
      'status' => $status
    );
    $this->story_model->update($new_story_data, $sid);
    $story = $this->story_model->get_one($sid);
    header("Location: ".BASE_URL."story/view_story/".$story['url']);
  }

  function action($type) {
    $this->redirect_auth();

    $post = $_POST;
    $this->load_model('story');
    $this->load_model('paragraph');
    $this->load_model('client');
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
              'clientid' => $main_data['client_id'] === '' ? 0 : $main_data['client_id'],
              'uuid' => $_SESSION['user']['uuid'],
              'thumb_image' => !empty($main_data['thumb_image']) ? json_decode($main_data['thumb_image'])->file : '',
              'cover_image' => !empty($main_data['cover_image']) ? json_decode($main_data['cover_image'])->file : '',
              'summary' => $main_data['summary'],
              'visits' => 0,
              'hashtags' => $main_data['hashtags'],
              'status' => $post['type'] === 'save' ? ($_SESSION['user']['role'] === 'admin' ? 'PUBLISHED' : 'SUBMITTED') : ($post['type'] === 'client-draft' ? 'CLIENT-DRAFT' : 'DRAFT'),
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
                'caption' => ($other_data[$i]['type'] == 'image' ? $other_data[$i]['caption'] : (!empty($other_data[$i]['caption']) ? $other_data[$i]['caption'] : '')),
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

            // send emails
            $this->send_new_story_email($_SESSION['user']['uuid'], $_SESSION['user']['pid'], $new_story_id);
          } else {
            $new_story_id = $main_data['id'];
            $new_story_data = array(
              'title' => $main_data['title'],
              'cid' => $main_data['cid'],
              'clientid' => $main_data['client_id'] === '' ? 0 : $main_data['client_id'],
              'hashtags' => $main_data['hashtags'],
              'uuid' => $_SESSION['user']['uuid'],
              'thumb_image' => !empty($main_data['thumb_image']) ? json_decode($main_data['thumb_image'])->file : '',
              'cover_image' => !empty($main_data['cover_image']) ? json_decode($main_data['cover_image'])->file : '',
              'status' => $post['type'] === 'save' ? ($_SESSION['user']['role'] === 'admin' ? 'PUBLISHED' : 'SUBMITTED') : ($post['type'] === 'client-draft' ? 'CLIENT-DRAFT' : 'DRAFT'),
              'summary' => $main_data['summary'],
              'first_paragraph' => $main_data['first_paragraph'],
              'url' => $main_data['url'],
              'hashtags' => $main_data['hashtags']
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

          if ($post['type'] === 'client-draft') {
            $this->send_to_client($_SESSION['user']['uuid'], $main_data['client_id'], $main_data['url'], $main_data['title']);
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
      case 'addclient':
        $this->load_helper('validation');
        $firstname = test_input($_POST['firstname']);
        $lastname = test_input($_POST['lastname']);
        $email = test_input($_POST['email']);
        $company = test_input($_POST['company']);

        try {
          $new_data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'company' => $company
          );
          $new_id = $this->client_model->create(array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'company' => $company
          ));
          $this->response(array(
            'message' => "Client Registered Successfully",
            'data' => json_encode(array(
              'cid' => $new_id,
              'firstname' => $firstname,
              'lastname' => $lastname,
              'email' => $email,
              'company' => $company
            ))
          ), 200);
        } catch(Exception $e) {
          $this->response(array(
            'message' => $e->getMessage()
          ), 500);
          return;
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

  function send_to_client($author_id, $client_id, $slug, $title) {
    // handle send message
    $this->load_model('user');
    $this->load_model('environment');
    $this->load_model('client');
    $this->load_library('encryption', true);

    $author = $this->user_model->get_one($author_id);
    $client = $this->client_model->get_one($client_id);
    $env = $this->environment_model->get_env();

    $view_data = array();
    $subject = "$author[firstname] has requested a story to approve - ".date('g:i a m/d/Y');
    $view_data['title'] = "$author[firstname] has posted a story";

    $token = array(
      'slug' => $slug,
      'client_id' => $client_id,
      'client_email' => $client['email']
    );

    $link = "/accept/approve_story/".Encryption::encrypt($token);
    $view_data['client'] = $client;
    $view_data['message'] = "$author[firstname] has just submitted a new story entitled $title";
    $this->send_grid_mail($client, $this->pid, $subject, $link, 'approve_story', $view_data);
  }

  function send_new_story_email($uuid, $pid, $sid) {
    $this->redirect_auth();

    $this->load_model('user');
    $this->load_model('publisher');
    $this->load_model('story');
    $this->load_library('encryption', true);
    $this->load_model('environment');

    $author = $this->user_model->get_one($uuid);
    $admins = $this->publisher_model->get_admins($pid);
    $story = $this->story_model->get_one($sid);
    $env = $this->environment_model->get_env();
    $expiration_time = time() + (60 * $env['email_expiration_time']);
    
    foreach ($admins as $admin) {
      $view_data = array();
      $subject = "$author[firstname] has posted a story - ".date('g:i a m/d/Y');
      $view_data['title'] = "$author[firstname] has posted a story";

      $token = array(
        'expiration_time' => $expiration_time,
        'uuid' => $admin['uuid'],
        'sid' => $sid
      );
      
      $link = "/accept/story/".Encryption::encrypt($token);
      $view_data['admin_name'] = $admin['firstname'];
      $view_data['message'] = "$author[firstname] has just submitted a new story entitled $story[title]";
      $this->send_email($admin['uuid'], $pid, $subject, $link, 'post_story', $view_data);
    }
  }

  function view_story($slug, $preview = true) {
    $this->load_model('story');
    $this->load_model('category');
    $this->load_model('user');
    $story = $this->story_model->get_one(array('url' => $slug));

    if ($story['status'] === 'CLIENT-DRAFT' && !empty($_SESSION['client']) && $story['url'] === $_SESSION['client']['slug'] && intval($story['client_view']) < 25) {
      // increase client view      
      $this->story_model->increase_client_view($story['sid']);
      $this->view_data['client'] = $_SESSION['client'];
    }
    $this->show_story($story, $preview);
  }
  function show_story($story, $preview = true) {
    $this->view_data['script_files'] = array('vendors/custom/slim/slim.kickstart.min.js', 'vendors/custom/slim/slim.jquery.min.js', 'custom/publisher/story/story_view.js');
    
    if($preview === false) {
      $this->story_model->visits_plus($story['url']);
    }
    $this->load_model('category');
    $this->load_model('user');
    $this->view_data['prev_story'] = $this->story_model->get_prev_story($story['sid'], $story['pid']);
    $this->view_data['next_story'] = $this->story_model->get_next_story($story['sid'], $story['pid']);
    $this->view_data['post'] = $story;
    $this->view_data['category'] = $this->category_model->get_one($this->view_data['post']['cid']);
    $this->view_data['author'] = $this->user_model->get_one($this->view_data['post']['uuid']);
    $this->view_data['trendings'] = $this->category_model->get_channels($this->pid, 'most_popular', 5);
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