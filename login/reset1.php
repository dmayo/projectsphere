
<html>
<head>
    <title>Project Sphere Reset Password</title>
	<link rel="shortcut icon" href="images/favicon.ico" />
    <link href="style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
</head>
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>

<?php
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";

function encrypt1 ($pass,$salt)
{
	$pass=md5($salt.$pass.$salt);
	return $pass;	
}	


if(isset($_GET['userid'])&&$_GET['userid']!=""){
	$userid=$_GET['userid'];
	$pass=$_POST['pass'];
	$pass1=$_POST['pass1'];
	$pass2=ereg_replace("[^A-Za-z0-9]", "", $pass);
	if($pass!=""||$pass1!=""){
		if($pass==$pass2){
			if($pass==$pass1){

				require "config/config.php";

			 	$link = mysql_connect($db_server, $db_username, $db_password)
			        or die('Could not connect: ' . mysql_error());
					
			    //Select the database
			    mysql_select_db($db_database,$link ) or die('Could not select database');
				
				
				$pass=ereg_replace("[^A-Za-z0-9]", "", $pass);
				$pass1= encrypt1 ($pass,$salt);
			    $query="UPDATE $db_table SET password = '$pass1' WHERE usercode = '$userid'";
				//   echo $query;
			     mysql_query($query) or die('Query failed: ' . mysql_error());
				
			    $query1= "SELECT user_name FROM $db_table WHERE usercode='$userid'";
			    $result = mysql_query($query1) or die('Query failed: ' . mysql_error());

				$row = mysql_fetch_array($result);
				$user=$row['user_name'];
				//echo $query;
			    
				//echo "pass:".$pass."<br />salt:".$salt;
				$ip=$_SERVER['REMOTE_ADDR'];
				addLog($logPath,time(),ucwords(strtolower($user)),ucwords(strtolower($user)) . " has reset his password, IP: $ip");
				echo "Your password has been successfully changed";
				echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=login.php">';

			}
			else{
				echo "Your passwords did not match";
				echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=reset.php?'.$userid.'">';
			}
		}
		else{
			echo "Your password characters other than numbers and letters it";
			echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=reset.php?'.$userid.'">';
		}
	}
	else{
		echo "You one or more fields empty";
		echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=reset.php?'.$userid.'">';
	}
}
else{
	echo 'Error: invalid user id';
}
?>
</div>
</body>
</html>