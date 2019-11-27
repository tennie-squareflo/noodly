<?php
class Index_Controller {
  function index() {
    header('Location: '.BASE_PATH.'dashboard');
  }
}
