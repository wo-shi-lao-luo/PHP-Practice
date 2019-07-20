<?php 
require_once "config.php";

if (isset ($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
	$sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':name' => $_POST['name'],
		':email' => $_POST['email'],
		':password' => $_POST['password']
	));

}

if (isset($_POST['delete'])) {
	$sql = "DELETE FROM user WHERE name = :del";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':del' => $_POST['delete']));
}

$sql = $pdo->query("SELECT name, email, password FROM user");
echo "<table border='1'><br>";
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	echo ("<tr><td>");
	echo ($row['name']);
	echo ("<td><td>");
	echo ($row['email']);
	echo ("<td><td>");
	echo ($row['password']);
	echo ("<td><td>");
	echo ("<form method='POST'>");
	echo ("<input type='hidden' name='delete' value='".$row['name']."'>");
	echo ("<input type='submit' value='delete'>");
	echo ("</form>");
	echo ("<td><tr>");
}
echo "</table>";
 ?>

<!DOCTYPE html>
 <html>
 <head>
 	<title>
 		Register
 	</title>
 </head>
 <body>
 	<h1>Register</h1>
 	<form method='POST'>
 		<p>
 			Name
 			<input type="text" name="name">
 		</p>
 		 <p>
 			Email
 			<input type="text" name="email">
 		</p>
 		 <p>
 			Password
 			<input type="password" name="password">
 		</p>
 		<p><input type="submit" name="Register"></p>
 	</form>
 </body>
 </html>