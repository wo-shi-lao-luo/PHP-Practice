<?php 
require_once "config.php";

$err = null;

if (isset($_POST['logout'])) {
	header('Location:index.php');
}
if ( !isset($_GET['email']) || strlen($_GET['email']) < 1  ) {
    die('Name parameter missing');
}
else {
	$user = htmlentities($_GET['email']);
}

if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && strlen($_POST['make'])>0 && is_numeric($_POST['year']) && is_numeric($_POST['mileage'])) {
	$sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':make' => $_POST['make'], ':year' => $_POST['year'], ':mileage' => $_POST['mileage']));
}
else {
	$err = "Make is required<br>Mileage and year must be numeric<br>";
}

if (isset($_POST['delete'])) {
	$sql = "DELETE FROM user WHERE name = :del";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':del' => $_POST['delete']));
}

$sql = $pdo->query("SELECT make, year, mileage FROM autos");
echo ("<h1>Tracking Auto for ".$user."</h1>");

echo "<table border='1'><br>";
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	echo ("<tr><td>");
	echo (htmlentities($row['make']));
	echo ("<td><td>");
	echo (htmlentities($row['year']));
	echo ("<td><td>");
	echo (htmlentities($row['mileage']));
	// echo ("<td><td>");
	// echo ("<form method='POST'>");
	// echo ("<input type='hidden' name='delete' value='".$row['name']."'>");
	// echo ("<input type='submit' value='delete'>");
	// echo ("</form>");
	echo ("<td><tr>");
}
echo "</table>";
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Auto cd2b3387</title>
 </head>
 <body>
 	<p>
 		Add user here
 		<form method='POST'>
 			<?= $err ?>
 			Make:
 			<input type="text" name="make"><br>
 			Year:
 			<input type="number" name="year"><br>
 			Mileage:
 			<input type="number" name="mileage"><br>
 			<input type="submit" name="submit" value="Add User">
 			<br>
 			<br>
 			<input type="submit" name="logout" value="logout">
 		</form>
 	</p>
 </body>
 </html>