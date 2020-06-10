<!DOCTYPE html>
<html>
<head>
<!-- Created 99-99-9999 by your name -->
<!-- This page is an example php application. -->
<title>Variables</title>
</head>
<body>
<h1>Using variables</h1>
<hr />
<ol>
<li>In PHP variables are declared using initialization statements. </li>
<li>PHP does not specify a variable type on a variable declaration like other
languages.</li>
<li>PHP variable names begin with $. The next symbol after the $ should be a letter.
</li>
<li>The symbol after the $ can be an underscore, but PHP has several reserved words
that begin with the underscore so it is better to not use it for programmer defined variables.</li>
<li>The remaining symbols can contain letters, numbers and the underscore.</li>
</ol>
<?php //Declaring variables.
$counter = 5;
$balance = 29.75;
$zip_code = "52501";
$FirstName = "Bob";
$YourName = $FirstName;
?>
</p>
<h3>This is a list of values from variables in this example.</h3>
<ul>
<?php //Echo values from variables.
echo "<li>",'$counter',": $counter</li>";
echo "<li>", '$balance',": $balance</li>";
echo "<li>",'$zip_code',": $zip_code</li>";
echo "<li>",'$YourName',": $YourName</li>";
?>
</ul>
<h3>Example of String constant and variable on echo statement.</h3>
<?php
// Use comma to separate multiple values to print.
echo "Hello ",$YourName;
echo ", your balance is $", $balance;
?>
<h3>Examples of constant and variable inside double quotes.</h3>
<?php // Double quotes prints variable value.
echo "Hello $FirstName, ";
echo "your balance is $$balance";
?>
<h3>Examples of using single quotes.</h3>
<?php // Single quotes prints variable name not the value.
echo 'Hello $FirstName, ';
echo 'your balance is $$balance';
?>
<h3>Examples of using curly braces.</h3>
<?php // Needs curly braces for counter because 00 could be part of the variable name.
echo "Hello {$FirstName}, {$counter}00 times.";
?>
</body>
</html>