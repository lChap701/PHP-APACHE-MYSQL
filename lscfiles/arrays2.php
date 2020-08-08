<!DOCTYPE html>
<html>
<head>
<!-- Created 7-6-2018 by Ray Ryon -->
<!-- This page is an example php application to show advanced array processing. -->
<title>Arrays version 2</title>
</head>
<body>
<h1>Using Arrays</h1>
<hr />
<h3>Loading array from a file.</h3>
<p>A text file can be loaded directly into an array.</p>
<?php
//Creating array using the file function which returns an array from the file records.
if((file_exists("data/colors.txt")) && (filesize("data/colors.txt")!= 0 ))
 $ColorArray = file("data/colors.txt");
else
$ColorArray = array("blue", "green", "pink", "purple", "red", "yellow");
echo "Colors array is created.<br />";
// Display count of members after array is loaded.
echo "Number of members: ", count($ColorArray),"<br />";
// echo "List of all the members of the color array using var_dump function:";
 var_dump($ColorArray);
 // Following lines use various array functions that will make changes to the array.
echo "Insert new row into the array.<br />";
array_splice($ColorArray, 2, 0, array("New Color","vanilla"));
array_splice($ColorArray, 2, 0, "Noir");
// Remove any duplicates. Uses call by value
$ColorArray = array_values($ColorArray);
// Sort and shuffle the colors any duplicates. Uses call by reference
echo "Sort the array.<br />";
sort($ColorArray);
var_dump($ColorArray);
echo "Shuffle the array.<br />";
shuffle($ColorArray);
var_dump($ColorArray);
// Following lines write the array to a file.
$ColorStrings = implode($ColorArray);
 $ColorFile = fopen("data/color2.txt","wb");
if ($ColorFile === false )
echo "There was an error updating the color file.<br />";
else
{
fwrite($ColorFile, $ColorStrings);
fclose($ColorFile);
echo "Color file2 was created.<br />";
 }
// Example of loop to process array.
echo "Loop processing of array.<br />";
echo "<table border=\"1\" width=\"100%\" style=\"background-color:lightgray\">\n";
foreach ($ColorArray as $Color)
 {
echo "<tr>\n";
echo "<td>" . htmlentities($Color)."</td>";
echo "</tr>\n";
 }
 echo "</table>\n";
?>
</body>
</html>