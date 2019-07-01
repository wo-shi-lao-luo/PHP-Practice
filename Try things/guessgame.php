<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guessing Game for Kyle Luo</title>
</head>
<body>
<h1>
    Guessing Game for Kyle Luo
</h1>
<p>
    Hint, the answer is between 0 - 100
</p>
<?php
$c = 27;
if ($c === null) {
//    $c = rand(0,100);
}
if (isset($_GET['guess'])) {
    if ($_GET['guess'] == null) echo "Your guess is too short";
    elseif ($_GET['guess'] == 0 && $_GET['guess'] !== '0') echo "Your guess is not a number";
    elseif ($_GET['guess'] > $c) echo "Your guess is too high";
    elseif ($_GET['guess'] < $c) echo "Your guess is too low";
    elseif ($_GET['guess'] == $c) {
        echo "Congratulations - You are right";
//        $c = null;
    }
}
else {
    echo "Missing guess parameter";
}
?>
</body>
</html>

