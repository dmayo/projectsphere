
<?PHP

require_once __DIR__."/../rndPass.class.php";
require_once __DIR__."/../phplivex/PHPLiveX.php";
require_once __DIR__."/../config/config.php";
require_once __DIR__."/../log/log.php";

require_once(__DIR__."/../class.phpmailer.php");
require_once(__DIR__."/../class.smtp.php");


function inviteUser($email){

	$link = mysql_connect($GLOBALS['db_server'], $GLOBALS['db_username'], $GLOBALS['db_password'])
			or die('Could not connect: ' . mysql_error());
			
	//Select the database
	mysql_select_db($GLOBALS['db_database'], $link ) or die('Could not select database');

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
		$link = mysql_connect($GLOBALS['db_server'], $GLOBALS['db_username'], $GLOBALS['db_password'])
				or die('Could not connect: ' . mysql_error());
		//Select the database
		mysql_select_db($GLOBALS['db_database'] ,$link ) or die('Could not select database');
		
		
		$query="INSERT INTO  invite (email,code,register) VALUES ('$email','$code','0')";
		
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}

	$mail             = new PHPMailer();

	$body             = "Welcome to Introductory Electricity! 
	<br>
	<br>
	<br>Click the following link to create your account
	<br><a href='".$GLOBALS['url']."register_invite.php?userid=$code'>".$GLOBALS['url']."register.php?userid=$code</a>

	";

	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port

	$mail->Username   = $GLOBALS['email_user'];  // GMAIL username
	$mail->Password   = $GLOBALS['email_pass'];            // GMAIL password

	$mail->From       = "filemanagerdmas@gmail.com";
	$mail->FromName   = "David Mayo";
	$mail->Subject    = "Introductory Electricity PSet Checker Registration";
	$mail->AltBody    = "Go to the following link to create your account ".$GLOBALS['url']."register.php?userid=$code";
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML($body);

	$mail->AddAddress($email,$email);

	$mail->IsHTML(true); // send as HTML
	$mail->AddReplyTo("filemanagerdmas@gmail.com","Webmaster");

	if(!$mail->Send()) {
		return 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		addLog($GLOBALS['logPath'],time(),"Administrator", $email . " has been successsfully invited");
		return 1;
	}
}
?>