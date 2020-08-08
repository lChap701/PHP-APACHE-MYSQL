<!DOCTYPE html>
<html> 
<head>
	<!-- QueryStringhandler.php Created 7-27-2018 by Ray Ryon -->
	<!-- This page is an example of handling data passed from query strings. -->
	<title>Query String Handler</title>
</head>
<body>
<p>MySQL Example Query String handler. </p> 
<?php  
	echo "FromPage value: " . $_GET['FromPage']; 
	echo "<br />Platform value: " . $_GET[ 'Platform' ]; 
?> 

</body>
</html>