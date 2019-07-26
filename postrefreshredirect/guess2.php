<?php 
	session_start();
	if (isset($_POST['guess'])) {
		$guess = $_POST['guess'] + 0;
		$_SESSION['guess'] = $guess;
		if ($guess == 50) {
			$_SESSION['msg'] = 'Great job!';
		}
		else if ($guess < 50) {
			$_SESSION['msg'] = 'Too low';
		}
		else {
			$_SESSION['msg'] = 'Too high';
		}
		header("Location: guess2.php");
		return;
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Guessing game</title>
 </head>
 <body>
 	<?php 
 		$guess = isset($_SESSION['guess']) ? $_SESSION['guess'] : '';
 		$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
 	 ?>
	<h1>Guessing game</h1>
  	<p>
	  	<form method="POST">
			<?php 
				if ($msg !== false) {
					echo ($msg);
				}
			?>
			<br>
				<label for='guess'>Input Guess</label>
				<input type="text" name="guess" id="guess" 
					<?= 'value="'.htmlentities($guess).'"'; ?>
				>
			<br>
				<input type="submit" name="submit">

	  	</form>
  	</p>
 </body>
 </html>