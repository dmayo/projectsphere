<?php
function checklogin($db_server, $db_username, $db_password, $db_database, $username, $usercode){
    if(isset($_COOKIE["upload_user"])&&isset($_COOKIE["user_code"])){
        $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
        //Select the database
        mysql_select_db($db_database) or die('Could not select database');
        $query= "SELECT id, user_name FROM users WHERE usercode='$usercode'";
        $result = mysql_query($query) or die('Query failed: ' . mysql_error());
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
		$c_username=0;
		if($username==$line['user_name']){
			$c_username=1;
			$id=$line['id'];
		}
        if($c_username==1){
			if(isset($_COOKIE["remember"])){
			if($_COOKIE["remember"]==1){
				setcookie("upload_user", $username, time()+60*60*24*365*10, '/');
				setcookie("user_code", $usercode, time()+60*60*24*365*10, '/');  
				setcookie("remember", "1", time()+60*60*24*365*10, '/'); 
			}
			}
			else{
				setcookie("upload_user", $username, time()+3600, '/');  //expire in 1 hour
				setcookie("user_code", $usercode, time()+3600, '/');    //expire in 1 hour
			}
			return $id;
        }
        else {
            return false;
        }	
    }
    else{
        return false;
    }
}
?>