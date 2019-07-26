<?php 
	$guess = '';
	$msg = false;
	if (isset($_POST['guess'])) {
		$guess = $_POST['guess'] + 0;
		if ($guess == 50) {
			$msg = 'Great job!';
		}
		else if ($guess < 50) {
			$msg = 'Too low';
		}
		else {
			$msg = 'Too high';
		}
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Guessing game</title>
 </head>
 <body>
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