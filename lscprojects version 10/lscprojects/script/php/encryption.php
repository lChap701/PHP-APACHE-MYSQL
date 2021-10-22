<!--
	This file was used to get a list encrypted values for the credit card number and it's CVV
	For more information, visit: https://www.php.net/manual/en/function.password-hash.php
-->
<html>
<head>
	<title>Encryption</title>
</head>	
<body>
	<h1>The password_hash() function</h1>
	<p>The password_hash() function randomly generates new encrypted values each time page loads, but matches can still be found with previous values.<br><br>Visit the <a href='verify.php'>verify.php</a> page for more information about finding matches</p>
	<h3>Credit Card Numbers</h3>
	<?php
		$arrCcnum = array("3556-77889-55748",	// the credit card number array (contains all the credit card numbers used in orders.txt)
						  "355615-77889-55748", 
						  "355615-77809-55748", 
						  "35561-87869-77339",
						  "77339-12961-8892",
						  "13543-90231-1224",
						  "13443-91231-1224",
						  "16445-91232-1324",
						  "18543-91232-1325",
						  "12563-91252-1325",
						  "18566-91253-1525"	
						);
		// Prints out all the encrypted versions of the values in the array
		foreach ($arrCcnum as $ccnum) {
			$encCcnum = password_hash($ccnum, PASSWORD_DEFAULT);
			echo "<p>Unencrypted value: $ccnum <br>Encrypted value: $encCcnum</p>\n";
		}
	?>
	<h3>CVV</h3>
	<?php
		$arrCvv = array (274, 1005, 392,		// the CVV array (contains all the CVV used in orders.txt)
						 2009, 519, 891, 
						 229, 5611, 8926, 
						 9011, 902
						);

		// Prints out all the encrypted versions of the values in the array
		foreach ($arrCvv as $cvv) {
			$encCvv = password_hash($cvv, PASSWORD_DEFAULT);
			echo "<p>Unencrypted value: $cvv <br>Encrypted value: $encCvv</p>\n";
		}
	?>
</body>
</html>