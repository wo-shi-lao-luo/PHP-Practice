<?php 
session_start();

if (isset($_POST['email']) && isset($_POST['pass'])) {
	if (preg_match('/[@]/', $_POST['email'])) {
		if ($_POST['pass'] == 'php123') {
			$_SESSION['name'] = $_POST['email'];
			error_log("Login success ".$_POST['email']);
			header("Location: view.php");
			return;
		}
		else {
			$_SESSION['error'] = "Incorrect password";
			error_log("Login fail ".$_POST['pass']." $check");
			header("Location: login.php");
			return;
		}

	}
	else {
		$_SESSION['error'] = "Email must have an at-sign (@)";
		header("Location: login.php");
		return;
	}
}
// else {
// 	echo "please type in email and password";
// }
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login ddbec3bd</title>
 </head>
 <body>
 	<h1>Login here</h1>
 	<p>
 		use any email you like <br>
 		password is php123
 		<?php 
 			if ( isset($_SESSION['error']) ) {
			  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
			  unset($_SESSION['error']);
			}
 		 ?>
 		<form method='POST'>
 			Email:
 			<input type="text" name="email"><br>
 			Password:
 			<input type="password" name="pass"><br>
			<input type="submit" value="Log In">
 		</form>
 	</p>
 </body>
 </html>