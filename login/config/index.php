<?PHP
echo '<form method="post" action="edit.php"" name="configForm">';
require "../rndPass.class.php";

require "../phplivex/PHPLiveX.php";
function parse($varName, $line){
	$x=count($line);
	$num=0;
	for($l=1;$l<$x-1;$l++){
		$parts = explode('=', $line[$l]);
		$parts[0]=trim($parts[0]);
		if($parts[0]==$varName){
			if($varName!='$uploadsize'){
				$parts[1] = trim($parts[1]);
				$parts[1] = substr($parts[1], 1, -2);
			}
			else{
				$parts[1] = trim($parts[1]);
				$parts[1] = substr($parts[1], 0, -1);
			}
			//echo '<a id="' . $l . '">' . $parts[1] . '</a>';
			echo "<input name=\"$varName\" type=\"text\" value=\"" . $parts[1] . "\" />";
			$num=1;
			break;
		}
		else{
			unset($parts);
		}
	}
	if($num==0){
		echo '<input type="text" name="$varName" />';
	}
	if($parts[1]==""){
		return false;
	}
	else{
		return true;
	}
}
function check($varName, $line){
	$x=count($line);
	$num=0;
	for($l=1;$l<$x-1;$l++){
		$parts = explode('=', $line[$l]);
		$parts[0]=trim($parts[0]);
		if($parts[0]==$varName){
			$parts[1] = trim($parts[1]);
			$parts[1] = substr($parts[1], 1, -2);
			break;
		}
		else{
			unset($parts);
		}
	}
	if($parts[1]==""){
		return false;
	}
	else{
		return true;
	}
}
function uploadSize($varName,$line){
	$x=count($line);
	$num=0;
	for($l=1;$l<$x-1;$l++){
		$parts = explode('=', $line[$l]);
		$parts[0]=trim($parts[0]);
		if($parts[0]==$varName){
			$parts[1] = trim($parts[1]);
			$parts[1]=$parts[1]/1024/1024;
			$parts[1]=round($parts[1]);
			//echo '<a id="' . $l . '">' . $parts[1] . 'mb</a>';
			echo '<input name="$varName"  type="text" value="' . $parts[1] . '" />';
			$num=1;
			break;
		}
		else{	
			unset($parts);
		}
	}
	if($num==0){
		echo '<input type="text" name=\"$varName\" />';
	}
}

//generate key
function generateKey1($num,$field){
	$rndcode=new rndPass(7);
	$usercode=$rndcode->PassGen();	
	
	$lineNumber=$num;
	$value="$1$".$usercode.".$";
	
//read
	$i=0;
	$file_handle = fopen("config.php", "rb");
	while (!feof($file_handle)) {
		$line_of_text = fgets($file_handle);
		$line[$i]=$line_of_text;
		$i++;
	}
	fclose($file_handle);

//edit
	$parts = explode('=', $line[$lineNumber]);
	$parts[0]=trim($parts[0]);
	if($parts[0]=="$uploadsize"){
		$parts[1]=$value . ";\n";
	}
	else{
		$parts[1]="'" . $value . "';\n";
	}
	$line[$lineNumber]=implode('=', $parts);


//write
	$x=count($line);
	$fh = fopen("config.php", 'w') or die("can't open file");
	for($t=0;$t<$x;$t++){
		fwrite($fh, $line[$t]);
	}
	fclose($fh);

	return '<input name="' . $field . '" type="text"value="' . "$1$".$usercode.".$" . '" />';
}

$ajax = new PHPLiveX(array("generateKey1"));

$i=0;
$file_handle = fopen("config.php", "rb");
while (!feof($file_handle)) {
	$line_of_text = fgets($file_handle);
	$line[$i]=$line_of_text;
	$i++;
}
fclose($file_handle);

?>
<html>
<head>
		<link href="../style.css" type="text/css" rel="stylesheet" />
		<link type="text/css" href="../jquery/ui/css/ui-lightness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../jquery/ui/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="../jquery/ui/js/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="../jquery.corner.js"></script>
		<script type="text/javascript">
			$("#content").corner();
			$("#header").corner("top");
		</script>
		<?php $ajax->Run(); ?> <!-- Can be called between body tags as well -->  
        <script type="text/javascript">
            function generateKey(field,lineNumber){
               generateKey1(lineNumber, field, {"method":"POST",'target':field});
            }
			function submit1(form){
				var plx = new PHPLiveX();
				plx.SubmitForm(form, {"method":"POST","target":"container"});
			}
		</script>
<title>Config Editor</title>
</head>
<body>
<?php
echo '<div style="width:100%;"><table width="100%"><tr><td align="left"><img src="../images/logo.png" border="0" height="70" width="257" /></td><td align="right" valign="top"><a href="../admin.php">Back to Home</a> | <a href="../logout.php">Log Off</a></td></tr></table></div>';
echo '<div class="ui-widget-content" id="content" style="text-align:left;height:700px;width:600px;"><h3 class="ui-widget-header" id="header" style="text-align:center;">Config Editor</h3>';
echo '<div id="container" class="config" style="padding-left:10px;padding-top:10px;text-align:left;">';
echo '<h3>Account Activation:</h3>';
echo 'Server Url Address: ';
parse('$url',$line);
echo '<br /><br /><h3>Database:</h3>';
echo 'Server: ';
parse('$db_server',$line);
echo '<br />User Name: ';
parse('$db_username',$line);
echo '<br />Password: ';
parse('$db_password',$line);
echo '<br />Database Name: ';
parse('$db_database',$line);
echo '<br />Database Table For Users: ';
parse('$db_table',$line);
echo '<form>';
echo '<br /><br /><h3>E-Mail:</h3>';
echo 'E-Mail Username: ';
parse('$email_user',$line);
echo '<br />E-Mail Password: ';
parse('$email_pass',$line);
echo '<br /><br /><h3>Encryption:</h3>';
echo 'Master Key 1: ';
if(check('$salt',$line)==false){
	echo'<span id="$salt">';
	parse('$salt',$line);
	echo ' <button onclick="generateKey(\'$salt\',\'10\');return false;">generate</button>';
	echo '</span>';
}
else{
	parse('$salt',$line);
}
echo '<br />Master Key 2: ';
if(parse('$salt1',$line)==false){
	echo'<span id="$salt1">';
	parse('$salt1',$line);
	echo ' <button onclick="generateKey(\'$salt1\',\'11\');return false;">generate</button>';
	echo '</span>';
}
echo '<br /><br /><h3>Uploading:</h3>';
echo 'Upload Path: ';
parse('$uploadPath',$line);
echo '<br />Upload Size Limit: ';
parse('$uploadsize',$line);

echo '<br /><br /><h3>System Log:</h3>';
echo 'System Log Path: ';
parse('$logPath',$line);
echo '<br /><br /><input type="submit" value="submit" onClick="submit1(\'configForm\');"/></form>';
echo '</div></div>';
echo '</body>
</html>';
?>