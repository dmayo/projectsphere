<?php
require "phplivex/PHPLiveX.php";
require "config/config.php";
require "log/log.php";
require "rndPass.class.php";

function encrypt1 ($pass,$salt){
	$pass=md5($salt.$pass.$salt);
	return $pass;	
}
?>

<html>
<head>
    <title>Project Sphere Reset Password</title>
	<link rel="shortcut icon" href="images/favicon.ico" />
    <link href="style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>

	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="newlogin.css">

</head>
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>

	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <div id="my-tab-content" class="tab-content">
	                    <div class="tab-pane active" id="login">
	                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
	                        <br />
	                        <?php
								if(isset($_GET["userid"])&&$_GET["userid"]!=""){
									$userid=$_GET['userid'];
							?>
	                        Please enter a new password for your account.
	                        <br />
	                        <form class="form-signin" action=<?php echo '"reset1.php?userid='. $userid .'"'; ?> method="post">
	                            <input type="password" class="form-control form-signin-Top" placeholder="Password" name="pass" required autofocus>
	                            <input type="password" class="form-control form-signin-Bottom" placeholder="Confirm Password" name="pass1">                         
	                            <input type="submit" class="btn btn-lg btn-default btn-block" value="Reset Password" />
	                        </form>
	                        <br />
	                        <?php
	                    		}
	                    		else{
	                    			echo 'Error: invalid user id';
	                    		}
	                        ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>