<?php 
	session_start();

	require_once "config.php";

	if (!isset($_SESSION['name'])) {
		die('Not logged in');
	}

	if (!isset($_GET['profile_id'])) {
		$_SESSION['error'] = "Missing profile_id";
		header("Location: index.php");
		return;
	}
	if (isset($_POST["cancel"])) {
		header("Location: index.php");
		return;
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete 1008fbb2</title>
 </head>
 <body>
 	<p>
 		<h1>Viewing Profile</h1>
 		<?php include_once "list.php" ?>
 		<form method="POST">
 			<input type="submit" name="cancel" value="Back">
 		</form>
 	</p>
 </body>
 </html>