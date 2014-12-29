<?php

	require "../login/checklogin.php";
	require "../login/config/config.php";

	$id = checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"]);
	if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||!$id) {
	
		echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
		echo '<meta http-equiv="refresh" content="0;url=../login/login.php">';
	
	} else {
	
	require_once "../database/pdo.php";
	require_once "../database/database.php";

	$pdo = getPDO();
	
	if (isset($_POST['projectName'])) {
		$projectName = trim(filter_var($_POST['projectName'], FILTER_SANITIZE_STRING));
	}
	
	if (isset($_POST['team_email'])) {
		$teammate_email = filter_var(strtolower($_POST['team_email']), FILTER_SANITIZE_EMAIL);
	}
	
	if (isset($_POST['team_first_name'])) {
		$teammate_first_name = preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($_POST['team_first_name']));
	}
	
	if (isset($_POST['team_last_name'])) {
		$teammate_last_name = preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($_POST['team_last_name']));
	}
	
	if (isset($_POST['category'])) {
		$category =  trim(filter_var($_POST['category'], FILTER_SANITIZE_STRING));
	}
	
	if (isset($_POST['grade'])) {
		$grade = filter_var($_POST['grade'], FILTER_SANITIZE_NUMBER_INT);
	}
	
	if (isset($_POST['school'])) {
		$school = trim(filter_var($_POST['school'], FILTER_SANITIZE_STRING));
	}
	
	if (isset($_POST['competition'])) {
		$competition = trim(filter_var($_POST['competition'], FILTER_SANITIZE_STRING));
	}
	
	$year = 2015;
	
	if (isset($_POST['video_link'])) {
		$video_link = filter_var($_POST['video_link'], FILTER_SANITIZE_URL);
	} else {
		$video_link = "";
	}
	
	if (isset($_POST['website_link'])) {
		$website_link = filter_var($_POST['website_link'], FILTER_SANITIZE_URL);
	} else {
		$website_link = "";
	}
	
	if (isset($_POST['description'])) {
		$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	}
	
	if (isset($_POST['sources'])) {
		$sources = filter_var($_POST['sources'], FILTER_SANITIZE_STRING);
	} else {
		$sources = "";
	}
	
	if (isset($_POST['photos'])) {
		$photos = filter_var($_POST['photos'], FILTER_SANITIZE_URL);
	} else {
		$photos = "";
	}
	
	if (empty($projectName)) {
		throw new InvalidInputException("Please enter a valid Project Name");
	}
	
	if (empty($category)) {
		throw new InvalidInputException("Please select a Category");
	}
	
	if (empty($grade)) {
		throw new InvalidInputException("Please select a Grade");
	}
	
	if (empty($school)) {
		throw new InvalidInputException("Please enter a valid School Name");
	}
	
	if (empty($competition)) {
		throw new InvalidInputException("Please enter a valid Competition Name");
	}
	
	if (empty($description)) {
		throw new InvalidInputException("Please enter a valid Project Description");
	}
	
	$teammateID = false;
	if (!empty($teammate_email)) {
		if (filter_var($teammate_email, FILTER_VALIDATE_EMAIL)) {
			
			$teammateID = getUserIDByEmail($teammate_email);
			if ($teammateID == -1) {
				if (empty($teammate_first_name) || empty($teammate_last_name)) {
					throw new InvalidTeammateException("Please enter a valid name for you're teammate.");
				}
				$teammateID = addSkeletonUser($teammate_email, $teammate_first_name, $teammate_last_name);
			}
		} else {
			throw new InvalidTeammateException("The email you entered for you're teammate is invalid.");
		}
	}
	
	if ($teammateID) {
		$authors = ",$id,$teammateID,";
	} else {
		$authors = ",$id,";
	}
	
	$sql = 'INSERT INTO projects (project_name, category, grade, 
			authors, school, competition, year,	description, photos, 
			video_link, website_link, sources, views, submission_date) value 
			(:projectName, :category, :grade, :authors, :school, :competition,
			:year, :description, :photos, :video_link, :website_link, :sources, 0, now())';
	
	$query = $pdo->prepare($sql);
	$exe = array('projectName' => $projectName, 'category' => $category, 'authors' => $authors,
					'grade' => $grade, 'authors' => $authors, 'school' => $school,
					'competition' => $competition, 'year' => $year, 'description' => $description,
					'photos' => $photos, 'video_link' => $video_link, 'website_link' => $website_link, 'sources' => $sources);
	$query->execute($exe);

  	//echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
  	//echo '<meta 4http-equiv="refresh" content="0;url=../projects/index.php">';
	}
?>