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
<p>This is an example of a php application that reads a file that contains a hit counter. It then adds to the counter and writes it back to the file. </p>
<?php 
	$CounterFile = "data\\hitcount.txt"; 
	$Hits = 0; 

	if (file_exists($CounterFile)) { 
		 $Hits = file_get_contents($CounterFile); 
		 ++$Hits; 
	} 
	else 
		$Hits = 1; 
	echo "<h3>There have been $Hits hits to this page.</h3>\n"; 
	if (file_put_contents($CounterFile, $Hits))      
		echo "<p>The counter file has been updated.</p>\n"; 
?> 

</body>
</html>