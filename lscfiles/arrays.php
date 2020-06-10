<!DOCTYPE html>
<html>
<head>
<!-- Created 6-3-2020 by Lucas Chapman -->
<!-- This page is an example php application. -->
<title>Arrays</title>
</head>
<body>
<h1>Using Arrays</h1>
<hr />
<h3>Normal numeric indexed Array Example </h3>
<p>Normal arrays use numeric indexes starting at zero to identify each member of the array.
Arrays in PHP can contain different data types but normal arrays usually have all members of the same
data type. Indexes usually go in order by 1, but PHP does allow you to skip indexes. You will need to look
at the actual code to see how arrays work, but below is the output of the array examples.
</p>
<?php //Creating array using array function.
$Colors = array("blue", "green", "pink", "purple", "red", "yellow");
echo "Colors array is created.<br />";
echo "List of all the members of the color array:";
var_dump($Colors);
echo "Member at position 1 is: ", $Colors[1],"<br />";
echo "Number of members: ", count($Colors),"<br />";
echo "Changing color of 2 to fuchsia.<br />";
$Colors[2] = "fuchsia";
echo "Adding at the end color orange.<br />";
$Colors[] = "orange";
echo "Adding color 10 as cyan.<br />";
$Colors[10] = "cyan";
echo "New list of all the members of the color array after changes and additions:";
var_dump($Colors);
?>
</body>
</html>