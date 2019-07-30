<?php 
if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$pw = '1a52e17fa899cf40fb04cfc42e6352f1';
$fail = False;

if ( isset($_POST['who']) && isset($_POST['pass'])) {
	if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "User name and password are required";
    } 
    else {
		if (hash("md5", $salt.$_POST['pass']) == $pw) {
			header("Location: game.php?name=".urlencode($_POST['who']));
			return;
		}
		else {
			$fail = "<b>Incorrect password</b>";
		}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Rock Paper Scissors ba01738f</title>
</head>
<body>
	<h1>Rock Paper Scissors Login</h1>
	<br>
	<?= $fail ?>
	<p>
		Choose any username as you want, no need to register :)
	</p>
	<form method="post">
		Name: <input type="text" name="who" ><br>
		Password: <input type="password" name="pass"><br><br>
		<input type="submit" name="submit" value="Log In">
		<input type="submit" name="cancel" value="Cancel">
	</form>
	<p>Hint: Password is in the source code of this page :)</p>
	<!-- password is: meow123 -->
</body>
</html>