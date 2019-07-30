<?php 
	session_start();

	require_once "config.php";

	if ( ! isset($_SESSION['name']) ) {
	  die('Not logged in');
	}

	if (isset($_POST["logout"])) {
		header("Location: view.php");
		return;
	}

	if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
		 if (strlen($_POST['make'])>0 && is_numeric($_POST['year']) && is_numeric($_POST['mileage'])) {
			$sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(':make' => $_POST['make'], ':year' => $_POST['year'], ':mileage' => $_POST['mileage']));
			$_SESSION['success'] = "Record inserted";
			header("Location: view.php");
			return;
		}
		else {
			$_SESSION['error'] = "Make is required, Mileage and year must be numeric";
			header("Location:add.php");
			return;
		}
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add ddbec3bd</title>
 </head>
 <body>
 	<p>
 		<h1>Add user here</h1>	
 		<form method='POST'>
 			<?php 
				if ( isset($_SESSION['error']) ) {
				  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
				  unset($_SESSION['error']);
				}
 			 ?>
 			Make:
 			<input type="text" name="make"><br>
 			Year:
 			<input type="text" name="year"><br>
 			Mileage:
 			<input type="text" name="mileage"><br>
 			<input type="submit" name="submit" value="Add">
 			<input type="submit" name="logout" value="Cancel">
 		</form>
<!--  		<a href="add.php">Add New</a>
 		<a href="Logout.php">Logout</a> -->
 	</p>
 </body>
 </html>