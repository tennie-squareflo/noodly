<?php

class Database
{
    private static $link = null;
    private static $info = array(
        'last_query' => null,
        'num_rows' => null,
        'insert_id' => null,
    );
    private static $connection_info = array();

    private static $where;
    private static $limit;
    private static $order;
    private static $offset;

    public function __construct($host, $user, $pass, $db)
    {
        self::$connection_info = array('host' => $host, 'user' => $user, 'pass' => $pass, 'db' => $db);
    }

    public function __destruct()
    {
        if (is_resource(self::$link)) {
            mysqli_close(self::$link);
        }

    }

    /**
     * Setter method
     */

    private static function set($field, $value)
    {
        self::$info[$field] = $value;
    }

    /**
     * Getter methods
     */

    public function last_query()
    {
        return self::$info['last_query'];
    }

    public function num_rows()
    {
        return self::$info['num_rows'];
    }

    public function insert_id()
    {
        return self::$info['insert_id'];
    }

    /**
     * Create or return a connection to the MySQL server.
     */

    private static function connection()
    {
        if (!self::$link || empty(self::$link)) {
            if (($link = mysqli_connect(self::$connection_info['host'], self::$connection_info['user'], self::$connection_info['pass'])) && mysqli_select_db($link, self::$connection_info['db'])) {
                self::$link = $link;
                mysqli_set_charset(self::$link, 'utf8');
            } else {
                throw new Exception('Could not connect to MySQL database.');
            }
        }
        return self::$link;
    }

    /**
     * MySQL Where methods
     */

    private static function __where($info, $type = 'AND', $escape = true)
    {
        self::connection();
        $where = self::$where;
        foreach ($info as $row => $value) {
            $real_row = "`".$row."`";
            if (empty($where)) {
                if (is_array($value)) {
                    $where .= sprintf("WHERE %s in (%s)", $real_row, mysqli_real_escape_string(self::$link, join(', ', $value)));
                }
                else {
                    $value = $escape ? "'".mysqli_real_escape_string(self::$link, $value)."'" : mysqli_real_escape_string(self::$link, $value);
                    $where .= sprintf("WHERE %s=%s", $real_row, $value);
                }
            } else {
                if (is_array($value)) {
                    $where .= sprintf(" %s in (%s)", $real_row, mysqli_real_escape_string(self::$link, join(', ', $value)));
                }
                else {
                    $value = $escape ? "'".mysqli_real_escape_string(self::$link, $value)."'" : mysqli_real_escape_string(self::$link, $value);
                    $where .= sprintf(" %s %s=%s", $type, $real_row, $value);
                }
            }
        }
        self::$where = $where;
    }

    public function where($field, $equal = null, $escape = true)
    {
        if (is_array($field)) {
            self::__where($field, 'AND', $escape);
        } else {
            self::__where(array($field => $equal), 'AND', $escape);
        }
        return $this;
    }

    public function and_where($field, $equal = null)
    {
        return $this->where($field, $equal);
    }

    public function or_where($field, $equal = null)
    {
        if (is_array($field)) {
            self::__where($field, 'OR');
        } else {
            self::__where(array($field => $equal), 'OR');
        }
        return $this;
    }

    /**
     * MySQL limit method
     */

    public function limit($limit)
    {
        self::$limit = 'LIMIT ' . $limit;
        return $this;
    }

    public function offset($offset) {
        self::$offset = 'OFFSET '.$offset;
        return $this;
    }

    /**
     * MySQL Order By method
     */

    public function order_by($by, $order_type = 'DESC')
    {
        $order = self::$order;
        if (is_array($by)) {
            foreach ($by as $field => $type) {
                if (is_int($field) && !preg_match('/(DESC|desc|ASC|asc)/', $type)) {
                    $field = $type;
                    $type = $order_type;
                }
                if (empty($order)) {
                    $order = sprintf("ORDER BY `%s` %s", $field, $type);
                } else {
                    $order .= sprintf(", `%s` %s", $field, $type);
                }
            }
        } else {
            if (empty($order)) {
                $order = sprintf("ORDER BY `%s` %s", $by, $order_type);
            } else {
                $order .= sprintf(", `%s` %s", $by, $order_type);
            }
        }
        self::$order = $order;
        return $this;
    }

    /**
     * MySQL query helper
     */

