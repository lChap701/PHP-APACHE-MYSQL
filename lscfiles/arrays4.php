<!DOCTYPE html>
<html> 
<head>
	<!-- Created 8-21-2018 by  Ray Ryon  -->
	<!-- This page is an example php application to show loading an associative array from a text file. -->
	<title>Arrays version 4</title>
</head>
<body>
	<h1>Using Associative Arrays</h1>
	<hr />
	<h3>Creating associative array from a file.</h3>

	
	<?php 
		
	//Creating associative array from a file. 
	// The file states.txt is a comma delimited text file of the following form.
/*
Connecticut,Hartford
Maine,Augusta
Massachusetts,Boston
New Hampshire,Concord
Rhode Island,Providence
Vermont,Montpelier
*/

	if((file_exists("data/states.txt")) && (filesize("data/states.txt")!= 0 )){ 
		$StateCapitals = array();
        $TempFileArray = file("data/states.txt"); // Bring all records into temp array.
		foreach ($TempFileArray as $line)
		{
			list($key, $value) = explode(',', $line, 2);
			if ($value !== NULL)
				$StateCapitals[$key] = trim($value);
		}
	}
	else
		$StateCapitals = array( 
			 "Connecticut" => "Hartford", 
			 "Maine" => "Augusta", 
			 "Massachusetts" => "Boston", 
			 "New Hampshire" => "Concord", 
			 "Rhode Island" => "Providence", 
			 "Vermont" => "Montpelier" 
		);

 // Add one more member to the array.
	$StateCapitals["Iowa"] = "Des Moines"; 
	echo "List of all the members of the associative array.";
		 var_dump($StateCapitals);
	echo "<h3>Example to display one member of associative array.</h3>";		 
	$State = 'Vermont';
	echo "<p> The capital of $State is " . $StateCapitals[$State] . ".</p>\n"; 	
	echo "<h3>Example to display all members of associative array.</h3>";
	foreach ($StateCapitals as $State => $Capital) 
           echo "The capital of $State is $Capital. <br />\n"; 
	echo "<br />The capitals are: ";
	foreach ($StateCapitals as $Capital ) 
           echo "$Capital, "; 
	echo "<br />The states are: ";
	foreach (array_keys($StateCapitals) as $State ) 
           echo "$State, "; 
	?>
</body>
</html>