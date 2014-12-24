<?php
if($_COOKIE["upload_user"]=="administrator"){
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
    echo '<meta http-equiv="refresh" content="0;url=admin.php">';
}
else{
require "config/config.php";
require "checklogin.php";

if(checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false) {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
else {
	
	require "phplivex/PHPLiveX.php";
	require "encrypt/encrypt.php";
	require "log/log.php";
	$user = ucwords(strtolower($_COOKIE["upload_user"]));
	$name=$user;

?>
<html>
<head>
        <title>Project Sphere Reset Password</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
        <link href="style.css" type="text/css" rel="stylesheet" />

        <script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <link rel="stylesheet" href="newlogin.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active" id="login">
                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
                        <form class="form-signin" method="post" action="change.php" name="register">
                            <input type="password" class="form-control form-signin-Top" placeholder="Current Password" name="current" maxlength="50" required autofocus>
                            <input type="password" class="form-control form-signin-Middle" placeholder="New Password" name="pass" maxlength="50" required>
                            <input type="password" class="form-control form-signin-Bottom" placeholder="Confirm New Password" name="pass1" maxlength="50" required>
                            <input type="submit" class="btn btn-lg btn-default btn-block" value="Change Password" onclick="Submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br /><span class="error"><?php if(isset($_GET["message"])){ echo $_GET["message"];} ?></span>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
<?php
}
}
?>