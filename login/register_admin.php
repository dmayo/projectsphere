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

function adduser($user,$pass ,$pass1)
{
require "config/config.php";
$pass= ereg_replace("[^A-Za-z0-9]", "", $pass);
$user = ereg_replace("[^A-Za-z0-9]", "", $user);
$pass=strtolower($pass);
$user=strtolower($user);
$pass1= ereg_replace("[^A-Za-z0-9]", "", $pass1);
$user1 = ereg_replace("[^A-Za-z0-9]", "", $user1);
$pass1=strtolower($pass1);
$user1=strtolower($user1);
//$email1= ereg_replace("[^A-Za-z0-9]", "", $email1);

$empty='';

if($user=='')
{
$empty=1;

}
if($pass==''||$pass1=='')
{
$empty=1;
}

if($empty==1)
{

$msg='
<script type="text/javascript">
document.getElementById("password").value="";
document.getElementById("password1").value="";
</script>
You have left at least one field empty.
';
return $msg;
}
elseif($pass!=$pass1)
{
$msg='
<script type="text/javascript">
document.getElementById("password").value="";
document.getElementById("password1").value="";
</script>
The passwords do not match.';
return $msg;
}
elseif($email!=$email1)
{
$msg='
<script type="text/javascript">
document.getElementById("password").value="";
document.getElementById("password1").value="";
</script>
The emails do not match.';
return $msg;
}
else
{
require "config/config.php";
 $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');

    $query= "SELECT * FROM $db_table WHERE user_name='$user'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    while($row = mysql_fetch_array($result)) {
        if( $row['user_name']==$user) {
		$msg='
		<script type="text/javascript">
		document.getElementById("password").value="";
		document.getElementById("password1").value="";
		</script>
		There already is an Admin account.';
		return $msg;
		
            }
			}
			



$pass= encrypt1 ($pass,$salt);
$msg=$pass;


$rndcode=new rndPass(50);
    $usercode=$rndcode->PassGen();
 $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database ,$link ) or die('Could not select database');
	
	
	$query="INSERT INTO  $db_table ( user_name, password, usercode, filespace, activate) VALUES ('$user','$pass','$usercode','100','1')";
	
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
	
	
	
	
	
	addLog($logPath,time(),$user,"Admin Account Created");
	$msg="
	<script type=\"text/javascript\">
	<!--
	window.location = \"login.php\"
	//-->
	</script>";
	
	return $msg;
}
}
$ajax = new PHPLiveX(array("adduser"));  
?>


<html>
<head>
        <link href="style.css" type="text/css" rel="stylesheet" />	
		<?php
		$ajax->Run(); 
		?> <!-- Can be called between body tags as well -->  
		<script type="text/javascript">
		
		   function test(){
		//alert("pie");
                username = "administrator";
               password = document.getElementById("password").value;
			password1 = document.getElementById("password1").value;
			 
		//alert(username+password+password1+email+email1);
		adduser (username, password,password1, {"method":"POST",'target':'msg','preloader':'pr'});
              // adduser (username, password,password1,email,email1 {"method":"POST",'target':'msg','preloader':'pr'});
                
            }
		</script>
        <script type="text/javascript">
		//alert("pie");
         
        </script>

</head>
<body>
Register
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>
        <form name="register">
            <div align="center" style="padding-top:10px;font-size:220%;font-weight:bold;">File Manager</div>
            <div align="center" style="padding-bottom:8px;">David Mayo and Albert Shaw</div>
            <table border="0" align="center" cellspacing="0" cellpadding="5">
                <tr>
                    <td>
                        User Name:
                    </td>
                    <td>
                        Administrator
                    </td>
                </tr>
                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <input type="password" id="password" maxlength="50">
                    </td>
                </tr>
				<tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td>
                        <input type="password" id="password1" maxlength="50">
                    </td>
                </tr>
               <tr>
                    <td align="center" colspan="2">
                        <input type="submit" value="Login" onclick="test();return false;">
                    </td>
                </tr>
            </table>
        </form>
        <div id="msg" align="center" class="error"></div>
        <script language="JavaScript">
		
            <!--
            document.register.username.focus();
            //-->
        </script>
</body>
</html>