<!DOCTYPE html>
<html> 
<head>
	<!-- file4.php Created 7-21-2018 by your Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Database</title>
</head>
<body>
	<h1>OOP Database Processing</h1>
	<hr />
<p>This is an example of a php application that connects to a database. This example uses the OOP version of mysqli.</p>
<?php 
	// Connect to the database.
	$host = "localhost"; 
	$user= "root";
	$password = "";
	$database="mydatabase";
	$DBConnect = @new mysqli($host,$user,$password,$database); 
	if ($DBConnect->connect_error) 
		echo "The database server is not available. " . 
		"Connect Error is " . $DBConnect->connect_errno . 
		" " . $DBConnect->connect_error . "."; 
	else{
		echo "Connection made";
		echo "<br />MySQL server version: " .  $DBConnect->server_version; 
		echo "<br />MySQL client version: " .  $DBConnect->client_version; 


	}

	// When done with the connection, you should close it with the close function as following:  
	$DBConnect->close(); 
?> 
</body>
</html>