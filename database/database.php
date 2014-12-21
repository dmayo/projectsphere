<?php
	require_once (__DIR__."/pdo.php");
	require_once (__DIR__."/../config/config.php");
	
	function getProjectsBrief($limit = 9999, $offset = 0) {
		$pdo = getPDO();
		$sql = "SELECT * FROM projects ORDER BY id DESC LIMIT $limit OFFSET $offset";
		$query = $pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	function getProjectsByID($id) {
		$pdo = getPDO();
		$sql = "SELECT * FROM projects WHERE id=" . $id . " LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	/*
	function getPhotoUrl($id) {
		if(is_int($id)) {
			return null;
		}
		$pdo = getPDO();
		$sql = "SELECT path FROM photos WHERE id=':id'";
		$query = $pdo->prepare($sql);
		$query->execute(array('id'=>$id));
		$result = $query->fetch();
		return $GLOBALS['config_url'].$result['path'];
		
	}
	*/
?>