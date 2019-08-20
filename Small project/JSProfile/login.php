<?php 
	session_start();

	require_once('config.php');

	if (isset($_POST['cancel'])) {
		header("Location:index.php");
		return false;
	}

	if (isset($_POST['email']) && isset($_POST['pass'])) {
		$salt = 'XyZzy12*_';
		$check = hash('md5', $salt.$_POST['pass']);

		$stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
		$stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row !== false ) {
			$_SESSION['name'] = $row['name'];
			$_SESSION['user_id'] = $row['user_id'];
			// Redirect the browser to index.php
			header("Location: index.php");
			return;
		}
	}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>
 		Login 7914e340
 	</title>
 </head>
 <body>
 	<h1>Please Log In</h1>
	<form method="POST" action="login.php">
		<label for="email">Email</label>
		<input type="text" name="email" id="email"><br/>
		<label for="password">Password</label>
		<input type="password" name="pass" id="password"><br/>
		<input type="submit" onclick="return validate();" value="Log In">
		<input type="submit" name="cancel" value="Cancel">
	</form>
	<script type="text/javascript">
		function validate() {
			try {
				pw = document.getElementById('password').value;
				email = document.getElementById('email').value;
				if (pw == null || email == null || pw == '' || email == '') {
					alert('Both fields must be filled out');
					return false;
				}
				else {
					if (email.indexOf('@') == -1) {
						alert('Invalide email address');
						return false;
					}
				}
				return true;
			}
			catch (e) {
				return false;
			}
			
		}
	</script>
 </body>
 </html>