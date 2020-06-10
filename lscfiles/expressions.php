<!DOCTYPE html>
<html>
<head>
<!-- Created 99-99-9999 by your name -->
<!-- This page is an example php application. -->
<title>Expressions</title>
</head>
<body>
<h1>Using Expressions</h1>
<hr />
<h3>Increment operator example.</h3>
<p>Postfix ++ operator increments after other operations are done on a PHP statement. Prefix
++ operator increments before other operations are done on a PHP statement.
</p>
<?php //Postfix vs. Prefix increment operator.
$counter1 = 0;
echo "Value of \$counter1 before incrementing is $counter1 <br />";
echo "Postfix answer: ", $counter1++,"<br />";
$counter2 = 0;
echo "Prefix answer: ", ++$counter2,"<br />";
?>
</p>
<h3>Compound assignment example.</h3>
<p>Compound operator $x += $y is the same as $x = $x + $y
</p>
<?php //Compound Assignment statement.
$x = 20;
$y = 15;
echo "Initial value of \$y is $y and initial value of \$x is $x";
$x += $y;
echo "<br />";
echo "Ending value of \$y is $y and ending value of \$x is $x";
?>
</ul>
<h3>Examples of Comparison</h3>
<p> Two equal signs compares to see if the values are equal. Three equal signs
compares to see if values are equal and if the data types are equal.
</p>
<?php // Comparison of equality with == and ===
// the var_dump gives boolean answer in form of true or false.
$intFive = 5;
$strFive = "5";
echo "Compare Integer and String with two equal signs == gives:";
var_dump($intFive==$strFive);
echo "Compare Integer and String with three equal signs === gives: ";
var_dump($intFive===$strFive);
?>
<h3>Examples of using Conditional operator.</h3>
<?php // Conditional Operator.
$a = 5;
$b = 3;
echo $a > $b ? "a is larger that b" : "a is smaller that b";
$a = 2;
echo "<br />",$a > $b ? "a is larger that b" : "a is smaller that b";
?>
</body>
</html>