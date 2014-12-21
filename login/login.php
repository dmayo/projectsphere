<?php
require "config/config.php";
require "checklogin.php";
if(isset($_COOKIE["upload_user"])&&isset($_COOKIE["user_code"])&&checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==true) {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
    if($_COOKIE["upload_user"]!="administrator"){
		echo '<meta http-equiv="refresh" content="0;url=../projects/index.php">';
	}
	else{
		echo '<meta http-equiv="refresh" content="0;url=admin.php">';
	}
}
else {
require "log/log.php";
require "phplivex/PHPLiveX.php";
require "rndPass.class.php";
header("Content-Type: text/html; charset=UTF-8");  
 //chdir($uploadPath);
function encrypt ($pass,$salt){
	$pass=md5($salt.$pass.$salt);
	return $pass;
}	
function filter($user,$pass){
if($pass!= ereg_replace("[^A-Za-z0-9]", "", $pass)){
	$login['validate']=0;
	return $login;
}
if($user!= ereg_replace("[^A-Za-z0-9]", "", $user)){
	$login=0;
	return $login;
}

$pass=strtolower($pass);
$user=strtolower($user);

$login['user']=$user;
$login['pass']=$pass;
return $login;
}

function logininfo($user,$pass) {
    if($user==""&&$pass=="") {
        return "<br />You did not enter your username or your password.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.username.focus();</script>";
    }
    elseif($user=="") {
        return "<br />You did not enter your username.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.username.focus();</script>";
    }
    elseif($pass=="") {
        return "<br />You did not enter your password.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.password.focus();</script>";
    }
    else {
        return "1";
    }
}

function attempt_time($attempt_time,$time) {
    if(time()-$attempt_time>=$time) {
        return 1;
    }
    else {
        return 0;
    }
}

function checkdb($username,$password,$db_server,$db_username,$db_password,$db_name,$db_table) {
    $link = mysql_connect($db_server, $db_username, $db_password)
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db($db_name,$link ) or die('Could not select database');

    $query= "SELECT * FROM $db_table WHERE user_name='$username'";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    while($row = mysql_fetch_array($result)) {
        if( $row['user_name']==$username) {
		
            $attempts=$row['attempts'];
            $attempt_time=$row['attempt_time'];
			$activate=$row['activate'];
			
            if(attempt_time($attempt_time,60*60*24)==1) {
                $attempt_check= "true";
                $attempts=0;
                $time=time();
                $sql="UPDATE $db_table SET attempts='$attempts', attempt_time='$time' WHERE user_name = '$username'";
                if (!mysql_query($sql,$link )) {
                    die('Error: ' . mysql_error());
               }
            }
            else {
                if($attempts>=3) {
                    switch ($attempts) {
                        case 3:
                            if(attempt_time($attempt_time,60*15)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 15 minutes");
                            }
                            break;

                        case 4:
                            if(attempt_time($attempt_time,60*30)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 30 minutes");
                            }
                            break;

                        case 5:
                            if(attempt_time($attempt_time,60*60*1)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 1 hour");
                            }
                            break;

                        case 6:
                            if(attempt_time($attempt_time,60*60*2)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 2 hour");
                            }
                            break;
                        case 7:
                            if(attempt_time($attempt_time,60*60*4)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 4 hour");
                            }
                            break;

                        case 8:
                            if(attempt_time($attempt_time,60*60*6)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 6 hour");
                            }
                            break;
                        default:
                            if(attempt_time($attempt_time,60*60*12)==1) {
                                $attempt_check= "true";
								addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username))."'s account has been disabled for 12 hour");
                            }
                            break;
                    }
                }
                else {
                    $attempt_check= "true";
                }
            }
            if($attempt_check!="true") {
                return 2;
            }
            else {
                if($row['password']==$password) {
                    $attempts=0;
                    $time=time();
                    $sql="UPDATE $db_table SET attempts='$attempts', attempt_time='$time' WHERE user_name = '$username'";
					if($activate==0){
						return 5;
					}
					else{
						if (!mysql_query($sql,$link )) {
							die('Error: ' . mysql_error());
						}
						return 1;
					}
				}
                else {
                    $attempts=($attempts+1);
                    $time=time();
                    $sql="UPDATE $db_table SET attempts='$attempts', attempt_time='$time' WHERE user_name = '$username'";
                    if (!mysql_query($sql,$link )) {
                        die('Error: ' . mysql_error());
                    }
                    return 0;
                }
            }
        }
    }
}

function makeCookie($username,$remember) {
	require "config/config.php";
    $rndcode=new rndPass(50);
    $usercode=$rndcode->PassGen();
    $usercode_query="UPDATE users SET usercode = '$usercode' WHERE user_name = '$username'";
    $usercode_result = mysql_query($usercode_query) or die('Query failed: ' . mysql_error());
	if($remember==1){
	$ip=$_SERVER['REMOTE_ADDR'];
		addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username)) . " has logged in, Stayed signed in: yes, IP: $ip");
		setcookie("upload_user", $username, time()+60*60*24*365*10, '/');
		setcookie("user_code", $usercode, time()+60*60*24*365*10, '/');  
		setcookie("remember", "1", time()+60*60*24*365*10, '/');  
	}
	else{
	$ip=$_SERVER['REMOTE_ADDR'];
		addLog($logPath,time(),ucwords(strtolower($username)),ucwords(strtolower($username)) . " has logged in, Stayed signed in: no, IP: $ip");
		setcookie("upload_user", $username, time()+3600, '/');  //expire in 1 hour
		setcookie("user_code", $usercode, time()+3600, '/');    //expire in 1 hour
	}
}

