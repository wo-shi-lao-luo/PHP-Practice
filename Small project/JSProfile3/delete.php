<?php 
	session_start();

	require_once "config.php";

	if (isset($_POST["cancel"])) {
		$_SESSION['error'] = "Delete cancelled";
		header("Location: index.php");
		return;
	}	

	if (isset($_POST['delete'])) {
		$sql = "DELETE FROM Profile WHERE profile_id = :zip; DELETE FROM position WHERE profile_id = :zip; DELETE FROM education WHERE profile_id = :zip";
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute(array(':zip' => $_GET['profile_id']));
	    $_SESSION['success'] = 'Record deleted';
	    header( 'Location: index.php' ) ;
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
 		<h1>Confirm to delete: <br></h1>
 		
 		<?php 
 			include "list.php";
 		?>
 		<form method="POST">
 			<input type="submit" name="delete" value="Delete">
 			<input type="submit" name="cancel" value="Cancel">
 		</form>
 	</p>
 </body>
 </html>