<!DOCTYPE html>
<html> 
<head>
	<!-- hiddenformhandler.php Created 7-27-2018 by Ray Ryon -->
	<!-- This page is an example of form handling with a hidden form field. -->
	<title>Hidden Form Handler</title>
</head>
<body>
	<p>MySQL Example hidden Form Field handler. </p> 
	<?php  
		echo "Name value: " . $_POST['Name']; 
		echo "<br />StartTime (hidden) value: " . $_POST[ 'StartTime' ]; 
	?> 
</body>
</html>