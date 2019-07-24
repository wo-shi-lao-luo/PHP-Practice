<?php 
if (!isset($_COOKIE['test'])) {
	setcookie('test','test', time()+10);
	echo "cookie is set";
}
 ?>

 <pre>
 	<?php print_r($_COOKIE) ?>
 </pre>

 <p><a href="cookie.php">cookie</a></p>