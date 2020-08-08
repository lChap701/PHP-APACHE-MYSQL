<!DOCTYPE html>
<html> 
<head>
	<!-- database3.php Created 7-27-2018 by Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Database Query</title>
</head>
<body>
	<h1>Database Query Processing</h1>
	<hr />
<p>This is an example of displaying rows from a database table.</p>
<?php 
	require_once('databaseconnect_inc.php');

	$SELECTSTATEMENT = "SELECT * FROM mytrips where NumberDays > 5";
	$QueryResult = @$DBConnect->query($SELECTSTATEMENT); 
	echo "Number of rows selected was ". $QueryResult->num_rows;
	while (($Row = $QueryResult->fetch_assoc())!== NULL) 
	{ 
		// var_dump($Row);
		
		echo "<br />Trip Date: " . $Row['TripDate' ]; 
		echo "<br />Location: " . $Row['Location' ]; 
		echo "<br />Number of Days: " . $Row["NumberDays"]; 
		echo "<br />Comments: " . $Row["TripComments"]."<br />"; 

	} // end of loop
	// close the connection.
	$DBConnect->close(); 	
?> 
</body>
</html>