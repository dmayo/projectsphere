<?php
$lineNumber=$_POST['elementid'];
$value=$_POST['value'];

$url=$_POST['$url'];
$db_server=$_POST['$db_server'];
$db_username =$_POST['$db_username'];
$db_password=$_POST['$db_password'];
$db_database=$_POST['$db_database'];
$db_table=$_POST['$db_table'];
$email_user=$_POST['$email_user'];
$email_pass=$_POST['$email_pass'];
$salt=$_POST['$salt'];
$salt1=$_POST['$salt1'];
$uploadPath=$_POST['$uploadPath'];
$uploadsize=$_POST['$uploadsize'];
$logPath=$_POST['$logPath'];


//write
	$x=count($line);
	$fh = fopen("config.php", 'w') or die("can't open file");
		fwrite($fh,"<?php\n");
		fwrite($fh,'$url'."='".$url."';\n");
		fwrite($fh,'$db_server'."='".$db_server."';\n");
		fwrite($fh,'$db_username'."='".$db_username."';\n");
		fwrite($fh,'$db_password'."='".$db_password."';\n");
		fwrite($fh,'$db_database'."='".$db_database."';\n");
		fwrite($fh,'$db_table'."='".$db_table."';\n");
		fwrite($fh,'$email_user'."='".$email_user ."';\n");
		fwrite($fh,'$email_pass'."='".$email_pass."';\n");
		fwrite($fh,'$salt'."='".$salt."';\n");
		fwrite($fh,'$salt1'."='".$salt1."';\n");		
		fwrite($fh,'$uploadPath'."='".$uploadPath."';\n");
		fwrite($fh,'$uploadsize'."=".$uploadsize.";\n");
		fwrite($fh,'$logPath'."='".$logPath."';\n");
		fwrite($fh,"?>\n");

		
	
	fclose($fh);

echo '<meta http-equiv="refresh" content="0;url=index.php">';


/*
$file = new SplFileObject('config.php');
$file->seek($lineNumber);
$line = $file->current();
$parts = explode('=', $line);
$parts[1]= "'" . $value . "';";
$line = implode('=', $parts);
unset($file);
$file = new SplFileObject("config.php", "w");
$file->seek($lineNumber);
$file->fwrite($line);
echo $value;
*/

?>