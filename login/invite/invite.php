<html>
<head>

</head>
<body>

<?PHP

require "../rndPass.class.php";
require "../phplivex/PHPLiveX.php";
require "../config/config.php";
require "../log/log.php";

include("../class.phpmailer.php");
include("../class.smtp.php");


if(isset($_POST['email'])&&$_POST['email']!='')
{
$email=$_POST['email'];

$link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');

    $query= "SELECT * FROM invite WHERE email='$email'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $row = mysql_fetch_array($result);
        if( $row['email']==$email) {
			$code=$row['code'];
		}
		else
		{

$rndcode=new rndPass(50);
    $code=$rndcode->PassGen();
 $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database ,$link ) or die('Could not select database');
	
	
	$query="INSERT INTO  invite (email,code,register) VALUES ('$email','$code','0')";
	
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
	


}


$mail             = new PHPMailer();

$body             = "Welcome to Introductory Electricity! 
<br>
<br>
<br>Click the following link to create your account
<br><a href='".$url."register.php?userid=$code'>".$url."register.php?userid=$code</a>

";

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = $email_user;  // GMAIL username
$mail->Password   = $email_pass;            // GMAIL password

$mail->From       = "filemanagerdmas@gmail.com";
$mail->FromName   = "David Mayo";
$mail->Subject    = "Introductory Electricity PSet Checker Registration";
$mail->AltBody    = "Go to the following link to create your account ".$url."register.php?userid=$code";
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress($email,$email);

$mail->IsHTML(true); // send as HTML
$mail->AddReplyTo("filemanagerdmas@gmail.com","Webmaster");

if(!$mail->Send()) {
  echo 'That Email address is not valid. 
  <meta http-equiv="refresh" content="3;url=../admin.php">';
} 

	addLog($logPath,time(),"Administrator", $_POST['email'] . " has been successsfully invited");
	echo "user successfully invited";
	echo '<meta http-equiv="refresh" content="3;url=../admin.php">';
}
else
{
echo '<meta http-equiv="refresh" content="30;url=../admin.php">';
}
?>

</body>
<html>