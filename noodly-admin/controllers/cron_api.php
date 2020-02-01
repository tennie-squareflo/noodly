<?php

class Cron_Api_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
  }

  function resize_all_story_images() {
    $this->load_library('simple_image');
    $story_image_path = ASSETS_PATH.'media/stories';
    $files = scandir($story_image_path);
    print_r($files);
    foreach ($files as $file) {
      $file_path = $story_image_path.'/'.$file;
      if (is_file($file_path)) {
        $this->simple_image->load($file_path);
        if ($this->simple_image->getWidth() > 1200) {
          echo '--- resizing '.$file_path.' ----<br/>';
          $this->simple_image->resizeToWidth(1200);
          $this->simple_image->save($file_path, $this->simple_image->getImageType());
          echo '--- resized '.$file_path.' ----<br/>';
        }
      }
    }
  }
}