<?php 
	session_start();
	if (isset($_POST['where'])) {
		if ($_POST['where'] == '1') {
			header("Location: redir.php?re=0");
			return;
		}
		else if ($_POST['where'] == '2') {
			header("Location: redir2.php?parm=123");
			return;
		}
		if ($_POST['where'] == '3') {
			header("Location: https://na.leagueoflegends.com/en/");
			return;
		}
	}
	if (isset($_GET['re'])) {
		$welcome = 'I am router one...';
	}
	else {
		$welcome = 'Where do you want to go?';
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>redirect</title>
 </head>
 <body>
 	<h1><?= $welcome ?></h1><br>
 	Type 1 - 3 to try
 	<form method="POST">
 		<input type="text" name="where" max="3" min="1" required>
 		<input type="submit" name="submit" value="submit">
 	</form>
 </body>
 </html>