function validate($username,$password, $remember) {
    require "config/config.php";
    $msg=logininfo($username,$password);
    if($msg=="1") {
        $login=filter($username,$password);
		
	if($login!=0){
        $username=$login['user'];
        $password=$login['pass'];
		$password= encrypt($password,$salt);
        $checkdb=checkdb($username,$password,$db_server,$db_username,$db_password,$db_database,$db_table);
        switch ($checkdb) {
            case 1:
                makeCookie($username,$remember);
                if($username!="administrator"){
					$msg = '<script type="text/javascript">
					<!--
					window.location = "../projects/index.php"
					//-->
					</script>';
				}
	            else{
					$msg = '<script type="text/javascript">
					<!--
					window.location = "admin.php"
					//-->
					</script>';
				}
                break;

            case 2:
                $msg = "Your account is currently disabled because of multiple failed logins.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.password.focus();</script>";
                break;
			case 5:
				$msg = "Your account must be activated before use.
				<script type=\"text/javascript\">
	<!--
	window.location = \"activate_finished.php\"
	//-->
	</script>";
                break;
            default:
                 //"Invalid username or password.";
				$msg ="Incorect username or password.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.password.focus();</script>";
                break;
        }
    }
    else{
        $msg="You are only allowed to use letters and numbers in you username and password.<script language=\"JavaScript\">document.getElementById('password').value='';document.login.password.focus();</script>";
    }
    }
    return $msg;
}
$ajax = new PHPLiveX(array("validate"));  
?>

<html>  
    <head>
        <title>Project Sphere</title>
		<link rel="shortcut icon" href="images/favicon.ico" />
        <link href="style.css" type="text/css" rel="stylesheet" />
		<link type="text/css" href="jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="jquery.corner.js"></script>
		<?php $ajax->Run(); ?>
		<script type="text/javascript">
			$("#loginbox").corner();
			$("#header").corner("top");
		</script>
        <script type="text/javascript">
            function test(){
                username = document.getElementById("username").value;
                password = document.getElementById("password").value;
				if(document.login.remember.checked == true){
					remember=1;
				}
				else{
					remember=0;
				}
                validate(username, password, remember, {"method":"POST",'target':'msg','preloader':'pr'});
            }
        </script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Project Sphere</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

        <link rel="stylesheet" href="newlogin.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div id="pr" align="right" style="visibility:hidden;"><img src="images/load.gif" border="0" height="16" width="16" /> Loading...</div>
        

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
                        <div class="tab-pane active" id="login">
                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
                        <form class="form-signin" name="login">
                            <input type="text" class="form-control" placeholder="Username" id="username" required autofocus>
                            <input type="password" class="form-control" placeholder="Password" id="password" required>
                            <input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In" onclick="test();return false;" />
                            <div id="tabs" data-tabs="tabs">
                                <p class="text-center"> Stay signed in <input type="checkbox" id="remember" name="remember" /></p>
                                <p class="text-center"><a href="#register" data-toggle="tab">Need an Account?</a></p>
                                <p class="text-center"><a href="forgot.php" data-toggle="tab">Forgot Password?</a></p>
                                </div>
                            </div>
                        </form>
                        <div class="tab-pane" id="register">
                            <form class="form-signin" action="" method="">
                                <input type="text" class="form-control" placeholder="User Name ..." required autofocus>
                                <input type="email" class="form-control" placeholder="Emaill Address ..." required>
                                <input type="password" class="form-control" placeholder="Password ..." required>
                                <input type="submit" class="btn btn-lg btn-default btn-block" value="Sign Up" />
                            </form>
                            <div id="tabs" data-tabs="tabs">
                        <p class="text-center"><a href="#login" data-toggle="tab">Have an Account?</a></p>
                        </div>
                        </div>
                        <div class="tab-pane" id="select">
                            <div id="tabs" data-tabs="tabs">
                                <div class="media account-select">
                                    <a href="#user1" data-toggle="tab">
                                        <div class="pull-left">     
                                            <img class="select-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                                        </div>   
                                        <div class="media-body">
                                            <h4 class="select-name">User Name 1</h4>
                                        </div>
                                    </a>
                                </div>
                                <hr />
                                <div class="media account-select">
                                    <a href="#user2" data-toggle="tab">
                                        <div class="pull-left">     
                                            <img class="select-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                                        </div>   
                                        <div class="media-body">
                                            <h4 class="select-name">User Name 2</h4>
                                        </div>
                                    </a>
                                </div>
                                <hr />
                        <p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
                        </div>
                        </div>
                        <div class="tab-pane" id="user1">
                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                            <h3 class="text-center">User Name 1</h3>
                            <form class="form-signin" action="" method="">
                                <input type="hidden" class="form-control" value="User Name">
                                <input type="password" class="form-control" placeholder="Password" autofocus required>
                                <input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
                            </form>
                            <p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
                    <p class="text-center"><a href="#select" data-toggle="tab">Select another Account</a></p>
                        </div>
                        <div class="tab-pane" id="user2">
                            <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                            <h3 class="text-center">User Name 2</h3>
                            <form class="form-signin" action="" method="">
                                <input type="hidden" class="form-control" value="User Name">
                                <input type="password" class="form-control" placeholder="Password" autofocus required>
                                <input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
                            </form>
                            <p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
                    <p class="text-center"><a href="#select" data-toggle="tab">Select another Account</a></p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>



        <div id="msg" align="center" class="error"></div>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<?php require "google.php"; ?>
    </body>
</html>
<?php
}
?>