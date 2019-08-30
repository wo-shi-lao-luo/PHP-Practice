<?php 

	require_once('config.php');

	if ( isset($_SESSION['success']) ) {
		echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p><br>");
		unset($_SESSION['success']);
	}
	if ( isset($_SESSION['error']) ) {
		echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p><br>");
		unset($_SESSION['error']);
	}

	$sql = $pdo->query('SELECT profile_id, first_name, last_name, headline FROM Profile');
	echo('<table border="1">');
	while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	    echo "<tr><td>";
	    echo(htmlentities($row['first_name']).' '.$row['last_name']);
	    echo("</td><td>");
	    echo(htmlentities($row['headline']));
	    echo("</td><td>");
	    echo('<a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a> / ');
	    echo('<a href="delete.php?profile_id='.$row['profile_id'].'">Delete</a>');
	    echo("</td></tr>\n");
	}
	echo "</table><br>";

 ?>