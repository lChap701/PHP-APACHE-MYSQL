<!DOCTYPE html>
<html>
<head>
<!-- regex2.php Created 5/10/2018 by your Ray Ryon -->
<!-- This page is an example php application that uses Regular Expressions. -->
<!-- Symbols used in this example are:
/ is used as a delimiter. </li>
^ is used as the starting anchor.
$ is used as the ending anchor.
\d is used to indicate a digit.
{5} is used to indicate repetition of 5.
| is used to give another pattern.
[ ] is used to indicate in the pattern a choice of characters to match for a single value in
the phrase.
-->
<title>Regular Expressions</title>
</head>
<body>
<h1>Using Regular Expressions</h1>
<hr />
<h3>5 digit zipcode examples.</h3>
<p>Regular expression of "/^\d{5}$/"</p>
<?php //Zipcode example 1.
$zipcode = 1234;
$pattern = "/^\d{5}$/";
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = 52501;
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = 123456;
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = "1a345";
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = "12345 1234";
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
?>
<h3>5 or 9 digit zipcode examples.</h3>
<p>Regular expression of "/^\d{5}$|^\d{5} \d{4}$/"</p>
<?php //Zipcode example 2.
$pattern = "/^\d{5}$|^\d{5} \d{4}$/";
$zipcode = "12345 1234";
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = 52501;
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = 1234;
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = 123456;
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
$zipcode = "1a345";
if (preg_match($pattern, $zipcode)==1)
echo "Value of \$zipcode is $zipcode and it is valid.<br />";
else
echo "Value of \$zipcode is $zipcode and it is not valid.<br />";
?>
<h3>Checking for Vowel examples.</h3>
<p>Regular expression of "/[AEIOUaeiou]/"</p>
<?php //Vowel examples.
$phrase = "Hello World";
if (preg_match("/[AEIOUaeiou]/", $phrase)==1)
echo "Value of \$phrase is $phrase and it contains a vowel.<br />";
else
echo "Value of \$phrase is $phrase and it does not contains a vowel.<br />";
$phrase = "XYZ";
if (preg_match("/[AEIOUaeiou]/", $phrase)==1)
echo "Value of \$phrase is $phrase and it contains a vowel.<br />";
else
echo "Value of \$phrase is $phrase and it does not contains a vowel.<br />";
$phrase = 12345;
?>
</p>
</body>
</html>