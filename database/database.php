<?php
	require_once (__DIR__."/pdo.php");
	require_once (__DIR__."/../config/config.php");
	
	function getProjectsBrief($limit = 9999, $offset = 0) {
		$pdo = getPDO();
		$sql = "SELECT * FROM projects ORDER BY id DESC LIMIT :limit OFFSET :offset";
		$query = $pdo->prepare($sql);
		$array = array('limit' => $limit, 'offset' => $offset);
		$query->bindParam(':limit', $limit, PDO::PARAM_INT);
		$query->bindParam(':offset', $offset, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	function getProjectByID($id) {
		$pdo = getPDO();
		$sql = "SELECT * FROM projects WHERE id= :id LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute(array('id' => $id));
		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	function addSkeletonUser($email, $firstname, $lastname) {
		$pdo = getPDO();
		$sql = "INSERT INTO users(email, firstname, lastname) 
					VALUES (:email, :firstname, :lastname)";
		$query = $pdo->prepare($sql);
		$query->execute(array('email' => $email, 'firstname' => $firstname,
								'lastname' => $lastname));
		return $pdo->lastInsertId();
	}
	
	//user functinos
	function getUserIDByEmail($email) {
		$pdo = getPDO();
		$sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute(array('email' => $email));
		if($row = $query->fetch(PDO::FETCH_ASSOC)) {
			return $row['id'];
		} else {
			return -1;
		}
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