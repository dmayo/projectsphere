<?php
require "../config/config.php";
if(unlink($logPath)){
	touch($logPath);
	echo 'logs cleared';
	echo '<meta http-equiv="refresh" content="2;url=logViewer.php">';
}
else{
	echo 'error, logs could not be cleared';
	echo '<meta http-equiv="refresh" content="2;url=logViewer.php">';
}
?>