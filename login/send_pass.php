
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
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";
include("class.phpmailer.php");
include("class.smtp.php");

$email=$_POST['email'];

$link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');

    $query= "SELECT user_name,usercode FROM $db_table WHERE email='$email'";
	//echo $query;
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    while($row = mysql_fetch_array($result)) {
		$user=$row['user_name'];
        $usercode=$row['usercode'];
		$true=1;		
		
			}
if($true==1)
{


$mail             = new PHPMailer();

$body             = "Dear $user,
<br>
<br>
<br>To Reset you password please follow the following link
<br>
<br><a href='".$url."reset.php?userid=$usercode'>".$url."reset.php?userid=$usercode</a>


";

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "filemanagerdmas";  // GMAIL username
$mail->Password   = "davidalbert";            // GMAIL password

$mail->From       = "noreply@filemanager.com";
$mail->FromName   = "filemanager admin";
$mail->Subject    = "Funnykidstuff Account Confirmation";
$mail->AltBody    = "Dear $user,


Thank you for registering your file manager account.
Before you can login and begin using your account, you must click on the link below to activate your acount.       
".$url."activate.php?userid=$usercode
your activation code is $usercode


";
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress($email,$user);

$mail->IsHTML(true); // send as HTML
$mail->AddReplyTo("noreply@filemanager.com","Webmaster");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "email successfully sent to $email.";
}
}
else
{
echo "The email provided is not registered to any account";
}
?>
</div>
</body>
</html>

	