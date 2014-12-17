<?php
require "config/config.php";

$user_code=$_COOKIE["user_code"];

$key=md5($user_code.$salt1.$user_code.$salt1);
$key=substr($key, 0, 32); //32 charactors

// a new proCrypt instance
$crypt = new proCrypt;

// encrypt the string
$encoded = $crypt->encrypt($in,$key);

$out=urlencode($encoded);

?>