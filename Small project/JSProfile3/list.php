<?php 

	require_once "config.php";

	if (!isset($_SESSION['name'])) {
		die('Not logged in');
	}

	if (!isset($_GET['profile_id'])) {
		$_SESSION['error'] = "Missing profile_id";
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

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete 1008fbb2</title>
 </head>
 <body>
 	<p>
 		<?php 
			echo ('Name: '.htmlentities($row['last_name']).' ');
 			echo ($row['last_name'].'<br>');
 			echo ('Email: '.htmlentities($row['email']).'<br>');
 			echo ('Headline: '.htmlentities($row['headline']).'<br>');
 			echo ('Summary: '.htmlentities($row['summary']).'<br><br>');

 			$stmt = $pdo->prepare("SELECT year, name, profile_id FROM education LEFT JOIN institution ON education.institution_id = institution.institution_id WHERE profile_id = :xyz;");
 			$stmt->execute(array(":xyz" => $_GET['profile_id']));
			echo "Education: <br> <ul>";
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo('<li>'.htmlentities($row['year']).": ".htmlentities($row['name']).'<br>');
			}
			echo "</ul>";

			$stmt = $pdo->prepare("SELECT year, description FROM position WHERE profile_id = :xyz ORDER BY year;");
			$stmt->execute(array(":xyz" => $_GET['profile_id']));
			echo "Position: <br> <ul>";
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				echo('<li>'.htmlentities($row['year']).": ".htmlentities($row['description']).'<br>');
			}
			echo "</ul>";
 		?>
 	</p>
 </body>
 </html>