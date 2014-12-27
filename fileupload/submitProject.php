<?php

	require "../login/checklogin.php";
	require "../login/config/config.php";

	$id = checklogin ($db_server, $db_username, $db_password, $db_database, $_COOKIE["upload_user"], $_COOKIE["user_code"]);
	if(!isset($_COOKIE["upload_user"])||!isset($_COOKIE["user_code"])||!$id) {
		echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
		echo '<meta http-equiv="refresh" content="0;url=../login/login.php">';
	}
	else {
	
	require_once "../database/pdo.php";
	require_once "../database/database.php";

	$pdo = getPDO();
	
	$projectName = $_POST['projectName'];
	$teammate_email = $_POST['team_email'];
	$teammate_first_name = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['team_first_name']);
	$teammate_last_name = preg_replace("/[^A-Za-z0-9 ]/", '', $_POST['teammate_last_name']);
	$teammateID = false;
	if ($teammate_email != null) {
		if (filter_var($teammate_email, FILTER_VALIDATE_EMAIL)) {
			if (empty($teammate_first_name) || empty($teammate_last_name)) {
				throw new InvalidTeammateException("Please enter a valid name for you're teammate.");
			}
			$teammateID = getUserIDByEmail($email);
		} else {
			throw new InvalidTeammateException("The email you entered for you're teammate is invalid.");
		}
	}
	
	
	
	$category = $_POST['category'];
	$grade = $_POST['grade'];
	$school = $_POST['school'];
	$competition = $_POST['competition'];
	$year = $_POST['year'];
	$video_link = $_POST['video_link'];
	$website_link = $_POST['website_link'];
	$description = $_POST['description'];
	$sources = $_POST['sources'];
	
	$photos = $_POST['photos'];
	if ($teammateID) {
		$authors = ",$id,$teammateID,";
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

  	echo '<head><META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1"></head>';
  	echo '<meta 4http-equiv="refresh" content="0;url=../projects/index.php">';
?>