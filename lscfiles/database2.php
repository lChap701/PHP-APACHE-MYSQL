<!DOCTYPE html>
<html> 
<head>
	<!-- database2.php Created 7-22-2018 by Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Database</title>
</head>
<body>
	<h1>Database Processing</h1>
	<hr />
<p>This is an example of creating and loading a database table.</p>
<?php 
	require_once('databaseconnect_inc.php');
	$TABLENAME="ANIMALS";
 //Drop a table if it already exists.
	$QueryResult = $DBConnect->query("DROP TABLE IF EXISTS $TABLENAME");
	If ($QueryResult)
		echo "<br />$TABLENAME table Dropped.";
 //Create a table.
	$CreateTableStatement = 
		"CREATE TABLE $TABLENAME (ID INT PRIMARY KEY,
			NAME VARCHAR(25), WEIGHT INT)";
	$QueryResult = @$DBConnect->query($CreateTableStatement); 
	If ($QueryResult)
		echo "<br />$TABLENAME table Created.";
	else
		echo "<br />CREATE TABLE did not work. Error number is " . $DBConnect->errno . 	" " . $DBConnect->error . ".";
// Insert a row into the table.
	$InsertTableStatement = "INSERT INTO $TABLENAME VALUES (0,'Giraffe',450)";
	$QueryResult = $DBConnect->query($InsertTableStatement);
	If ($QueryResult)
		echo "<br />$TABLENAME table contains 1 row.";
	else
		echo "<br />Insert did not work. Error number is " . $DBConnect->errno . 	" " . $DBConnect->error . ".";
?> 
<?php
	// When done with the connection, you should close it with the close function as following:  
	$DBConnect->close(); 
?> 
</body>
</html>