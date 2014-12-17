<?php
function addLog($file,$time,$user,$event){
	$message = $time . ';' . $user . ';' . $event . "\n";
	$fh = fopen($file, 'a') or die("can't open file");
	fwrite($fh, $message);
	fclose($fh);
}
?>