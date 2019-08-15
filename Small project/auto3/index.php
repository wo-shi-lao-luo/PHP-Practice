<?php 
	session_start();
	require_once "config.php";
	$login = '<a href="login.php>Please log in</a>';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Index 66bd939a</title>
 </head>
 <body>
 	<h1>
 		Welcome to the Automobiles Database
 	</h1>
	<p>
		<?php 
	 		if (!isset($_SESSION['name'])) {
	 			echo "<a href='login.php'>Please log in</a>";
	 		}
	 		else {
	 			if ( isset($_SESSION['success']) ) {
					echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p><br>");
					unset($_SESSION['success']);
				}
				if ( isset($_SESSION['error']) ) {
					echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
					unset($_SESSION['error']);
				}
	 			$stmt = $pdo->query("SELECT make, model, year, mileage, auto_id FROM autos");
	 			if ($stmt->rowCount() === 0) {
	 				echo "No rows found<br><br>";
	 			}
	 			echo('<table border="1">'."<br>");
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				    echo "<tr><td>";
				    echo(htmlentities($row['make']));
				    echo("</td><td>");
				    echo(htmlentities($row['model']));
				    echo("</td><td>");
				    echo(htmlentities($row['year']));
				    echo("</td><td>");
				    echo(htmlentities($row['mileage']));
				    echo("</td><td>");
				    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / ');
				    echo('<a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
				    echo("</td></tr>\n");
				}
				echo "</table><br>";
				echo "<a href='add.php'>Add New Entry</a><br>";
				echo "<a href='logout.php'>Logout</a>";
	 		}
		 ?>		
	</p>
 </body>
 </html>