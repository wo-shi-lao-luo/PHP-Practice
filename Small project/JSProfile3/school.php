<?php 

	require_once "config.php";

	// $stmt = $pdo->prepare('SELECT name FROM Institution WHERE name LIKE :prefix');
	// $stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));

	$stmt = $pdo->prepare('SELECT name FROM Institution');
	$stmt->execute();

	$retval = array();
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
	    $retval[] = $row['name'];
	}

	echo(json_encode($retval));

 ?>