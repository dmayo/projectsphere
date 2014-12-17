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
        <title>File Manager</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
        <link href="style.css" type="text/css" rel="stylesheet" />
		<link type="text/css" href="jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="jquery.corner.js"></script>
		<script type="text/javascript">
			$("#loginbox").corner();
			$("#header").corner("top");
		</script>
</head>
<body>
	<div class="ui-widget-content" id="loginbox" style="width:450px;height:350px;margin:25 auto;text-align:center;">
	<h3 class="ui-widget-header" id="header">Change Password</h3>
		<form method="post" action="change.php" name="register">
		<div align="center" style="padding-top: 30px; font-size: 220%; font-weight: bold;"><img width="257" height="70" border="0" src="images/logo.png"></div>
            <div align="center" style="padding-top:0px;padding-bottom:5px;font-size:120%;font-weight:bold;"><?php echo $user; ?></div>
            <table border="0" align="center" cellspacing="0" cellpadding="5" height="150px" style="font-size:105%;">          
                <tr>
                    <td>
                        Current Password:
                    </td>
                    <td>
                        <input type="password" name="current" maxlength="50">
                    </td>
                </tr>
				<tr>
                    <td>
                        New Password:
                    </td>
                    <td>
                        <input type="password" name="pass" maxlength="50">
                    </td>
                </tr>
				<tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td>
                        <input type="password" name="pass1" maxlength="50">
                    </td>
                </tr>
               <tr>
                    <td align="center" colspan="2">
                        <input type="submit" value="Submit" onclick="Submit">
                    </td>
                </tr>
            </table>
        </form>
		<script language="JavaScript">
            <!--
            document.register.current.focus();
            //-->
        </script>
<br /><span class="error"><?php echo $_GET["message"];?></span>
</body>
<?php
}
}
?>