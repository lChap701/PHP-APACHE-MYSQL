<!DOCTYPE html>
<html> 
<head>
	<!-- file4.php Created 7-21-2018 by your Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Database</title>
</head>
<body>
	<h1>Prodedural Database Processing</h1>
	<hr />
<p>This is an example of a php application that connects to a database.This example uses the procedural version of mysqli.</p>
<?php 
	// Connect to the database.
	$host = "localhost"; 
	$user= "root";
	$password = "";
	$database="mydatabase";
	$DBConnect = @mysqli_connect($host,$user,$password,$database);
	
	if (!$DBConnect)
		echo "The database server is not available. " . 
		"Connect Error is " . mysqli_connect_errno() . 
		" " . mysqli_connect_error(). "."; 
	else{
		echo "Connection made";
		echo "<br />MySQL server version: " .  mysqli_get_server_info($DBConnect); 
		echo "<br />MySQL client version: " .  mysqli_get_client_info() ; 

		// When done with the connection, you should close it with the close function as following:  
		mysqli_close($DBConnect); 
	}


?> 
</body>
</html>