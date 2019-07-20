<?php 
if (isset($_POST['who']) && isset($_POST['pass'])) {
	if ($_POST['pass'] == 'php123') {
		header("Location:auto.php?email=".urlencode($_POST['who']));
	}
	else {
		echo "incorrect password";
	}
}
else {
	echo "please type in email and password";
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login cd2b3387</title>
 </head>
 <body>
 	<h1>Login here</h1>
 	<p>
 		use any email you like <br>
 		password is php123
 		<form method='POST'>
 			Email:
 			<input type="email" name="who"><br>
 			Password:
 			<input type="password" name="pass"><br>
			<input type="submit" value="Log In">
 		</form>
 	</p>
 </body>
 </html>