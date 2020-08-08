<?php session_start();  
 	echo "Session started " . session_id(); 
?>  
<!DOCTYPE html>
<html> 
<head>
	<!-- sessionexample.php Created 7-29-2018 by Ray Ryon -->
	<!-- This page is an example of handling data stored in a session. -->
	<title>Session Example</title>
</head>
<body>
<p>Session Example. </p> 
<hr /> 
<?php  
if (isset($_SESSION["QuantityOrdered"])) 
 	{  
 	 	if (isset($_POST['color'])) 
 	 	{  
 	 	 	$_SESSION["QuantityOrdered"]++; 
 	 	 	echo "Order number ".$_SESSION["QuantityOrdered"]  	 	 	 	. " has color ".$_POST['color'].".";  	 
			if ($_SESSION["QuantityOrdered"]>1) 
 	 	 	 	$ColorsOrdered = $_SESSION["ColorOrdered"]; 
 	 	 	else 
 	 	 	 	$ColorsOrdered = array(""); 
 	 	 	$ColorsOrdered[] = $_POST['color']; 
 	 	 	$_SESSION["ColorOrdered"]= $ColorsOrdered; 
 	 	} 
 	 	else 
 	 	 	echo "<br />To order you must select a color!"; 
 	 	echo "<br /><br />Order another or<a href='checkout.php'> click here to check out!</a><br />"; 	} 
	else 
		$_SESSION["QuantityOrdered"]=0; 
	echo "<br />What color do you wish to purchase?<br />"; 	 
?> 
	<form method='POST' action='SessionExample.php'> 
 	 	<br /> Select a Color<br /> 
 	 	<select name='color' size=4 multiple> 
 	 	<option value='blue'>Blue</option> 
 	 	<option value='green'>Green</option> 
 	 	<option value='red'>Red</option> 
 	 	<option value='yellow'>Yellow</option> 
 	 	<option value='white'>White</option> 
 	</select>  
 	<br /><br /><input type='submit' name='Place Order' value='Place Order'>  
 	</form>  
</body> 
</html>