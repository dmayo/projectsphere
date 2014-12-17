<?php
require "../config/config.php";
require "../checklogin.php";
if(checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false||$_COOKIE["upload_user"]!="administrator") {
    echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
	echo '<meta http-equiv="refresh" content="0;url=../login.php">';
}
else {
?>
<head>
		<title>Log Viewer</title>
		<link rel="shortcut icon" href="../images/favicon.ico" />
		<link href="../style.css" type="text/css" rel="stylesheet" />
		<link type="text/css" href="../jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../jquery/ui/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="../jquery.corner.js"></script>
		<script type="text/javascript">
			$("#logs").corner();
			$("#header").corner("top");
		</script>
	<script type="text/javascript">
	$(function() {
		$("#confirmClear").dialog({
			bgiframe: true,
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Cancel": function() { 
					$(this).dialog("close");
				},
				"Delete": function() {
					window.location="clearLogs.php";
					$(this).dialog("close");
				
				}
			},
			close: function() {
				allFields.val('').removeClass("ui-state-error");
			}
		});
		$("#clearLogs").click(function() {
			$("#confirmClear").dialog("open");
		})	
		});
	</script>
	</head>
<body>
<?php
echo '<div style="width:100%;"><table width="100%"><tr><td align="left"><img src="../images/logo.png" border="0" height="70" width="257" /></td><td align="right" valign="top"><a href="../admin.php">Back to Home</a> | <span id="clearLogs"><a href="" onclick="return false;">Clear Logs</a></span> | <a href="../logout.php">Log Off</a></td></tr></table></div>';

$i=0;
$file_handle = fopen("log.log", "rb");
while (!feof($file_handle)) {
	$line_of_text = fgets($file_handle);
	$line[$i]=$line_of_text;
	$i++;
}
fclose($file_handle);

echo '<div class="ui-widget-content" id="logs"><h3 class="ui-widget-header" id="header">Log Viewer</h3>';
echo '<table border="1" width="100%" cellpadding="0" cellspacing="0" style="color:white;"><tr bgcolor="#0A64A4" style="font-size:107%;font-family:Arial;"><th width="15%">Date/Time</th><th width="15%">User</th><th widht="70%">Event</th></tr></table>';
echo '<div class="logs"><table border="1" width="100%" cellpadding="0" cellspacing="1" class="logTable" bgcolor="#65A5D1" style="font-family:calibri;font-size:12pt;">';
if($i!=1){
for($t=$i-1;$t>0;$t--){
	if($_GET['user']!=""){
		$user=ucwords(strtolower($_GET['user']));
		$parts=explode(';',$line[$t]);
		$parts[1]=trim($parts[1]);
		if($user==$parts[1]){
		echo "<tr>";
			for($x=0;$x<3;$x++){
				if($x==0){
					$parts[$x]=date("m-d-y H:i:s", $parts[$x]);
					echo "<td width='15%'>$parts[$x]</td>";
				}
				
				elseif($x==1){
					$parts[$x]=ucwords(strtolower($parts[$x]));
					echo "<td width='15%'>$parts[$x]</td>";
				}
				else{
					echo "<td width='70%'>$parts[$x]</td>";
				}

			}
		echo "</tr>";
		}
	}
	else{
		echo "<tr>";
		$parts=explode(';',$line[$t]);
		for($x=0;$x<3;$x++){
			if($x==0){
				$parts[$x]=date("m-d-y H:i:s", $parts[$x]);
				echo "<td width='15%'>$parts[$x]</td>";
			}
			elseif($x==1){
				$parts[$x]=ucwords(strtolower($parts[$x]));
				echo "<td width='15%'>$parts[$x]</td>";
			}
			else{
				echo "<td width='70%'>$parts[$x]</td>";
			}
		}
	echo "</tr>";
	}
}
}
else{
	echo '<tr><td colspan="3">There are no logs.</td><tr>';
}
echo '</table></div></div><br />';
echo '<div class="logFooter">';
echo '<form action="logViewer.php" metod="get">Search for a user: <input type="text" name="user"';
if($_GET['user']!=""){
	echo 'value="' . $_GET['user'] . '"';
}
echo '/><input type="submit" value="search" /></form>';

if($_GET['user']!=""){
	echo '<a href="logViewer.php">all logs</a>';
}
echo '</div><div id="confirmClear" title="Clear All Logs">Are you sure that you would like to delete all of the logs?</div></body>';
}
?>