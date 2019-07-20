<!DOCTYPE html>
<head>
    <title>Suckway MD5 Cracker</title>
</head>
<body>
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash
    of a 4-digit lower case string and
    attempts to hash all 4-digit combinations
    to determine the original two characters.</p>
<pre>
Debug Output:
<?php
$goodtext = "Not found";
// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) {
    $time_pre = microtime(true);
    $md5 = $_GET['md5'];
    $show = 15;
    for($i=0; $i <= 9999; $i++ ) {
        if (strlen($i) != 4) {
            $to_check = str_repeat('0', 4 - strlen($i)).$i;
        }
        else {
            $to_check = $i;
        }
        $check = hash('md5', $to_check);
            if ( $check == $md5 ) {
                $goodtext = $to_check;
                break;
            }
            if ( $show > 0 ) {
                print "$check $to_check\n";
                $show = $show - 1;
            }
    }
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";
}
?>
</pre>
<p>Original Text: <?= htmlentities($goodtext); ?></p>
<form>
    <input type="text" name="md5" size="40" />
    <input type="submit" value="Crack MD5"/>
</form>
</body>
