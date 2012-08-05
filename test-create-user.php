<?php
include_once(__DIR__ . '/inc/init.php');

$student_no = '5110379057';
$h = acm_userpass_hash('5110379057');
$name = '解东';
$ip_address = '127.0.0.1';
$ip_address = sprintf("%u", ip2long($ip_address));

$db->translatedQuery(
  'INSERT INTO users(student_no,pass,salt,iter,ip_address,display_name)' .
  'VALUES(%s,%s,%s,%i,%s,%s)',
  $student_no, $h['pass'], $h['salt'], $h['iter'], $ip_address, $name
);
