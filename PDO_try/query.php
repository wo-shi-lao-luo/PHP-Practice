<?php 
echo "<pre>";
require_once "config.php";
$stmt = $pdo->query("SELECT * FROM user");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	print_r($row);
}
echo "<pre/><br><br>";

$sql = $pdo->query("SELECT name, email, password FROM user");
echo "<table border='1'><br>";
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	echo ("<tr><td>");
	echo ($row['name']);
	echo ("<td><td>");
	echo ($row['email']);
	echo ("<td><td>");
	echo ($row['password']);
	echo ("<td><tr><br>");
}
 ?>