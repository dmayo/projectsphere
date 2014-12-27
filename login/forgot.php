<html>
<head>
    <title>Project Sphere Reset Password</title>

	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="newlogin.css">
</head>
<body>
	<div id="pr" align="right" style="visibility:hidden;">Loading...</div>


	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <div id="my-tab-content" class="tab-content">
	                    <div class="tab-pane active" id="login">
	                        <span class="title"><h3><i class="glyphicon glyphicon-record"></i> Project Sphere</h3></span>
	                        <br />
	                        <form class="form-signin" action="send_pass.php" method="post">
	                            <input type="text" class="form-control form-signin-Single" placeholder="Email" name="email" required autofocus>
	                            <input type="submit" class="btn btn-lg btn-default btn-block" value="Send Reset" />
	                        </form>
	                        <br />
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>