<!DOCTYPE html>
<html>
<head>
<!-- regex1.php Created 5-7-2018 by Ray Ryon -->
<!-- This page is an example of basic regular expressions. -->
<title>Basic Regular Expressions</title>
</head>
<body>
<h1>Basic Regular Expressions</h1>
<hr />
<?php
$phrase = 'Learn your "abc"s so that you can read and write. Learn to count 123...1000
so you can do arithmetic.';
echo '$phrase = '.$phrase.'<br>';
?>
<h4>Literal phrases</h4>
<?php //Literal example 1.
$pattern = "/abc/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Literal example 2.
$pattern = "/123/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Literal example 3.
$pattern = "/XYZ/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
<h4>Pattern using dot</h4>
<?php //Dot example.
$pattern = "/th.t/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
<h4>Patterns requiring escape character.</h4>
<?php //Escape example 1.
$pattern = "/ite\./";
if (preg_match("$pattern", $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Escape example 2.
$pattern = "/\"abc\"s/";
if (preg_match("$pattern", $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
<h4>Patterns using anchors</h4>
<?php //Anchor example 1.
$pattern = "/^Lea/";
if (preg_match("$pattern", $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Anchor example 2.
$pattern = "/tic\.$/";
if (preg_match("$pattern", $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Anchor example 3.
$pattern = "/^abc/";
if (preg_match("$pattern", $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
<h4>Patterns using special codes</h4>
<?php //Special code example 1.
$pattern = "/\d/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Special code example 2.
$pattern = "/\D/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Special code example 3.
$pattern = "/^\d/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Special code example 4.
$pattern = "/^\D/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
<h4>Patterns using repetition</h4>
<?php //Repetition example 1.
$pattern = "/0{3}/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Repetition example 2.
$pattern = "/(can){2}/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
//Repetition example 3.
$pattern = "/\d{3}/";
if (preg_match($pattern, $phrase)==1)
echo "Value of \$pattern is $pattern and it is a match.<br />";
else
echo "Value of \$pattern is $pattern and it is not a match.<br />";
?>
</p>
</body>
</html>