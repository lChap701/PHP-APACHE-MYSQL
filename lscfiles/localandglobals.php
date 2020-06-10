<!DOCTYPE html>
<html>
<head>
<!-- Created 6-9-2020 by Lucas Chapman -->
<!-- This page demonstrates Local and Globals Variables -->
<title>Local and Globals Variables</title>
<?php
function myFunction($n)
{ //local definitions
$name4 = "Sally";
$name5 = "Ron";
$name6 = "Lana";
// The following statement gives access to global variable $name3
global $name3;
echo "Inside function.<br />";
// Following line is commented out since it generates an error since global variable $name1 is not accessible inside a function.
// echo "Name2 is $name2<br />";
echo "Display local variable inside a function:";echo " Welcome $name4<br />";
echo "Display parameter from inside a function:";echo " Welcome $n<br />";
echo "Display global variable inside a function:";echo " Welcome $name3<br />";
echo "Display global variable using global array from inside a function:";
echo " Welcome ", $GLOBALS['name4'],"<br />";
return $name5;
} // end of myFunction
?>
</head>
<body>
<h1>Local and Global Variables</h1>
<p>
In PHP local variables are defined inside of a function and can only be used inside of that
functions.<br />
Global variables are defined outside of all the functions and can only be used outside of any
functions unless they they are identified inside the function as a global variable.
</p>
<hr />
<?php
// Global variables
$name1 = "Jane";
$name2 = "Bob";
$name3 = "Sam";
$name4 = "Maria";
echo "Display global variable outside a function:"; echo "Hello $name2<br />";
echo "Ready to call function.<br />";
echo "<hr />";
// Function call and assign the returned value.
$r = myFunction($name1);
echo "<hr />";
echo "After function call.<br />";
echo "Value returned from function is $r";
// Following line is commented out since it generates an error since local variable $name6 is not accessible outside a function.
// echo "Display local variable outside a function:"; echo "Hello $name6<br />";
?>
</body>
</html>