<!DOCTYPE html>
<html> 
<head>
	<!-- Created 7-6-2018 by  Ray Ryon  -->
	<!-- This page is an example php application to show associative array processing. -->
	<title>Arrays version 3</title>
</head>
<body>
	<h1>Using Associative Arrays</h1>
	<hr />
	<h3>Creating associative array .</h3>
	
	<?php //Creating associative array 

	$StateCapitals = array( 
		 "Connecticut" => "Hartford", 
		 "Maine" => "Augusta", 
		 "Massachusetts" => "Boston", 
		 "New Hampshire" => "Concord", 
		 "Rhode Island" => "Providence", 
		 "Vermont" => "Montpelier" 
	); 
	$StateCapitals["Iowa"] = "Des Moines"; 
      
		
	echo "List of all the members of the associative array.";
		 var_dump($StateCapitals);
	echo "<h3>Example to display one member of associative array.</h3>";		 
	$State = 'Vermont';
	echo "<p> The capital of $State is " . $StateCapitals[$State] . ".</p>\n"; 	 
	echo "<h3>Example to display all members of associative array.</h3>";
	foreach ($StateCapitals as $State => $Capital) 
           echo "The capital of $State is $Capital. <br />\n"; 

	
	?>
</body>
</html>