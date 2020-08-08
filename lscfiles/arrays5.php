<!DOCTYPE html>
<html> 
<head>
	<!-- Created 7-13-2018 by  Ray Ryon  -->
	<!-- This page is an example php application to show 2 dimensional  array processing. -->
	<title>Arrays version 5</title>
</head>
<body>
	<h1>Using 2 dimensional  Arrays</h1>
	<hr />
	<h3>Creating 2 dimensional  array .</h3>
	<?php //Creating two dimension  array 
$TicTacToe = array( 
      array( " ", "1", "2", "3"),
      array( "1", " ", "X", "O"),
      array( "2", "X", "O", " "),
      array( "3", "X", " ", "O")
     ); 
	echo "List of all the members of the  array.";
		 var_dump($TicTacToe);
	echo "<h3>Example to display one member of the array.</h3>";		 
	$row = 1;
	$column = 2;
	$value = $TicTacToe[$row][$column];
	echo "<p>The value at row $row and column $column is ". $value    . ".</p>\n"; 
	echo "<h3>Example to display all members of  array.</h3>";
	echo"<table border='1' cellspacing='0' cellpadding='5'>";
	foreach ($TicTacToe as $rowArray){
		echo "<tr>";
		foreach ($rowArray as  $value){ 
				echo "<td>$value</td>";
		}
		echo "</tr>";	
	}
	echo "</table>";
	?>
</body>
</html>