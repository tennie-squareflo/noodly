<?php

function setDomain() {
  $ip = "45.33.88.101";
  $root_pass = "8wMf22Mj$*ee";
  $account = "noodlyadmin";
  $email_account = "randomemail";
  $email_domain = "somedomain.com";
  $xmlapi = new xmlapi($ip, "noodlyadmin", "8wMf22Mj$*ee");
  $xmlapi->set_debug(1);
  $xmlapi->api2_query($account, 
    "AddonDomain", 
    "addaddondomain", 
    array(
      "newdomain" => "example.com", 
      "dir" => "public_html/example", 
      "subdomain" => "example", 
      "pass" => "ftpPass"
  ));
}