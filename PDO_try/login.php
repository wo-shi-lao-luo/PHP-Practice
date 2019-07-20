<?php 
require_once "config.php";

if (isset($_POST['name']) && isset($_POST['password'])) {
	$n = $_POST['name'];
	$p = $_POST['password'];
	$sql = "SELECT name, email FROM user WHERE name=:name AND password=:password";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(':name'=>$n, ':password'=>$p));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row == FALSE) {
		echo 'Login Failed';
	}
	else {
		echo 'Login Succeed';
	}
}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 </head>
 <body>
 	<h1>Login</h1>
 	<p>
 		<form method='POST'>
 			Name:  		
 			<input type="text" name="name"><br>
 			Password:	
 			<input type="password" name="password"><br>
 			<input type="submit" name="submit">
 		</form>
 	</p>
 </body>
 </html>