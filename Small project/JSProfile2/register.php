<?php 
	session_start();

	require_once('config.php');

	if (isset($_POST['cancel'])) {
		header("Location:index.php");
		return false;
	}

	if (isset($_POST['email']) && isset($_POST['pw']) && isset($_POST['rpw'])) {
		$salt = 'XyZzy12*_';
		$pw = hash('md5', $salt.$_POST['pw']);

		$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :em, :pw);");
		$stmt->execute(array(':name' => $_POST['name'], ':em' => $_POST['email'], ':pw' => $pw));

		$stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
		$stmt->execute(array( ':em' => $_POST['email'], ':pw' => $pw));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ( $row !== false ) {
			$_SESSION['name'] = $row['name'];
			$_SESSION['user_id'] = $row['user_id'];
			// Redirect the browser to index.php
			header("Location: index.php");
			return;
		}
		header("Location:index.php");
		return false;
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Register 7914e340</title>
 </head>
 <body>
 	<h1>Register a New User</h1>
 	<form method="POST">
 		Name:
 		<input type="name" name="name" id="name"> <br>
 		Email:
 		<input type="email" name="email" id="email"> <br>
 		Password:
 		<input type="password" name="pw" id="pw"> <br>
 		Re-enter Password:
 		<input type="password" name="rpw" id="rpw"> <br>
 		<input type="submit" onclick="return validate();" name="submit">
 		<input type="submit" name="cancel">
 	</form>
 	<script type="text/javascript">
 		function validate(argument) {
 			name = document.getElementById('name').value;
 			email = document.getElementById('email').value;
 			pw = document.getElementById('pw').value;
	 		rpw = document.getElementById('rpw').value;
	 		try {
		 		if (name == null || pw == null || rpw == null || email == null || name == '' || pw == '' || rpw == '' || email == '') {
					alert('All fields must be filled out');
					return false;
				}
		 		if (pw !== rpw) {
		 			alert('passwords do not match');
		 			return false;
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