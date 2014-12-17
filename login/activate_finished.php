<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="phplivex/phplivex.js"></script>
	<link type="text/css" href="jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="jquery.corner.js"></script>
	<script type="text/javascript" src="jquery.history.js"></script>
	<script type="text/javascript">
		$("#filetree").corner();
		$("#filetable").corner();
		$(".ui-widget-header").corner("top");
	</script>
</head>
<body>




<div id="container">
<div id="head">
	<table width="100%"><tr><td><a class="title1">File Manager Activation</a></td><tr></table>	
</div>

<div id="filetable" class="ui-widget-content" style="width:97%;">
	<h3 class="ui-widget-header">Activation</h3>
	<div id="filecontainer" class="filecontainer">
	<br />
	You're account has been successfully registered.
<br /> Now you just have to activate your account by entering the activation code sent to your email.
<br /><br /> <form action="activate.php" method="get" >
Activation Code: <input type="text" name="userid" value="" />
<input type="submit" value="submit" />
</form>
<br />
If you did not recieve an e-mail please enter your email address to resend the activation code.
<br />
<br /> <form action="send.php" method="post" >
E-Mail: <input type="text" name="email" value="" />
<input type="submit" value="send" />
	</div>
</div>
</form>
</body>
</html>