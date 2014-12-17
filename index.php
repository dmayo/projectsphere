<?php
require "login/checklogin.php";
require "login/config/config.php";

if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false) {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
	echo '<meta http-equiv="refresh" content="0;url=login/login.php">';
}
else{
	echo 'Hi '+$_COOKIE["upload_user"];
	echo "it works";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Sphere</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    Works!<br />
    <a href="login/logout.php">logout</a>
  </body>
</html>

<?php
}

?>