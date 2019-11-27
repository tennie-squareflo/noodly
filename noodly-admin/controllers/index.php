<?php
class Index_Controller {
  function index() {
    header('Location: '.BASE_URL.'dashboard');
  }
}
