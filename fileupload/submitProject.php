<?php
	require_once "../database/pdo.php";

	$pdo = getPDO();
	
	$projectName = $_POST['projectName'];
	$category = $_POST['category'];
	$grade = $_POST['grade'];
	$school = $_POST['school'];
	$competition = $_POST['competition'];
	$year = $_POST['year'];
	$video_link = $_POST['video_link'];
	$description = $_POST['description'];
	$sources = $_POST['sources'];
	
	$photos = $_POST['photos'];
	$authors = ",1,";
	
	$sql = 'INSERT INTO projects (project_name, category, grade, 
			authors, school, competition, year,	description, photos, 
			video_link, sources, views, submission_date) value 
			(:projectName, :category, :grade, :authors, :school, :competition,
			:year, :description, :photos, :video_link, :sources, 0, now())';
	
	$query = $pdo->prepare($sql);
	$exe = array('projectName' => $projectName, 'category' => $category, 'authors' => $authors,
					'grade' => $grade, 'authors' => $authors, 'school' => $school,
					'competition' => $competition, 'year' => $year, 'description' => $description,
					'photos' => $photos, 'video_link' => $video_link, 'sources' => $sources);
	$query->execute($exe);


?>