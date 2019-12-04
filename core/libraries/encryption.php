<?php

class Encryption {
  private static $password = 'noodlyadmin';
  private static $salt = 'noodlysometext';

  public static function encrypt($data) {
    $plain_text = '';
    if (is_array($data)) {
      $plain_text .= json_encode($data);
    } else {
      $plain_text .= $data;
    }

    $plain_text .= self::$salt;

    return base64_encode(openssl_encrypt($plain_text, "AES-128-ECB", self::$password));
  }

  public static function decrypt($cypher) {
    $plain_text = openssl_decrypt(base64_decode($cypher), "AES-128-ECB", self::$password);

    $plain_text = substr($plain_text, 0, -strlen(self::$salt));
    return json_decode($plain_text, true);
  }
}