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
<h1>
	Now casting
</h1>
<?php 
echo "a".True."B"."<br>";
// a1B
echo "a".False."B";
// aB
 ?>

<h1>
	Try strpos
</h1>
<?php 
$string = "Hello PHP";
$pos = strpos($string, "PHP");
echo "$pos"."<br>";
$pos1 = strpos($string, "hahahahha");
echo "$pos1"."empty<br><br>";
print "$pos1"."empty2<br><br>";
if ($pos == 0) {
	print "ok";
	echo "ok";
} else {
	print "not ok";
	// echo "not ok";'
}
 ?>
<h1>
    Try array
</h1>
<?php
$stuff = array("haha" => "dandan", "xiaogao" => "laoluo");
echo ("<pre><br>");

echo ("print<br>");
print $stuff;
echo ("<br><br>");

echo ("print_r<br>");
print_r($stuff);
echo ("<br><br>");

echo ("var_dump<br>");
var_dump($stuff);
echo ("<br>");

echo ("for loop<br>");
foreach($stuff as $a => $b) {
    echo ("Key = ".$a."<br>"."Value = ".$b."<br>");
}
echo ("<br><br>");

echo ("</pre><br>")
?>