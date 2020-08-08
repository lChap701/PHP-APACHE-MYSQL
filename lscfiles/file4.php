<!DOCTYPE html>
<html> 
<head>
	<!-- file4.php Created 6-29-2018 by your Ray Ryon  -->
	<!-- This page is an example php application -->
	<title>Files</title>
</head>
<body>
	<h1>File Processing</h1>
	<hr />
<p>This is an example of a php application that reads a file of contact information.  It uses a loop until eof.</p>
<?php 
	$ContactFile = "data\\contact.txt"; 
	$fp= fopen($ContactFile,"r");
	$Name = trim(fgets($fp));
	while(!feof($fp)){
		echo "Name: $Name<br>";
		if ($Name == "Doug Douglas")
			echo "Found Doug";
		$Phone = trim(fgets($fp));
		echo "Phone: $Phone <br><br>";
		$Name = trim(fgets($fp));
	}
	fclose($fp);
?> 
</body>
</html>