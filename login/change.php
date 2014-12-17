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
	function encrypt ($pass,$salt){
	$pass=md5($salt.$pass.$salt);
	return $pass;
}	
	require "phplivex/PHPLiveX.php";
	require "encrypt/encrypt.php";
	require "log/log.php";
	$user = strtolower($_COOKIE["upload_user"]);
	$name=$user;

	$old=$_POST["current"];
	$new=$_POST["pass"];
	$new1=$_POST["pass1"];

	if($old=="" || $new == "" || $new1 == "")
	{
	    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
		echo '<meta http-equiv="refresh" content="0;url=account.php?message=You left one of the required fields blank">';
	}
	elseif($new!=$new1)
	{
		echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
		echo '<meta http-equiv="refresh" content="0;url=account.php?message=The passwords did not match">';
	}
	else
	{
	$old =encrypt ($old,$salt);
	$new=encrypt ($new,$salt);
	



	$link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');

    $query= "SELECT * FROM $db_table WHERE user_name='$user'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    while($row = mysql_fetch_array($result)) {
        if($row['user_name']==$user) {
		if($row['password']==$old)
		{
		
		$query="UPDATE $db_table SET password='$new' WHERE user_name='$user'";
		mysql_query($query) or die('Query failed: ' . mysql_error());
			
include("class.phpmailer.php");
include("class.smtp.php");


$mail             = new PHPMailer();

$body             = "Dear $user,
<br>
<br>
<br>The Password to your account has been changed
<br>If you did not change your password, please contact the administrator at ashaw596@gmail.com
";

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = $email_user;  // GMAIL username
$mail->Password   = $email_pass;            // GMAIL password

$mail->From       = "noreply@filemanager.com";
$mail->FromName   = "filemanager admin";
$mail->Subject    = "File Manager Password Change";
$mail->AltBody    = "Dear $user,

The Password to your account has been changed
If you did not change your password, please contact the administrator at ashaw596@gmail.com
";
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress($row['email'],$user);

$mail->IsHTML(true); // send as HTML
$mail->AddReplyTo("noreply@filemanager.com","Webmaster");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} 
	
	
	
	


		echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
		echo '<meta http-equiv="refresh" content="0;url=read_dir.php">';
		}
		else
		{
		echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
		echo '<meta http-equiv="refresh" content="0;url=account.php?message=The password is incorrects">';
		}
            }
			}
			
	
}
}
}
?>