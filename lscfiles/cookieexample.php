<?php
// Check if no cookie, and register button has been submitted.
// Then create a cookie from form input.
if (!isset($_COOKIE["user"]))  	
	if (isset($_POST["user"])) 
 	 	setcookie("user",$_POST['user'],time()+60*60*24*30); 
// Check if cookie exists and Signout button has been submitted.
// Then delete the cookie.
if (isset($_COOKIE["user"])) 
 	if (isset($_POST["Signout"])) 
 	 	setcookie("user","",time()-30); 
?> 
<!DOCTYPE html>
<html> 
<head>
	<!-- cookieexample.php Created 7-29-2018 by Ray Ryon -->
	<!-- This page is an example of handling data stored in a cookie. -->
	<title>Cookie Example</title>
</head>
<body>
<p>Cookie Example. </p> 
<hr /> 
<?php 
if (isset($_COOKIE["user"])){
	if (isset($_POST["Signout"])) 
	{
		echo "Good Bye. You are signed out."; 
		echo "<form method='POST' " .  " action='CookieExample.php'>\n"; 
		echo "<form method='POST' " .  " action='CookieExample.php'>\n"; 
		echo "<input type='submit' name='Continue' " .  " value='Continue'>\n"; 
 	 	echo "</form>\n"; 
	}
	else
	{
		echo "Hello ".$_COOKIE["user"]; 
 	 	echo "<form method='POST' " .  
 	 	 	 " action='CookieExample.php'>\n";  
		echo "<input type='submit' name='Signout' " .  
 	 	 	 " value='Sign out'>\n"; 
 	 	echo "</form>\n"; 
	}
}
else{
	if (isset($_POST["Register"]) && $_POST["user"]) {
		echo "Thank you ". $_POST["user"]. " for registering.";
		echo "<form method='POST' " .  
			 " action='CookieExample.php'>\n"; 
		echo "<form method='POST' " .  
			 " action='CookieExample.php'>\n"; 
		echo "<input type='submit' name='Continue' " .  " value='Continue'>\n"; 
		echo "</form>\n"; 
	}	
	else
	{
		echo "Welcome guest! What is your name?<br />"; 
		echo "<form method='POST' " .  
			 " action='CookieExample.php'>\n"; 
		echo "<input type='input' name='user' >\n"; 
		echo "<input type='submit' name='Register' " .  
			 " value='Register'>\n"; 
		echo "</form>\n"; 
	}
}
?> 		
</body>
</html>