<?php
require "login/checklogin.php";
require "login/config/config.php";

if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false) {
  echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
	echo '<meta http-equiv="refresh" content="0;url=login/login.php">';
}
else{
  echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
  echo '<meta http-equiv="refresh" content="0;url=test/index.html">';
}

?>