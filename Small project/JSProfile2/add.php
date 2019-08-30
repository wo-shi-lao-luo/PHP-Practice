<?php 
	session_start();

	require_once('config.php');
	require_once('head.php');

	if (!isset($_SESSION['name']) || !isset($_SESSION['user_id'])) {
		die('Not logged in');
	}

	if (isset($_POST['cancel'])) {
		header("Location:index.php");
		return false;
	}

	if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
		// if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1 ) {
		// 	$_SESSION['error'] = "All fields are required";
		// 	header("Location:add.php");
		// 	return false;
		// }

		// var_dump($_POST);

		foreach ($_POST as $post) {
			if (strlen($post) < 1) {
				$_SESSION['error'] = "All fields are required";
				header("Location:add.php");
				return false;
			}
		}

		if (strrpos($_POST['email'], '@') == -1) {
			$_SESSION['error'] = "Email address must contain @";
			// header("Location:add.php");
			return false;
		}

		$stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');

		$stmt->execute(array(
			':uid'=> $_SESSION['user_id'],
			':fn' => $_POST['first_name'],
			':ln' => $_POST['last_name'],
			':em' => $_POST['email'],
			':he' => $_POST['headline'],
			':su' => $_POST['summary'])
		);

		$profile_id = $pdo->lastInsertId();

		$rank = 1;
		for($i=1; $i<=9; $i++) {
			if ( ! isset($_POST['year'.$i]) ) continue;
			if ( ! isset($_POST['desc'.$i]) ) continue;

			$year = $_POST['year'.$i];
			if ( ! is_numeric($year) ) {
				$_SESSION['error'] = "Year must be numeric";
				header("Location:add.php");
				return false;
		    }
			$desc = $_POST['desc'.$i];
			$stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES ( :pid, :rank, :year, :desc)');

			$stmt->execute(array(
				':pid'  => $profile_id,
				':rank' => $rank,
				':year' => $year,
				':desc' => $desc)
			);
			$rank++;
		}

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
 	<h1>Add New Profile</h1>
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
				<textarea name="summary" rows="8" cols="80"></textarea></p>
			<div id='pos'>
				Position: <button onclick="addPos(); return false;">+</button><br>
			</div>
				<input type="submit" value="Add">
				<input type="submit" name="cancel" value="Cancel">
			</p>
		</form>
 	</p>

 	<script type="text/javascript">
 		poss = [1,2,3,4,5,6,7,8,9];
 		count = 1;
 		function addPos() {
 			if (count > 9) {
 				alert('Maximum of nine position entries exceeded');
 				return false;
 			}
 			pos = poss.pop();
 			$('#pos').append('<p id=\'pos'+pos+'\'>Year: <input type="text" name="year'+pos+'"><br><input type="button" value="-" onclick="$(\'#pos'+pos+'\').remove(); count--; poss.push('+pos+'); return false;"><br><textarea name="desc'+pos+'" rows="8" cols="80"></textarea></p>');
 			count++;
 			pos++;
 		}
 	</script>
 </body>
 </html>