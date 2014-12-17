
<html>
<head>
        <title>File Manager Reset Password</title>
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
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>
<div class="ui-widget-content" id="loginbox" style="width:450px;height:350px;margin:0 auto;text-align:center;">
<h3 class="ui-widget-header" id="header">File Manager Reset Password</h3>
<div align="center" style="padding-top:40px;font-size:220%;font-weight:bold;"><img src="images/logo.png" border="0" height="70" width="257" /></div>
<?php
$userid=$_GET['userid'];
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";

function encrypt1 ($pass,$salt){
	$pass=md5($salt.$pass.$salt);
	return $pass;	
}
echo '<span style="font-size:105%;">Please enter a new password for your account.<span><br /><br />';
if($_GET["userid"]!=""){
echo '
<form action="reset1.php?userid='.$userid.'" method="post" >
<table border="0" align="center" cellspacing="0" cellpadding="8">
    <tr>
		<td>Password:</td>
		<td><input type="password" name="pass" value="" /></td>
	</tr>
	<tr>
		<td>Confirm Password:</td>
		<td><input type="password" name="pass1" value="" /></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" value="Reset Password"/></td>
	</tr>
<table>
</form>';

}
	
?>

</body>
</html>