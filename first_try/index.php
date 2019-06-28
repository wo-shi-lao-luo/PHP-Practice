<h1>Hello, php</h1>
<p>
<?php 
echo "this is a test <br><br>";
$haha = 10 + 1;
echo "print a number '$haha'<br><br>";
$str = 'xixi';
echo "print a string '$str'<br><br> ";

$try = '44'.'33';
echo "print conc '$try'<br><br> ";

$haha++;
echo "print number again with ++ '$haha' <br><br>";
 ?>
</p>
<h1>
    Try tenary here
</h1>
<?php
$a = 123;
$msg = $a > 100 ? "Large" : "Small";
echo "$msg<br>";
$msg = $a == 0 ? "True" : "False";
echo "$msg<br>";
$msg = $a % 2 == 0 ? "Even" : "Odd";
echo "$msg<br>";
$msg = $a % 2 ? "Odd" : "Even";
echo "$msg this uses conversion<br><br>";

?>
<h1>
    This is Side-Effect
</h1>
<?php
$out = "Hello";
$out .= " PHP";
echo $out.'<br>';
?>
<p>done</p>