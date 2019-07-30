<?php 
	session_start();
	if (isset($_POST['account']) && isset($_POST['pw'])) {
		unset($_SESSION['account']);
		if ($_POST['pw'] == 'password') {
			$_SESSION['account'] = $_POST['account'];
			$_SESSION['success'] = 'Logged in.';
			header('Location: index.php');
			return;
		}
		else {
			$_SESSION['error'] = 'Incorrct password';
			header('Location: login.php');
			return;
		}
	}
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login</title>
 </head>
 <body>
 	<h1>Login here</h1>
 	<p>Password is password</p>
 	<?php 
 		if (isset($_SESSION['error'])) {
 			echo('<p style="color:red">'.$_SESSION['error'].'</p><br>');
 			unset($_SESSION['error']);
 		}
 		if (isset($_SESSION['success'])) {
 			echo('<p style="color:green">'.$_SESSION['success'].'</p><br>');
 			unset($_SESSION['success']);
 		} 		
 	 ?>
 	 <form method='POST'>
 	 	Account: <input type="text" name="account">
 	 	Password: <input type="password" name="pw">
 	 	<input type="submit" name="submit" value='login'>
 	 	<button href='index.php'>Cancel</button>
 	 </form>
 </body>
 </html>