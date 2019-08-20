<?php 
	session_start();

	require_once('config.php');

	if (!isset($_SESSION['name']) || !isset($_SESSION['user_id'])) {
		die('Not logged in');
	}

	if (isset($_POST['cancel'])) {
		header("Location:index.php");
		return false;
	}

	if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
		if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
			$_SESSION['error'] = "All fields are required";
			header("Location:add.php");
			return false;
		}

		if (strrpos($_POST['email'], '@') == -1) {
			$_SESSION['error'] = "Email address must contain @";
			// header("Location:add.php");
			return false;
		}
		$stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');

		$stmt->execute(array(
		  ':uid' => $_SESSION['user_id'],
		  ':fn' => $_POST['first_name'],
		  ':ln' => $_POST['last_name'],
		  ':em' => $_POST['email'],
		  ':he' => $_POST['headline'],
		  ':su' => $_POST['summary'])
		);

		$_SESSION['success'] = "Profile added";
		header('Location:index.php');
		return false;
	}



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add</title>
 </head>
 <body>
 	<h1>Add New Profile 7914e340</h1>
 	<p>
 		<?php 
 			if (isset($_SESSION['error'])) {
 				echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
 				unset($_SESSION['error']);
 			}
 		 ?>
		<form method="post">
			<p>First Name:
				<input type="text" name="first_name" size="60"/></p>
				<p>Last Name:
				<input type="text" name="last_name" size="60"/></p>
				<p>Email:
				<input type="text" name="email" size="30"/></p>
				<p>Headline:<br/>
				<input type="text" name="headline" size="80"/></p>
				<p>Summary:<br/>
				<textarea name="summary" rows="8" cols="80"></textarea>
				<p>
				<input type="submit" value="Add">
				<input type="submit" name="cancel" value="Cancel">
			</p>
		</form>
 	</p>
 </body>
 </html>