<?php
require "spacelimit.php";
require "config/config.php";
chdir($uploadPath);
		$name=@$_POST['name'];
            function getDirectorySize($path) {
                $totalsize = 0;
                $totalcount = 0;
                $dircount = 0;
				
                if ($handle = opendir ($path)) {
                    while (false !== ($file = readdir($handle))) {
                        $nextpath = $path . '/' . $file;
                        if ($file != '.' && $file != '..' && !is_link ($nextpath)) {
                            if (is_dir ($nextpath)) {
                                $dircount++;
                                $result = getDirectorySize($nextpath);
                                $totalsize += $result['size'];
                                $totalcount += $result['count'];
								
                                $dircount += $result['dircount'];
                            }
                            elseif (is_file ($nextpath)) {
                                $totalsize += filesize ($nextpath);
                                $totalcount++;
                            }
                        }
                    }
                }
                closedir ($handle);
                $total['size'] = $totalsize;
                $total['count'] = $totalcount;
                $total['dircount'] = $dircount;
                return $total;
            }

            function sizeFormat($size) {
                $size=round($size/1024,2);
				$size=ceil($size);
                return $size;
            }
			function freeSpace($path,$db_server, $db_username, $db_password, $db_database){
                $size=getDirectorySize("$path");
                $usedspace=round(sizeFormat($size['size']));
                $usedspace=round($usedspace/1024,2);
                $slUser=$_COOKIE["upload_user"];
                $totalspace=spacelimit($db_server, $db_username, $db_password, $db_database, $slUser);
                $percentused=round(($usedspace*100)/$totalspace,0);
                echo "You are currently using $usedspace MB ($percentused%) of your $totalspace MB";
            }
			function freeSpace2($path,$db_server, $db_username, $db_password, $db_database){
                $size=getDirectorySize("$path");
                $usedspace=round(sizeFormat($size['size']));
                $usedspace=round($usedspace/1024,2);
                $slUser=$_COOKIE["upload_user"];
                $totalspace=spacelimit($db_server, $db_username, $db_password, $db_database, $slUser);
                $percentused=round(($usedspace*100)/$totalspace,0);
                echo $percentused;
            }
?>
<table class="freeSpace"><tr><td align="center"><div id="freeSpaceBar"></td></tr><tr><td align="center"><?php freeSpace($name,$db_server, $db_username, $db_password, $db_database); ?></td></tr></table>
<script type="text/javascript">
	$(function() {
		$("#freeSpaceBar").progressbar({
			value: <?php freeSpace2($name,$db_server, $db_username, $db_password, $db_database);?>
		});
	});
</script>