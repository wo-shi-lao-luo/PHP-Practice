<?php 
	session_start();

	require_once "config.php";

	if (!isset($_SESSION['name'])) {
		die('Not logged in');
	}

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

	$stmt = $pdo->prepare("SELECT make, model, year FROM autos WHERE auto_id = :xyz");
	$stmt->execute(array(":xyz" => $_GET['auto_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ( $row === false ) {
	    $_SESSION['error'] = 'Bad value for auto_id';
	    header( 'Location: index.php' ) ;
	    return;
	}
	if (isset($_POST['delete'])) {
		$sql = "DELETE FROM autos WHERE auto_id = :zip";
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute(array(':zip' => $_GET['auto_id']));
	    $_SESSION['success'] = 'Record deleted';
	    header( 'Location: index.php' ) ;
	    return;
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete</title>
 </head>
 <body>
 	<p>
 		Confirm to delete "
 		<?php 
 			echo ($row['year'].' ');
 			echo ($row['make'].' ');
 			echo ($row['model'].'"?<br>');
 		?>
 		<form method="POST">
 			<input type="submit" name="delete" value="confirm">
 		</form>
 	</p>
 </body>
 </html>