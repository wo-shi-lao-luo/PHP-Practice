<?php 
if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

if ( !isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

$plays = False;
$result = False;

if (isset($_POST['selection'])) {
	if ($_POST['selection'] == 'random') $h = random_int(0, 2);
	else $h = $_POST['selection'];
	
	$c = random_int(0, 2);
	$play = array('Rock', 'Paper', 'Scissors');
}

function check($h, $c) {
	if ($h == $c) return "Tie";
	else {
		if ($h == 0) {
			if ($c == 1) {
					return "You lost";
			}
			else return "You win";
		}
		elseif ($h == 1) {
			if ($c == 2) {
					return "You lost";
			}
			else return "You win";
		}
		else {
			if ($c == 0) {
					return "You lost";
			}
			else return "You win";
		}
	}
}

$result = check($h, $c);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>
 		Rock Paper Scissors ba01738f
 	</title>
 </head>
 <body>
 	<h1>Start Your Game!</h1>
 	<p>
 		Welcome: <?= htmlentities($_GET['name']) ?>
 	</p>
 	<form method="post">
 		<select name='selection'>
 			<option value='random'>Random</option>
 			<option value='0'>Rock</option>
 			<option value='1'>Paper</option>
 			<option value='2'>Scissors</option>
 			<option value="3">Test</option>
 		</select>
 		<input type="submit" name="submit" value="Play">
 		<input type="submit" name="cancel" value="Logout">
 	</form>
<br><br>
 	<?php 
	if ( $_POST['selection'] == 3 ) {
	    for($c=0;$c<3;$c++) {
	        for($h=0;$h<3;$h++) {
	            $result = check($c, $h);
	            print htmlentities($_GET['name'])." plays ".$play[$h]."<br>computer plays ".$play[$c]."<br><b>".$result."</b><br>";
	        }
	    }
	}
	else print htmlentities($_GET['name'])." plays ".$play[$h]."<br>computer plays ".$play[$c]."<br><b>".$result."</b><br>";
 	 ?>
 </body>
 </html>