<?php 
require "config/config.php";

$user_code=$_COOKIE["user_code"];

$key=md5($user_code.$salt1.$user_code.$salt1);

$key=substr($key, 0, 32); //32 charactors

// dectypt the string
$crypt = new proCrypt;
$decrypted=$in;
$decrypted=$crypt->decrypt($decrypted,$key);

$out=rtrim($decrypted);
?>