    private static function extra()
    {
        $extra = '';
        if (!empty(self::$where)) {
            $extra .= ' ' . self::$where;
        }

        if (!empty(self::$order)) {
            $extra .= ' ' . self::$order;
        }

        if (!empty(self::$limit)) {
            $extra .= ' ' . self::$limit;
        }

        if (!empty(self::$offset)) {
            $extra .= ' ' .self::$offset;
        }

        // cleanup
        self::$where = null;
        self::$order = null;
        self::$limit = null;
        self::$offset = null;
        return $extra;
    }

    /**
     * MySQL Query methods
     */

    public function query($qry, $return = false)
    {
        self::connection();
        self::set('last_query', $qry);
        $result = mysqli_query(self::$link, $qry);
        if (is_resource($result)) {
            self::set('num_rows', mysqli_num_rows($result));
        }
        if ($return) {
            if (preg_match('/LIMIT 1/', $qry)) {
                $data = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                return $data;
            } else {
                $data = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                mysqli_free_result($result);
                return $data;
            }
        }
        return true;
    }

    public function get($table, $select = '*')
    {
        self::connection();
        if (is_array($select)) {
            $cols = '';
            foreach ($select as $col) {
                $cols .= "`{$col}`,";
            }
            $select = substr($cols, 0, -1);
        }
        $is_one = self::$limit === 'LIMIT 1';
        $sql = sprintf("SELECT %s FROM %s%s", $select, $table, self::extra());
        self::set('last_query', $sql);

        if (!($result = mysqli_query(self::$link, $sql))) {
            throw new Exception('Error executing MySQL query: ' . $sql . '. MySQL error ' . mysqli_errno(self::$link) . ': ' . mysqli_error(self::$link));
            $data = false;
        } else {
            $num_rows = mysqli_num_rows($result);
            self::set('num_rows', $num_rows);
            if ($num_rows === 0) {
                $data = array();
            //} elseif (preg_match('/LIMIT 1/', $sql)) {
            } elseif ($is_one) {
                $data = mysqli_fetch_assoc($result);
            } else {
                $data = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
        }
        return $data;
    }

    public function insert($table, $data)
    {
        self::connection();
        $fields = '';
        $values = '';
        foreach ($data as $col => $value) {
            $fields .= sprintf("`%s`,", $col);
            $values .= sprintf("'%s',", mysqli_real_escape_string(self::$link, $value));
        }
        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)", $table, $fields, $values);
        self::set('last_query', $sql);
        if (!mysqli_query(self::$link, $sql)) {
            throw new Exception('Error executing MySQL query: ' . $sql . '. MySQL error ' . mysqli_errno(self::$link) . ': ' . mysqli_error(self::$link));
        } else {
            self::set('insert_id', mysqli_insert_id(self::$link));
            return true;
        }
    }

    public function update($table, $info, $escape = true)
    {
        if (empty(self::$where)) {
            throw new Exception("Where is not set. Can't update whole table.");
        } else {
            self::connection();
            $update = '';
            foreach ($info as $col => $value) {
                if ($escape) {
                    $update .= sprintf("`%s`='%s', ", $col, mysqli_real_escape_string(self::$link, $value));
                } else {
                    $update .= sprintf("`%s`=%s, ", $col, mysqli_real_escape_string(self::$link, $value));
                }
                
            }
            $update = substr($update, 0, -2);
            $sql = sprintf("UPDATE %s SET %s%s", $table, $update, self::extra());
            self::set('last_query', $sql);
            if (!mysqli_query(self::$link, $sql)) {
                throw new Exception('Error executing MySQL query: ' . $sql . '. MySQL error ' . mysqli_errno(self::$link) . ': ' . mysqli_error(self::$link));
            } else {
                return true;
            }
        }
    }

    public function delete($table)
    {
        if (empty(self::$where)) {
            throw new Exception("Where is not set. Can't delete whole table.");
        } else {
            self::connection();
            $sql = sprintf("DELETE FROM %s%s", $table, self::extra());
            self::set('last_query', $sql);
            if (!mysqli_query(self::$link, $sql)) {
                throw new Exception('Error executing MySQL query: ' . $sql . '. MySQL error ' . mysqli_errno(self::$link) . ': ' . mysqli_error(self::$link));
            } else {
                return true;
            }
        }
    }

    public function begin_transaction() {
        self::connection();
        mysqli_begin_transaction(self::$link);
    }

    public function commit() {
        self::connection();
        mysqli_commit(self::$link);
    }
    public function rollback() {
        self::connection();
        mysqli_rollback(self::$link);
    }
}
