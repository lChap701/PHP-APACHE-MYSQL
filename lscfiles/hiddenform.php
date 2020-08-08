<!DOCTYPE html>
<html> 
<head>
	<!-- hiddenform.php Created 7-27-2018 by Ray Ryon -->
	<!-- This page is an example of form with hidden input. -->
	<title>Hidden Form Example</title>
</head>
<body>
	<p><b>Form For Input with hidden input</b></p>
	<form name="myform" action="hiddenformhandler.php" method="POST"> 
	Enter your name here! 
	<input type="text" name="Name" size="25" /> 
	<input type="hidden" name="StartTime"  value="<?php 
	date_default_timezone_set("America/Chicago"); echo date("g:i a");?>" /> 
	<br><input type="submit" name="enter" value="Submit Form"/> 
	</form>
</body>
</html>