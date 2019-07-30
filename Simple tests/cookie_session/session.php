<?php 
session_start();
if (!isset($_SESSION['pizza'])) {
	echo "Session is empty <br>";
	$_SESSION['pizza'] = 0;
}
else if ($_SESSION['pizza'] < 3) {
	$_SESSION['pizza'] += 1;
	echo "Added one... <br>";
}
else {
	session_destroy();
	session_start();
	$_SESSION['pizza'] = 0;
	echo "Session Restarted<br>";
}
 ?>

 <p><a href="session.php">Session</a></p>
 <p>Our Session ID is: <?= session_id() ?></p>
 <pre>
 	<?php print_r($_SESSION) ?>
 </pre>