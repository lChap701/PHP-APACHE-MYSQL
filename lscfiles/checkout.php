<?php session_start();  
 	echo "Session started " . session_id(); 
?>  
<!DOCTYPE html>
<html> 
<head>
	<!-- Checkout.php Created 7-29-2018 by Ray Ryon -->
	<!-- This page is an example of handling data stored in a session. -->
	<title>Checkout Example</title>
</head>
<body>
<p>Checkout. </p> 
<hr /> 
 <?php 
 	echo "<p>You have ordered the following hats:</p>";  	
	echo "<table width='100%' border='1'>"; 
 	echo "<tr><th>Order Number</th><th>Color</th></tr>"; 
 	$Colors = $_SESSION["ColorOrdered"]; 
 	foreach($Colors as $num => $color )  
 	{ 
 	 	if ($num>0) 
 	 	{ 
 	 	 	echo "<tr><td>$num</td>"; 
 	 	 	echo "<td>$color</td></tr>"; 
 	 	} 
 	} 
?> 
</body> 
</html>