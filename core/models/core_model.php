<?php
class Core_Model {
  protected $db;
  protected $table_name;
  protected $pk;
  
  function __construct($tbl_name = '', $primarykey = '') {
    $this->db = App::get_instance()->db;
    $this->table_name = $tbl_name;
    $this->pk = $primarykey;
  }
  function get($where = array()) {
    if (!empty($where)) {
      $this->db->where($where);
    }
    return $this->db->get($this->table_name);
  }
  function get_one($where = array()) {
    if (!empty($where)) {
      $this->db->where($where);
    }
    return $this->db->limit(1)->get($this->table_name);
  }
  function count($where = array()) {
    if (!empty($where)) {
      $this->db->where($where);
    }
    return $this->db->limit(1)->get($this->table_name, "count($this->count) cnt")->cnt;
  }
  function create($data) {
    if ($this->db->insert($this->table_name, $data)) {
      return $this->insert_id();
    } else {
      return false;
    }
  }
}