<?php

class Api_Controller extends Core_Controller {
  function __construct() {
    parent::__construct('admin');
  }

  public function avatar_upload() {
    $this->load_library('slim_image_uploader');
    $this->slim_image_uploader->image_upload('avatar', ASSETS_PATH.'media/avatars/');
  }
}