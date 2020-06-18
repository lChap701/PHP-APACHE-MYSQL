<!DOCTYPE html>
<html>
<head>
<!-- stringsymbols.php Created 5/5/2018 by Ray Ryon -->
<!-- This page is an php application example using string symbols. -->
<title>String Symbols Expressions</title>
</head>
<body>
<h1>Using Expressions with String Symbols</h1>
<hr />
<h3>String Symbols</h3>
<p>The examples below use symbols that work with Strings. These symbols are:
<ul>
 <li>' or " are the quotes around string literals. </li>
 <li>\ is used to escape special symbols that conflict with PHP. </li>
 <li>{ } braces are used to surround a variable name used inside a string literal. </li>
 <li> dot . is used for concatenation. </li>
 <li> .= is used for concatenation assignment. </li>
</ul></p>
<p><?php //Either single or double quotes are used around strings.
echo "Example 1 uses single and double quotes for string literals and uses \ to escape
the quotes inside the literals.<br/>";
$name = 'Jane Doe';
echo $name . ", Hello World!<br />";
$phrase = "Hello World";
echo "$name's \"$phrase\" <br />"; // To show quotes inside the phrase you need to escape with \
echo '${name}\'s "$phrase" <br />'; // Notice that variables don't show values when using single quote even using braces. The variable name is shown.
//Example of combining parts of a string expression together
echo "<br>Example 2 uses three methods to combine parts of a file path together. 1) Use {} around variable name inside a string literal, 2) use concatenation and 3) use concatenation assignment .= <br/>";
$filename = "data";
$filenumber = 1;
$path = "/";
echo "The filename is $path{$filename}0$filenumber.dat<br />";
$fullname=$path.$filename."0".$filenumber.".dat";
echo "The filename is $fullname<br />";
$fullname=$path;
$fullname.=$filename;
$fullname.=0;
$fullname.=$filenumber;
$fullname.=".dat";
echo "The filename is $fullname<br />";
//Example of using strings for arithmetic.
echo "<br>Example 3 String expressions used for arithmetic.<br />";
$quantityofhats = "3";
echo "$quantityofhats hats + 2 equals ".($quantityofhats + 2)."<br />";
?></p>
</body>
</html>