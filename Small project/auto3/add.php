<?php 
	session_start();

	require_once "config.php";

	if ( ! isset($_SESSION['name']) ) {
	  die('Not logged in');
	}

	if (isset($_POST["cancel"])) {
		header("Location: index.php");
		return;
	}

	if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
		if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1) {
			$_SESSION['error'] = "All fields are required";
			header("Location: add.php");
			return;
		}
		else {
			if (!is_numeric($_POST['mileage'])) {
				$_SESSION['error'] = "Mileage must be an integer";
				header("Location:add.php");
				return;
			}
			if (!is_numeric($_POST['year'])) {
				$_SESSION['error'] = "Year must be an integer";
				header("Location:add.php");
				return;
			}
			else {
				
				$sql = "INSERT INTO autos (make, model, year, mileage) VALUES (:make, :model, :year, :mileage)";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(':make' => $_POST['make'], ':model' => $_POST['model'], ':year' => $_POST['year'], ':mileage' => $_POST['mileage']));
				$_SESSION['success'] = "Record inserted";
				header("Location: index.php");
				return;
			}
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
 			Model:
 			<input type="text" name="model"><br>
 			Year:
 			<input type="text" name="year"><br>
 			Mileage:
 			<input type="text" name="mileage"><br>
 			<input type="submit" name="submit" value="Add">
 			<input type="submit" name="cancel" value="Cancel">
 		</form>
 	</p>
 </body>
 </html>