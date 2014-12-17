<?php
function url_encrypt($message)
{
require "config/config.php";

$user_code=$_COOKIE["user_code"];

$key=md5($user_code.$salt1.$user_code.$salt1);
$key=substr($key, 0, 32); //32 charactors

// a new proCrypt instance
$crypt = new proCrypt;

// encrypt the string
$encoded = $crypt->encrypt($message,$key);

$encoded=urlencode($encoded);

return $encoded;
}

function url_decrypt($encoded){
require "config/config.php";

$user_code=$_COOKIE["user_code"];

$key=md5($user_code.$salt1.$user_code.$salt1);
$key=substr($key, 0, 32); //32 charactors
// dectypt the string

$decrypted=urldecode($encoded);
$decrypted=$crypt->decrypt($decrypted,$key);
$decrypted=rtrim($decrypted);

return $decrypted;

}
?>