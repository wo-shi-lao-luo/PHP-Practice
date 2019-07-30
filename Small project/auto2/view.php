<?php 
	session_start();

	require_once "config.php";

	if ( ! isset($_SESSION['name']) ) {
	  die('Not logged in');
	}

	$sql = $pdo->query("SELECT make, year, mileage FROM autos");
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>View ddbec3bd</title>
 </head>
 <body>
 	<h1>
 		Tracking Auto info for 
 		<?= htmlentities($_SESSION['name']) ?>
 	</h1>
 	<p>
 		<?php 
			echo "<table border='1'><br>";
			while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				echo ("<tr><td>");
				echo (htmlentities($row['make']));
				echo ("<td><td>");
				echo (htmlentities($row['year']));
				echo ("<td><td>");
				echo (htmlentities($row['mileage']));
				echo ("<td><tr>");
			}
			echo "</table>";

			if ( isset($_SESSION['success']) ) {
			  echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p><br>");
			  unset($_SESSION['success']);
			}
 		 ?>
 	</p>
 	<a href="logout.php">Logout</a>
 	<a href="add.php">Add New</a>
 </body>
 </html>