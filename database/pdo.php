<?php	
	require_once __DIR__.'/../config/config.php';
	function getPDO() {
		$dsn = 'mysql:host='.$GLOBALS['config_db_host'].';dbname='.$GLOBALS['config_db_name'];
		$user = $GLOBALS['config_db_user'];
		$password = $GLOBALS['config_db_pass'];
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