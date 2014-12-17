<html>
<body>
<?php
include("class.phpmailer.php");
include("class.smtp.php");



$mail             = new PHPMailer();

$body             = "Dear $user,
<br>
<br>
<br>Thank you for registering your file manager account.
<br>Before you can login and begin using your account, you must click on the link below to activate your acount.
<br>
<br><a href='".$url."activate.php?userid=$usercode'>".$url."activate.php?userid=$usercode</a>
<br> your activation code is $usercode
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
$mail->Subject    = "File Manager Account Confirmation";
$mail->AltBody    = "Dear $user,


Thank you for registering your file manager account.
Before you can login and begin using your account, you must click on the link below to activate your acount.       
".$url."activate.php?userid=$usercode
your activation code is $usercode
";
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress("ashaw596@gmail.com","Albert Shaw");

$mail->IsHTML(true); // send as HTML
$mail->AddReplyTo("noreply@filemanager.com","Webmaster");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {

}

?>
</body>
</html>