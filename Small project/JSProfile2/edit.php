<?php 
	session_start();

	require_once("config.php");
	require_once("head.php");

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

		$sql = "DELETE FROM Profile WHERE profile_id = :zip; DELETE FROM position WHERE profile_id = :zip;";
	    $stmt = $pdo->prepare($sql);
	    $stmt->execute(array(':zip' => $_GET['profile_id']));
	    
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
		      	return "Position year must be numeric";
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

	    $_SESSION['success'] = "Profile edited";
	    header( 'Location: index.php' ) ;
	    return;
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
				<?php 
					$stmt = $pdo->prepare("SELECT rank, year, description FROM position WHERE profile_id = :xyz;");
					$stmt->execute(array(":xyz" => $_GET['profile_id']));
					echo "<div id='pos'>Position: <button onclick=\"addPos(); return false;\">+</button><br>";
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo('<p id=\'pos'.$row['rank'].'\'>Year: <input type="text" value="'.$row['year'].'"name="year'.$row['rank'].'"><br><input type="button" value="-" onclick="$(\'#pos'.$row['rank'].'\').remove(); count--; poss.push('.$row['rank'].'); return false;"><br><textarea name="desc'.$row['rank'].'" rows="8" cols="80">'.$row['description'].'</textarea></p>');
					}
					echo "</div>";
				 ?>
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
			poss = [1,2,3,4,5,6,7,8,9];
			count = 1;
			for (var i=1; i <=9; i++) {
				if ($('#pos'+i).length) {
					var j = poss.indexOf(i);
					poss.splice(j,1);
					count++;
				}
			}
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