<?php 
	session_start();
 	if (isset($_SESSION['success'])) {
		$msg = '<p style="color: green">'.$_SESSION['success'].'</p><br>';
	}
	if (!isset($_SESSION['account'])) {
		$msg = '<p>Click the link to login <a href="login.php">Click here!</a></p>';
	}
	else {
		$msg .= '<p>Click the link to logout <a href="logout.php">Click here!</a></p>';
	}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login sample</title>
</head>
<body>
	<h1>Login Test</h1>
	<?= $msg ?>


</body>
</html>