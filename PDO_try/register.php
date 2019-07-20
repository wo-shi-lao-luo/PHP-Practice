<?php 
require_once "config.php";

$feedback = null;

if (isset ($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
	$sql = "INSERT INTO user (name, email, password) VALUES (:name, :email, :password)";
	echo ("<pre>".$sql."</pre>");
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':name' => $_POST['name'],
		':email' => $_POST['email'],
		':password' => $_POST['password']
	));
	$feedback = 'Register succeed';
}
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
 		<?php
 		echo ($feedback);
 		$feedback = null;	
 		 ?>
 	</form>
 </body>
 </html>