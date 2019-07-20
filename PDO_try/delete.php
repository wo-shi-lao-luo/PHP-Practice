<?php 
require_once "config.php";

if (isset($_POST['ID'])) {
	$sql = "DELETE FROM user WHERE user_id = :ID";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':ID' => $_POST['ID']));
}
if (isset($_POST['name'])) {
	$sql = "DELETE FROM user WHERE name = :name";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':name' => $_POST['name']));
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete User</title>
</head>
<body>
	<h1>Type either user_id or name to delete user</h1>
	<form method='POST'>
		<p>
			Delete by user ID <br>
			<input type="text" name="ID"><br>
		</p>
		<p>
			Delete by user name <br>
			<input type="text" name="name"><br>
		</p><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>