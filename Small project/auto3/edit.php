<?php 
	session_start();

	require_once "config.php";

	if (!isset($_GET['auto_id'])) {
		$_SESSION['error'] = "Missing auto_id to delete";
		header("Location: index.php");
		return;
	}
	if (isset($_POST["cancel"])) {
		$_SESSION['success'] = "Deleting cancelled";
		header("Location: index.php");
		return;
	}

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


				$sql = "UPDATE `autos` SET `model`=:model,`make`=:make,`year`=:year,`mileage`=:mileage WHERE auto_id=:auto_id";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(':make' => $_POST['make'], ':model' => $_POST['model'], ':year' => $_POST['year'], ':mileage' => $_POST['mileage'], ':auto_id' => $_GET['auto_id']));
				$_SESSION['success'] = "Record edited";
				header("Location: index.php");
				return;
			}
		}
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit 66bd939a</title>
 </head>
 <body>
 	<p>
 		<h1>Edit Auto here</h1>	
 		<form method='POST'>
 			<?php 
				if ( isset($_SESSION['error']) ) {
				  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
				  unset($_SESSION['error']);
				}
				$id = $_GET['auto_id'];
				$stmt = $pdo->query("SELECT make, model, year, mileage FROM autos WHERE auto_id = $id");
	 			if ($stmt->rowCount() === 0) {
	 				echo "No rows found<br><br>";
	 			}
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo "Make:";
				    echo('<input type="text" name="make" value="'.htmlentities($row['make']).'"><br>');
				    echo "Model:";
				    echo('<input type="text" name="model" value="'.htmlentities($row['model']).'"><br>');
				    echo "Year:";
				    echo('<input type="text" name="year" value="'.htmlentities($row['year']).'"><br>');
				    echo "Mileage:";
				    echo('<input type="text" name="mileage" value="'.htmlentities($row['mileage']).'"><br>');
				}
 			 ?>
 			<input type="submit" name="submit" value="Save">
 			<input type="submit" name="cancel" value="Cancel">
 		</form>
 	</p>
 </body>
 </html>
