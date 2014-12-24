<?php
 session_start(); 
include_once 'securimage/securimage.php';

$securimage = new Securimage();
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";
if(isset($_GET['userid'])&&$_GET['userid']!=""){
	$code=$_GET['userid'];

	$link = mysql_connect($db_server, $db_username, $db_password)
	        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_database,$link ) or die('Could not select database');

    $query= "SELECT * FROM invite WHERE code='$code'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    $row = mysql_fetch_array($result);
        if( $row['code']==$code) {
		$email=$row['email'];

function encrypt1 ($pass,$salt)
{
	$pass=md5($salt.$pass.$salt);
	return $pass;	
}	
function check1($code,$securimage)
{
	echo "false";
	if ($securimage->check($code) == false) {
		echo "false";
		return "false";
	}
	else
	{
		echo "true";
		return "true";
	}

}
function adduser($user,$pass ,$pass1,$email,$email1)
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
$email1=strtolower($email1);
//$email= ereg_replace("[^A-Za-z0-9]", "", $email);
$email=strtolower($email);
$empty='';

if($user==''){
	$empty=1;
}
if($pass==''||$pass1==''){
	$empty=1;
}
if($email==''||$email1==''){
	$empty=1;
}
if($empty==1){
	$msg='
	<script type="text/javascript">
	document.getElementById("password").value="";
	document.getElementById("password1").value="";
	</script>
	You have left at least one field empty.
	';
	return $msg;
}
elseif($pass!=$pass1){
	$msg='
	<script type="text/javascript">
	document.getElementById("password").value="";
	document.getElementById("password1").value="";
	</script>
	The passwords do not match.';
	return $msg;
}
elseif($email!=$email1){
	$msg='
	<script type="text/javascript">
	document.getElementById("password").value="";
	document.getElementById("password1").value="";
	</script>
	The emails do not match.';
	return $msg;
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$msg='
	<script type="text/javascript">
	document.getElementById("password").value="";
	document.getElementById("password1").value="";
	</script>
	The email provided is not valid.';
	return $msg;
}
else{
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
			The username is taken.';
			return $msg;
        }
	}
			
	$query= "SELECT * FROM $db_table WHERE email='$email'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    while($row = mysql_fetch_array($result)) {
        if( $row['email']==$email) {
			$msg='
			<script type="text/javascript">
			document.getElementById("password").value="";
			document.getElementById("password1").value="";
			</script>
			The email is already registered to another account.';
			return $msg;
        }
	}

	$pass1=$pass;
	$pass= encrypt1 ($pass,$salt);
	$msg=$pass;


	$rndcode=new rndPass(50);
    $usercode=$rndcode->PassGen();
 	$link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database ,$link ) or die('Could not select database');
	
	if($user=="administrator"){
		$query="INSERT INTO  $db_table (email, user_name, password, usercode, filespace, activate) VALUES ('$email','$user','$pass','$usercode','0','0')";
	}
	else{
		$query="INSERT INTO  $db_table (email, user_name, password, usercode, filespace, activate) VALUES ('$email','$user','$pass','$usercode','1000','0')";
	}
	
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
	
include("class.phpmailer.php");
include("class.smtp.php");


$mail             = new PHPMailer();

$body             = "Dear $user,
<br>
<br>
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

$mail->From       = "noreply@IntroductoryElectricity.com";
$mail->FromName   = "David Mayo";
$mail->Subject    = "Introductory Electricity PSet Checker Account Confirmation";
$mail->AltBody    = "Dear $user,


Thank you for registering.
Before you can login and begin using your account, you must click on the link below to activate your acount.       
".$url."activate.php?userid=$usercode
your activation code is $usercode
";
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress($email,$user);

$mail->IsHTML(true); // send as HTML
$mail->AddReplyTo("noreply@IntroductoryElectricity.com","Webmaster");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} 
	
	
	
	
	addLog($logPath,time(),$user,"New user, $user created");
	$msg="
	<script type=\"text/javascript\">
	<!--
	window.location = \"activate_finished.php\"
	//-->
	</script>";
	
	return $msg;
}
}
$ajax = new PHPLiveX(array("adduser","check1"));  

?>

<html>
<head>
	<title>Project Sphere Registration</title>
	<link rel="shortcut icon" href="images/favicon.ico" />
    <link href="style.css" type="text/css" rel="stylesheet" />	
	<?php
	$ajax->Run(); 
	?> 
	<script type="text/javascript" src="securimage/prototype.js"></script>
		
		<script type="text/javascript">
		   function test(){
				processForm();
            }			
			function send1(){

            username = document.getElementById("username").value;
            password = document.getElementById("password").value;
			password1 = document.getElementById("password1").value;
			email = "<?php echo $email ?>";
			email1 = "<?php echo $email ?>";
			
			adduser (username, password,password1,email,email1, {"method":"POST",'target':'msg','preloader':'pr'});
            }

			  function processForm()
  {
   // $('submit').disabled = true;
   // $('submit').value = "Processing.  Please Wait...";
t=0;
    $('register').request({
	
      onSuccess: function(transport)
      {
        if(transport.responseText.match(/^OK/) != null) {
        //  alert('Your message has been sent!');
        
		 t=1;
		  send1();
		
		   $('register').reset();
        }
		else {
		alert(document.getElementById("msg123").value);
	
	   document.getElementById('msg123').value="The security code entered did not match the picture.";
	 alert(document.getElementById('msg123').value);
		  document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random();
		  
		   t=2;
		   
        }

      }
	
    });
	i=0;

	return false;
  }

	</script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="newlogin.css">

</head>
<body>
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>
<div id="pie" align="right" style="visibility:hidden;"></div>
	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <div id="my-tab-content" class="tab-content">
	                    <div class="tab-pane active" id="login">
	                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
	                        <br />
	                        <form class="form-signin" name="register" id="register" action="process.php" method="post">
	                            <input type="text" class="form-control form-signin-Top" placeholder="<?php echo $email ?>" name="email" readonly>
	                            <input type="text" class="form-control form-signin-Middle" placeholder="User Name" id="username" name="username" required autofocus>
	                            <input type="text" class="form-control form-signin-Middle" placeholder="Password" id="password" name="password">
	                            <input type="text" class="form-control form-signin-Bottom" placeholder="Confirm Password" id="password1" name="password1">
	                            

 								<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
 								<br />
         						<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">Reload Image</a>
								<br />
								<input type="text" name="code" id="code" size="10" maxlength="6" />
								<br />
								<br />
	                            <input type="submit" class="btn btn-lg btn-default btn-block" value="Create Account"  onclick="test();return false;"/>
	                        </form>
	                        <br />
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

        <div id="msg" align="center" class="error"></div>
		<div id="msg123" align="center" class="error"></div>
        <script language="JavaScript">
		
            <!--
            document.register.username.focus();
            //-->
        </script>
		<?php
		}
		else{
			echo '<meta http-equiv="refresh" content="5;url=index.php">';
		}
		}
		else{
			echo '<meta http-equiv="refresh" content="5;url=index.php">';
		}
		?>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>