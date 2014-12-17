<?php
require "config/config.php";
require "checklogin.php";
require "log/log.php";
$user = ucwords(strtolower($_COOKIE["upload_user"]));
if(checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false){
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
else{
addLog($logPath,time(),ucwords(strtolower($_COOKIE["upload_user"])),ucwords(strtolower($_COOKIE["upload_user"]))." has logged out");
    if(setcookie("upload_user", "", time()-3600)&&setcookie("user_code", "", time()-3600)){
        echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
        echo '<meta http-equiv="refresh" content="0;url=login.php">';
    }
    else{
        echo '<head><link href="style.css" type="text/css" rel="stylesheet" /></head>';
        echo '<a class="error">Error, could not logout. Please check to see that cookies are enabled.</a>';
    }
}
?>