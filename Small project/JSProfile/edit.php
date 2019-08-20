<?php 
	session_start();

	require_once("config.php");

	$id = $_GET['profile_id'];
	$sql = $pdo->query("SELECT first_name, last_name, email, headline, summary FROM Profile WHERE profile_id = $id");
	$row = $sql->fetch(PDO::FETCH_ASSOC);

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
		$stmt = $pdo->prepare('UPDATE Profile SET first_name = :fn, last_name = :ln, email = :em, headline = :he, summary = :su WHERE profile_id = :id');

		$stmt->execute(array(
		  ':id'	=> $id,
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
 	<title>Edit 7914e340</title>
 </head>
 <body>
  	<h1>Edit Profile</h1>
 	<p>
 		<?php 
 			if (isset($_SESSION['error'])) {
 				echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
 				unset($_SESSION['error']);
 			}
 		 ?>
		<form method="post">
			<p>First Name:
				<input type="text" name="first_name" size="60" value= <?= '"'.$row['first_name'].'"' ?>/></p>
				<p>Last Name:
				<input type="text" name="last_name" size="60" value= <?= '"'.$row['last_name'].'"' ?>/></p>
				<p>Email:
				<input type="text" name="email" size="30" id="email" value= <?= '"'.$row['email'].'"' ?>/></p>
				<p>Headline:<br/>
				<input type="text" name="headline" size="80" value= <?= '"'.$row['headline'].'"' ?>/></p>
				<p>Summary:<br/>
				<textarea name="summary" rows="8" cols="80" ><?= $row['summary'] ?></textarea>
				<p>
				<input type="submit" value="Save" onclick="return validate()">
				<input type="submit" name="cancel" value="Cancel">
			</p>
		</form>
		<script type="text/javascript">
			function validate() {
				var email = document.getElementById('email').value;
				if (email.indexOf('@') == -1) {
					alert("Invalide Email Address");
					return false;
				}
			}
		</script>
 </body>
 </html>