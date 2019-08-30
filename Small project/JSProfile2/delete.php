<?php 
	session_start();

	require_once "config.php";

	if (!isset($_SESSION['name'])) {
		die('Not logged in');
	}

	if (!isset($_GET['profile_id'])) {
		$_SESSION['error'] = "Missing profile_id to delete";
		header("Location: index.php");
		return;
	}
	if (isset($_POST["cancel"])) {
		$_SESSION['success'] = "Deleting cancelled";
		header("Location: index.php");
		return;
	}

	$stmt = $pdo->prepare("SELECT user_id, first_name, last_name, email, headline, summary FROM Profile WHERE profile_id = :xyz;");
	$stmt->execute(array(":xyz" => $_GET['profile_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ( $row === false ) {
	    $_SESSION['error'] = 'Bad value for profile_id';
	    header( 'Location: index.php' ) ;
	    return;
	}
	if (isset($_POST['delete'])) {
		$sql = "DELETE FROM Profile WHERE profile_id = :zip; DELETE FROM position WHERE profile_id = :zip;";
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
 		Confirm to delete: <br> <br>
 		<?php 
			echo ('Name: '.$row['last_name'].' ');
 			echo ($row['last_name'].'<br>');
 			echo ('Email: '.$row['email'].'<br>');
 			echo ('Headline: '.$row['headline'].'<br>');
 			echo ('Summary: '.$row['summary'].'<br>');
			$stmt = $pdo->prepare("SELECT year, description FROM position WHERE profile_id = :xyz;");
			$stmt->execute(array(":xyz" => $_GET['profile_id']));
			echo "Position: <br> <ul>";
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo('<li>Year: '.$row['year'].'<br>');
				echo('Description: '.$row['description'].'</li><br>');
			}
 		?>
 		<form method="POST">
 			<input type="submit" name="delete" value="Delete">
 			<input type="submit" name="cancel" value="Cancel">
 		</form>
 	</p>
 </body>
 </html>