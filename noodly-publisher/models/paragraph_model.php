<?php
class Paragraph_Model extends Core_Model{
  function __construct() {
    parent::__construct('paragraphs', 'pid');
  }

  function get_paragraphs($sid) {
    $paragraphs = $this->get('*', array('sid' => $sid), 0, 0, 'pid', 'ASC');
    $result = array();
    foreach ($paragraphs as $paragraph) {
      $result[$paragraph['pid']] = $paragraph;
    }
    return $result;
  }
}
