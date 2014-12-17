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
<body>
<div id="pr" align="right" style="visibility:hidden;">Loading...</div>
<form action="send_pass.php" method="post" >
	<div class="ui-widget-content" id="loginbox" style="width:450px;height:350px;margin:0 auto;text-align:center;font-size:105%;">
	<h3 class="ui-widget-header" id="header">File Manager Reset Password</h3>
    <div align="center" style="padding-top:40px;font-size:220%;font-weight:bold;"><img src="images/logo.png" border="0" height="70" width="257" /></div>
	
<table border="0" align="center" cellspacing="0" cellpadding="8">
    <tr>
		<td colspan="2" align="center">Please enter you e-mail address to reset you password.</td>
	</tr>
	<tr>
		<td align="right" width="25%" style="padding-top:20px;">Email:</td>
		<td width="75%" style="padding-top:20px;"><input type="text" size="30px" name="email"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center" style="padding-top:20px;"><input type="submit" value="Send Reset" /></td>
	<tr>
</table>
</div>
</form>
</body>
</html>