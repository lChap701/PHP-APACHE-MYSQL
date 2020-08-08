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
?> 