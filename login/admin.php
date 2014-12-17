<?php
require "config/config.php";
require "checklogin.php";
if(checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false||$_COOKIE["upload_user"]!="administrator") {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><//head>';
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
}
else {
$version="2.0";
require "rndPass.class.php";
require "phplivex/PHPLiveX.php";

?>

<head>
	<title>File Manager Administrator</title>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link href="style.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="phplivex/phplivex.js"></script>
	<link type="text/css" href="jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
	<script type="text/javascript" src="jquery/ui/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="jquery.corner.js"></script>
	<script type="text/javascript" src="jquery.history.js"></script>


	<?php
	
/*$link = mysql_connect('localhost', 'update', '')
        or die('Could not connect: ' . mysql_error());
		
    //Select the database
    mysql_select_db('update',$link ) or die('Could not select database');

    $query= "SELECT * FROM tablename";
 //   echo $query;
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row = mysql_fetch_array($result);
//echo $row['version'].$version;
*/
	if($row['version']!=$version)
	{
	?>
	<script type="text/javascript">
	$(function() {
		$("#update").dialog({
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Update": function() {
					window.location="<?php echo $row['url'] ?>";
					$(this).dialog('close');
				
				},
				"Remind Me Later": function() { 
					$(this).dialog('close');
				}
			},
			close: function() {
				allFields.val('').removeClass('ui-state-error');
			}
		});$('#update').dialog('open');
		});
	</script>
	<?php
	//$ice=1;
	}
	
	
	?>
	<script type="text/javascript">
		$("#filetree").corner();
		$("#filetable").corner();
		$(".ui-widget-header").corner("top");
	</script>
	<script type="text/javascript">
		function config(){
			var plx = new PHPLiveX();
			return plx.ExternalRequest({  
				"url": "config/index.php",
				"method": "get", 
				"target": "filecontainer"
			});
		}
	</script>
        <script type="text/javascript">
            function generateKey(field,lineNumber){
               generateKey1(lineNumber, field, {"method":"POST",'target':field});
            }
			function submit1(form){
				var plx = new PHPLiveX();
				plx.SubmitForm(form, {"method":"POST","preloader":"pr","target":"filecontainer"});
			}
		</script>
</head>

<body>
<div id="container">
<div id="head">
	<table width="100%"><tr><td><a class="title1"><img src="images/logo.png" border="0" height="70" width="257" /></td><td align="right" id="headright" valign="top">User: Administrator<?php echo $name ?> | <a href="logout.php">Log Off</a></td><tr></table>
</div>
<div id="filetree" class="ui-widget-content">
	<h3 class="ui-widget-header">Links</h3>
	<div class="links">
		<a href="log/logViewer.php">log viewer</a><br />
		<a href='config/index.php' onclick="">config editor</a>
	</div>
<br />
<br />
<br />
<h3 style="text-align:left; padding-left:6px;">Invite Users</h3>	
<div class="links">
Please enter the email of the person who you wish to invite. <br />
<form method="post" action="invite/invite.php" name="invite">
<input type="text" name="email" /> <input type="submit" value="submit" onClick="submit1('configForm');"/>
</div>
</div>

<div id="filetable" class="ui-widget-content">
	<h3 class="ui-widget-header">Administration</h3>
	<div id="filecontainer" class="filecontainer" style="height:640px;">
	<br />
	<p class="text">Welcome to the File Manager administration system. The administration system contains several essential tools such as a user invitation system (see left panel), a user friendly configuration file editor, and a system event log viewer.</p>
	</div>
</div>
<?PHP 
if($ice==1)
{
?>
<div id="update" title="Update System">Your version of the File manager is out of date. To update, press update to download the update and extract it to your file manager directory.</div>



<?php
}
 require "google.php"; ?>
</body>

<?php



}
?>