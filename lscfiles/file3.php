<!DOCTYPE html>
<html> 
<head>
	<!-- Created 6-29-2018 by your Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Files</title>
</head>
<body>
	<h1>File Processing</h1>
	<hr />
<p>This is an example of a php application that writes a file of contact information.  It uses hard coded values that are in the code.</p>
<?php 
	$ContactFile = "data\\contact.txt"; 
	$fp= fopen($ContactFile,"w");
	$Name = array("John Jolly", "Mary Marvel", "Doug Douglas", "Sarah Sentry", "Betty Butler");
	$Phone = array("123 123-56578", "222 222-2222","321 333-4321", "456 654-4322", "555 567-5432");

	for($i=0; $i<count($Name); ++$i){
		echo "Name: $Name[$i] <br>Phone: $Phone[$i] <br><br>";
		fwrite($fp, $Name[$i]."\n");
		fwrite($fp, $Phone[$i]."\n");
	}
	fclose($fp);
?> 

</body>
</html>