<?php
echo '<script type="text/javascript">alert("pie")</script>';
echo "pie";
require "config/config.php";
require "checklogin.php";
$user = ucwords(strtolower(@$_GET['owner']));
$user1= strtolower(@$_GET['owner']);
$user2= strtolower(@$_GET['owner']);
if(checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"])==false){
	echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><meta http-equiv="refresh" content="2;url=login.php"></head>';
}
else{

	require "log/log.php";
	require "encrypt/encrypt.php";
	if(isset($_POST['delete'])){
//	echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"><link href="style.css" type="text/css" rel="stylesheet" /></head>';
    chdir($uploadPath);
$link = mysql_connect($db_server, $db_username, $db_password)
    or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database, $link) or die('Could not select database');
	echo '<script type="text/javascript">alert("pie")</script>';
	
	
    function asd ($path,$file)
{
require "config/config.php";
echo $file;
	$query= "DELETE FROM shared WHERE  file_path='/$path' AND name='$file'";
echo $query;
	mysql_query($query) or die('Query failed: ' . mysql_error());

	
	$link = mysql_connect($db_server, $db_username, $db_password)
	
    or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database, $link) or die('Could not select database');
    
	$query= "SELECT name FROM shared WHERE  owner='$user2' And file_path='$user1'";
echo $query;
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$i=0;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

	$file_1=$row['name'];
	if(is_dir($uploadPath.$path.$file."/".$file_1))
	{

		asd ($path.$file."/",$file_1);
	}
	else
	{

		asd ($path.$file."/",$file_1);
	}

	$i++;
	}
	
	

	if ($handle = opendir($uploadPath."/".$path.$file)) {
    while (false !== ($file_1 = readdir($handle))) {
        if ($file_1 != "." && $file_1 != "..") {
            if(is_dir($uploadPath.$path.$file."/".$file_1))
			{

			asd ($path.$file."/",$file_1);
			}
			else
			{

			asd ($path.$file."/",$file_1);
			}
			
			
        }
   } 
    closedir($handle);
}}

    function deleteDir($dir){
        if (substr($dir, strlen($dir)-1, 1) != '/')
        $dir .= '/';
        if ($handle = opendir($dir))
        {
            while ($obj = readdir($handle))
            {
                if ($obj != '.' && $obj != '..')
                {
                    if (is_dir($dir.$obj))
                    {
                        if (!deleteDir($dir.$obj))
                        return false;
                    }
                    elseif (is_file($dir.$obj))
                    {
                        if (!unlink($dir.$obj))
                        return false;
                    }
                }
            }
            closedir($handle);
            if (!@rmdir($dir)){
                return false;
            }
            return true;
        }
        return false;
    }

    if(@$_POST['folder']!=""){
		$in=$_POST['folder'];
		$in=urldecode($in);
		require("decrypt.php");
		$folder=$out;
        $user=$user  . $folder;
		$user1=$user1  . $folder;
    }
    //read files

	$link = mysql_connect($db_server, $db_username, $db_password)
	
    or die('Could not connect: ' . mysql_error());
    //Select the database
    mysql_select_db($db_database, $link) or die('Could not select database');
    
	$query= "SELECT name FROM shared WHERE  owner='$user2' AND file_path='/$user1/'";
	echo $query;
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$i=0;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{

	$files[$i]=$row['name'];

	$i++;
	}
	
	}
	
	
	
	
	
	
	
	
	
	for($j=0;$j<$i;$j+=1) {
        $ext[$j] = substr($files[$j], strrpos($files[$j], '.') + 1);
    }
    $delete=$_POST['delete'];
    $x=count($delete);

	for($i=0;$i<=50;$i++)
	{
	echo "$i :".$files[$i]."<br />";
	}
    $d=0;$e=0;$t=0;$f=0;
    while($t<$x){
	
            $p=$delete[$t];
			
            $file=$files[$p];
			echo "hjk".$p.$files[0]."<br />";
            //delete folder
			if($file!="")
			{echo $file."<br />";
            if(is_dir("$user/$file")){
			asd ($user1.'/',$file);
			echo $file;
                if(deleteDir("$user/$file")==true){

				
                    $f+=1;
                }
                else{
                    $e+=1;
                }
            }
            //delete file
            else if(!is_dir("$user/$file")){
                if(unlink("$user/$file")){
				$query= "DELETE FROM shared WHERE  file_path='/$user1/' AND name='$file'";
				echo $query;
				mysql_query($query) or die('Query failed: ' . mysql_error());
                    $d+=1;
                }
                else{
                    $e+=1;
                }
            }
            else{
                $e+=1;
            }
			}
        $t+=1;
		
    }
    //output messages
    /*
    if($d==1){
        echo "$d file was deleted.<br />";
    }
    else if($d>1){
        echo "$d files were deleted.<br />";
    }
    if($f==1){
        echo "$f folder was deleted.<br />";
    }
    else if($f>1){
        echo "$f folders were deleted.<br />";
    }
    */
    if($e==1){
        echo "$e file was unable to be deleted.";
    }
    else if($e>1){
        echo "$e files were unable to be deleted.";
    }
    else{
		//require("tableRefresh.php");
    }
/*
    if($_GET['folder']!=""){
        if($e>0){
            echo '<meta http-equiv="refresh" content="2;url=read_dir.php?folder=' . $_GET['folder'] . '">';
        }
        else{
            echo '<meta http-equiv="refresh" content="0;url=read_dir.php?folder=' . $_GET['folder'] . '">';
        }
    }
    else{
        if($e>0){
             echo '<meta http-equiv="refresh" content="2;url=read_dir.php">';
        }
        else{
             echo '<meta http-equiv="refresh" content="0;url=read_dir.php">';
        }
    }
 * 
 */
}
?>