<?php	
	function getPDO() {
		$dsn = 'mysql:host=localhost;dbname=project_sphere';
		$user = 'root';
		$password = 'school';
		try {
			$pdo = new PDO($dsn, $user, $password);
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
		catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
?>