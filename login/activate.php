
<html>
<head>


<?php
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";


if($_GET["userid"]!="")
{
$userid=$_GET["userid"];
require "config/config.php";

 $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');
	

    $usercode_query="UPDATE $db_table SET activate = '1' WHERE usercode = '$userid'";
    $usercode_result = mysql_query($usercode_query) or die('The');
	$query= "SELECT user_name FROM $db_table WHERE usercode = '$userid' AND activate = '1'";
	//echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    if($row = mysql_fetch_array($result)) {
	echo '<META HTTP-EQUIV="refresh" CONTENT="2; URL=login.php">';
	echo '</head>';
	echo '<body>';
		 echo 'Your account has been successfully registered.';
		 
	addLog($logPath,time(),$row['user_name'],$row['user_name']." has been successfully activated");
			}
			else 
			{
			echo '<META HTTP-EQUIV="refresh" CONTENT="3; URL=activate_needed.php">';
			echo '</head>';
			echo '<body>';
			echo 'Activation code is invalid.';
			}
	


}
	
?>

</body>
</html>