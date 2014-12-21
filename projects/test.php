<?php
	require_once (__DIR__."/../database/database.php");
	$projects = getProjectsBrief();
	foreach ($projects as $project) {
		echo "name:".$project['project_name']."<br />";
		echo "descrption:".substr($project['description'], 0, 30)."<br />";
		$photos = split('<',$project['photos']);
		$photo_url = "";
		foreach ($photos as $photo)  {
			$photo_url= $photo;
			//$photo_url=getPhotoUrl($photo);
			if(!empty($photo_url)) {
				break;
			}
		}
		echo "<image src='$photo_url' width='100px'/><br/>";
	}
	
?>