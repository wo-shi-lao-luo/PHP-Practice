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

		$erank = 1;
		for($i=1; $i<=9; $i++) {
			if ( ! isset($_POST['eyear'.$i]) ) continue;
			if ( ! isset($_POST['edesc'.$i]) ) continue;

			$year = $_POST['eyear'.$i];
			if ( ! is_numeric($year) ) {
				$_SESSION['error'] = "Year must be numeric";
				header("Location:add.php");
				return false;
		    }
			$inst = $_POST['edesc'.$i];
			$sql = $pdo->prepare('SELECT institution_id FROM institution WHERE name = :name;');
			$sql->execute(array(':name' => $inst));
			$iid = $sql->fetch(PDO::FETCH_ASSOC);
			if ($iid === false) {
				$stmt = $pdo->prepare('INSERT INTO institution (name) VALUES (:name)');
				$stmt->execute(array(':name' => $inst));
				$iid = $pdo->lastInsertId();
			}
			$iid = $iid['institution_id'];
			$stmt = $pdo->prepare('INSERT INTO Education (profile_id, rank, year, institution_id) VALUES ( :pid, :rank, :year, :iid)');

			$stmt->execute(array(
				':pid'  => $profile_id,
				':rank' => $erank,
				':year' => $year,
				':iid' => $iid)
			);
			$erank++;
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
 	<?php require_once('head.php'); ?>
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
			<div id='edu'>
				Education: <button onclick="addEdu(); return false;">+</button><br>
			</div>
			<div id='pos'>
				Position: <button onclick="addPos(); return false;">+</button><br>
			</div>
				<input type="submit" value="Add">
				<input type="submit" name="cancel" value="Cancel">
			</p>
		</form>
 	</p>

 	<script type="text/javascript">
 		function auto(){
 			$.getJSON("school.php", function (data) {
				$( ".school" ).autocomplete({
					source: data
				});
			})
 		}

 		auto();

 		poss = [9,8,7,6,5,4,3,2,1];
 		count = 1;
 		function addPos() {
 			if (count > 9) {
 				alert('Maximum of nine position entries exceeded');
 				return false;
 			}
 			pos = poss.pop();
 			$('#pos').append('<p id=\'pos'+pos+'\'>Year: <input type="text" name="year'+pos+'">'+' '+'<input type="button" value="-" onclick="$(\'#pos'+pos+'\').remove(); count--; poss.push('+pos+'); return false;"><br><br><textarea name="desc'+pos+'" rows="8" cols="80"></textarea></p>');
 			count++;
 			pos++;
 			auto();
 		}

 		epos = [9,8,7,6,5,4,3,2,1];
 		ecount = 1;
 		function addEdu() {
 			if (ecount > 9) {
 				alert('Maximum of nine education entries exceeded');
 				return false;
 			}
 			pos = epos.pop();
 			$('#edu').append('<p id=\'epos'+pos+'\'>Year: <input type="text" name="eyear'+pos+'">'+' '+'<input type="button" value="-" onclick="$(\'#epos'+pos+'\').remove(); count--; epos.push('+pos+'); return false;"><br>Institution: <input type="text" class="school" name="edesc'+pos+'""></p>');
 			count++;
 			pos++;
 			auto();
 		}

 	</script>
 </body>
 </html>