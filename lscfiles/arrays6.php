<!DOCTYPE html>
<html> 
<head>
	<!-- Created 7-13-2018 by  Ray Ryon  -->
	<!-- This page is an example php application to show 2 dimensional associative array processing. -->
	<title>Arrays version 6</title>
</head>
<body>
	<h1>Using 2 dimensional Associative Arrays</h1>
	<hr />
	<h3>Creating 2 dimensional associative array .</h3>
	<?php //Creating two dimension associative array 
$Distances = array( 
     "Albia" => array( 
     "Albia" => 0, 
     "Bloomfield" => 28.26, 
     "Centerville" => 21.04, 
     "Oskaloosa" => 19.95, 
     "Ottumwa"  => 21.03 
   ), 
     "Bloomfield" => array( 
     "Albia" => 28.26, 
     "Bloomfield" => 0, 
     "Centerville" => 19.54, 
     "Oskaloosa" => 39.26, 
     "Ottumwa"  => 18.26
   ), 
     "Centerville" => array( 
     "Albia" => 21.04, 
     "Bloomfield" => 19.54, 
     "Centerville" => 0, 
     "Oskaloosa" => 40.59, 
     "Ottumwa"  => 31.38
   ), 
     "Oskaloosa" => array( 
     "Albia" => 19.95, 
     "Bloomfield" => 39.26, 
     "Centerville" => 40.59, 
     "Oskaloosa" => 0, 
     "Ottumwa"  => 22.81
   ), 
     "Ottumwa"  => array( 
     "Albia" => 21.03, 
     "Bloomfield" => 18.26, 
     "Centerville" => 31.38, 
     "Oskaloosa" => 22.81, 
     "Ottumwa"  => 0 
   ) ); 
	echo "List of all the members of the associative array.";
		 var_dump($Distances);
	echo "<h3>Example to display one member of associative array.</h3>";		 
	$StartCity = "Centerville";
	$EndCity = 'Albia';
	$Distance = $Distances[$StartCity][$EndCity];
	echo "<p>The distance from $StartCity to $EndCity is ". $Distance    . " kilometers.</p>\n"; 
	 
	echo "<h3>Example to display all members of associative array.</h3>";
	foreach ($Distances as $StartCity => $CityArray){
		echo "The distance from $StartCity ";
		echo "<ul>";
		foreach ($CityArray as $EndCity => $Distance) 
			if ($Distance != 0){ 
				echo "<li>to $EndCity is " . $Distance           . " kilometers.</li>";
		}
	echo "</ul>";
		
	}
	?>
</body>
</html>