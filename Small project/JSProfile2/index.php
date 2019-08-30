<?php 
	session_start();
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Index 1008fbb2</title>
 </head>
 <body>
 	<h1>
 		Registry System
 	</h1>
 	<?php 
 	if (isset($_SESSION['name'])) {
 		require_once('view.php');
 		echo '<a href="logout.php">Logout</a><br>';
		echo '<a href="add.php">Add New Entry</a>';
	}
	else {
		echo '<a href="login.php">Please log in</a><br>';
		echo '<a href="register.php">Register a New User</a>';
	}
 	 ?>
 </body>
 </html>