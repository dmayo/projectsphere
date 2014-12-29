<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="../login/images/favicon.ico" />
	<script type="text/javascript" src="phplivex/phplivex.js"></script>
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="jquery.history.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="newlogin.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active" id="login">
                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
                        You're account has been successfully registered.
						<br /> Now you just have to activate your account by entering the activation code sent to your email.
                        <form class="form-signin" action="activate.php" method="get">
                            <input type="text" name="userid" class="form-control form-signin-Single" placeholder="Activation Code" required autofocus>
							<input type="submit" class="btn btn-lg btn-default btn-block" value="Activate" />
                        </form>
                        If you did not recieve an e-mail please enter your email address to resend the activation code.
                        <form class="form-signin" action="send.php" method="post">
                            <input type="text" name="email" class="form-control form-signin-Single" placeholder="email" required autofocus>
							<input type="submit" class="btn btn-lg btn-default btn-block" value="Resend Activation Email" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>