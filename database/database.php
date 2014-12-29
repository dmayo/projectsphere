<?php
	require_once (__DIR__."/pdo.php");
	require_once (__DIR__."/../config/config.php");
	
	function getProjectsBrief($limit = 9999, $offset = 0, $category = "", $startGrade = "", $endGrade="") {
		$pdo = getPDO();
		if (($startGrade == "" && $endGrade != "") || ($startGrade != "" && $endGrade == "")) {
			throw new Exception("Invalid Function Input :(");
		}
		
		
		if ($category != "" &&  $startGrade!= "") {
			$where = " WHERE category=':category' AND grade >= ':startGrade' AND grade <= ':endGrade' ";
		} else if ($category != "") {
			$where = " WHERE category=':category' ";
		} else if ($startGrade!= "") {
			$where = "WHERE grade >= :startGrade AND grade <= :endGrade";
		} else {
			$where = "";
		}
		$sql = "SELECT * FROM projects $where ORDER BY id DESC LIMIT :limit OFFSET :offset";
		$query = $pdo->prepare($sql);
		
		if ($category != "")
			$query->bindParam(':category', $category, PDO::PARAM_STR);
		$query->bindParam(':limit', $limit, PDO::PARAM_INT);
		$query->bindParam(':offset', $offset, PDO::PARAM_INT);
		
		if ($startGrade!="") {
			$query->bindParam(':startGrade', $startGrade, PDO::PARAM_INT);
			$query->bindParam(':endGrade', $endGrade, PDO::PARAM_INT);
		}
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	function getNumProjects(){
		$pdo = getPDO();
		$sql = "SELECT COUNT(*) FROM projects";
		$query = $pdo->prepare($sql);
		$query->execute();
		$result = $query->fetch();
		return $result[0];
	}

	function getProjectByID($id) {
		$pdo = getPDO();
		$sql = "SELECT * FROM projects WHERE id= :id LIMIT 1";
		$query = $pdo->prepare($sql);
		$query->execute(array('id' => $id));
		$result = $query->fetch(PDO::FETCH_ASSOC);
		if ($result) {
			$result['authorNames'] = getAuthorsFromIDs($result['authors']);
			return $result;
		} else {
			return false;
		}
		
	}
	
	function getAuthorsFromIDs($ids) {
		$ids = split(",", $ids);
		$authors = array();
		foreach ($ids as $id)  {
			if (!empty($id)) {
				$name = getNameFromUserID($id);
				$name['id'] = $id;
				
				var_dump ($name);
				array_push($authors, $name);
			}
		}
		return $authors;
	}
	
	function getNameFromUserID($id) {
		$pdo = getPDO();
		$sql = "SELECT firstname, lastname FROM users WHERE id = :id";
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