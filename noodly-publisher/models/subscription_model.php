<?php

class Subscription_Model extends Core_Model {
  function __construct() {
    parent::__construct('subscription', 'id');
  }

  function get_subscription($pid = 0) {
    $query = "SELECT * 
    FROM   (SELECT subscription.id, 
                   subscription.firstname, 
                   subscription.email, 
                   subscription.pid, 
                   subscription.type,
                   subscription.refinfo info 
            FROM   subscription 
            WHERE  type = 'hashtag' 
            UNION 
            SELECT subscription.id, 
                   subscription.firstname, 
                   subscription.email, 
                   subscription.pid, 
                   subscription.type,
                   (SELECT publishers.NAME 
                    FROM   publishers 
                    WHERE  publishers.pid = subscription.refid) info 
            FROM   subscription 
            WHERE  type = 'publisher' 
            UNION 
            SELECT subscription.id, 
                   subscription.firstname, 
                   subscription.email, 
                   subscription.pid, 
                   subscription.type,
                   (SELECT Concat(users.firstname, Ifnull(users.lastname, '')) 
                    FROM   users 
                    WHERE  users.uuid = subscription.refid) info 
            FROM   subscription 
            WHERE  type = 'contributor' 
            UNION 
            SELECT subscription.id, 
                   subscription.firstname, 
                   subscription.email, 
                   subscription.pid, 
                   subscription.type,
                   (SELECT categories.NAME 
                    FROM   categories 
                    WHERE  categories.cid = subscription.refid) info 
            FROM   subscription 
            WHERE  type = 'channel') results 
    WHERE  pid = $pid";
    return $this->db->query($query, true);
  }

  function get_contributor_subscription($pid = 0, $uuid = 0) {
    $query = "SELECT subscription.id, 
                   subscription.firstname, 
                   subscription.email, 
                   subscription.pid, 
                   subscription.type,
                   (SELECT Concat(users.firstname, Ifnull(users.lastname, '')) 
                    FROM   users 
                    WHERE  users.uuid = subscription.refid) info 
            FROM   subscription 
            WHERE  type = 'contributor' AND pid = $pid";
    return $this->db->query($query, true);
  }
}
