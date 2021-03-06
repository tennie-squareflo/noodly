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


  // begin, commit, rollback transactions
  function begin_transaction() {
    $this->db->begin_transaction();
  }
  function trans_commit() {
    $this->db->commit();
  }
  function trans_rollback() {
    $this->db->rollback();
  }

  function get($select, $where = array(), $limit = 0, $start = 0, $by = '', $order_type = 'DESC') {
    if (isset($where)) {
      if (!is_array($where)) {
        $this->db->where(array($this->pk => $where));
      } else if(!empty($where)) {
        $this->db->where($where);
      }
    }
    if ($limit > 0) {
      $this->db->limit($limit);
      $this->db->offset($start);
    }
    if ($by) {
      $this->db->order_by($by, $order_type);
    } else {
      $this->db->order_by($this->pk);
    }
    return $this->db->get($this->table_name, $select);
  }
  function get_one($where = array()) {
    if (isset($where)) {
      if (!is_array($where)) {
        $this->db->where(array($this->pk => $where));
      } else if(!empty($where)) {
        $this->db->where($where);
      }
    }
    return $this->db->limit(1)->get($this->table_name);
  }
  function count($where = array()) {
    if (isset($where)) {
      if (!is_array($where)) {
        $this->db->where(array($this->pk => $where));
      } else if(!empty($where)) {
        $this->db->where($where);
      }
    }
    return $this->db->limit(1)->get($this->table_name, "count($this->pk) cnt")['cnt'];
  }
  function create($data) {
    if ($this->db->insert($this->table_name, $data)) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }
  function deleteRows($ids) {
    $this->db->where(array($this->pk => $ids));
    return $this->db->delete($this->table_name);
  }
  function delete($where = array()) {
    if (isset($where)) {
      if (!is_array($where)) {
        $this->db->where(array($this->pk => $where));
      } else if(!empty($where)) {
        $this->db->where($where);
      }
    }
    return $this->db->delete($this->table_name);
  }
  function update($new_data, $where = array(), $escape = true) {
    if (isset($where)) {
      if (!is_array($where)) {
        $this->db->where(array($this->pk => $where));
      } else if(!empty($where)) {
        $this->db->where($where);
      }
    }
    return $this->db->update($this->table_name, $new_data, $escape);
  }

}