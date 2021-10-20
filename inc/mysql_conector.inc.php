<?php 
	$dsn = "mysql:dbname=ssma;host=localhost";
	$user = "root";
	$password = "root";
	//$password = "zBELTUAKpNQvCOl6";
	$errorDbConexion = true;

	try {
		$pdo = new PDO($dsn,$user,$password);
		$errorDbConexion = false;
	}
	catch ( PDOException $e) {
		echo 'Error al conectarnos ' . $e->getMessage();
	}

	$pdo->exec("SET CHARACTER SET utf8"); // <--utf8
?>