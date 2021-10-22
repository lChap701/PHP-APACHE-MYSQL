<!-- 
	This file is used to demonstrate the password_verify() function and show that the encrypted data in orders.txt still matches 
	For more information, visit: https://www.php.net/manual/en/function.password-verify.php 
-->
<html>
<head>
	<title>Verification</title>
</head>	
<body>
	<h1>The password_verify() function</h1>
	<p>The password_verify() function checks if unencrypted data matches with encrypted data from the password_hash()<br>Visit the <a href='encryption.php'>encryption.php</a> page for more information about finding matches</p>
	<h3>Credit Card Numbers</h3>
	<?php
		$arrEncCcnum = array ("$2y$10\$tR/qzW/WKprqqbbBINprzedyfAHZMFitMj7t8defQBEac7s6oY2x6",	// copied and pasted values from the orders.txt file
							  "$2y$10\$vJ8O82l.bhONr1ZzkccoLeC3v9jrmzs1lS0DYIjEDl8wt3lh.exfi",	// '\' in front of a characters means it is an escape character
	                          "$2y$10\$NDDqq.Y/jS8OHe7Emzb75OgkUf2VytiNz9UhTTtLVfbBSTcr8atey",
	                          "$2y$10\$kQPfj71g/RANtM5/NDxq2.yNDP5/9QyNovJKIlmSEpjRJJPnNhXQi",
	                          "$2y$10\$Wq9qKxtyt2ZuGPuDeYPGpe1OHRujj3G8rJNTDG.Lh62OsQtYSZTKC",
	                          "$2y$10\$eA54hqPyhEZEzSYhHm2Tz.pHGCiLlDbefgHZOaU/rCOTUaLGMPVDq",
	                          "$2y$10\$ux3UN1Q.fxwDTlGtq/FeoOGPV0iC5Jfrn0QAOsLSsYIlajtNiKzza",
	                          "$2y$10$0L/cethUXCB3RJbMO8xOW.npx65UkbS5Sf8JmdMLk9hj93Lz1EiJq",
	                          "$2y$10\$cLKuLENV7VvTKC8Kwgu6FOcRGuhvUm8qQkueW00S5uow48YuVhiJ2",
	                          "$2y$10\$GHbA4ddOHqJ1haBSnEy6ROEIYUgJJmr64tvrirzFA/Et45Xb/xgMq",
	                          "$2y$10\$H1di2sSjtFXgwtANWRUxseFWbTbLzUysWxbakzVKLyH3wSvOA45AO"
							);
							
		$arrCcnum = array("3556-77889-55748",	// the credit card number array (contains all the credit card numbers I am using)
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
		
		// Checks if all the encrypted values used in orders.txt matches the values in the array
		foreach ($arrCcnum as $ccnum) {
			foreach ($arrEncCcnum as $encCcnum) {
				if (password_verify($ccnum, $encCcnum)) {
					echo "<p>$ccnum matches $encCcnum</p>\n";
				}
			}
		}
	?>
	
	<h3>CVV</h3>
	
	<?php
		$arrCvv = array (274, 1005, 392,		// the CVV array (contains all the CVV I am using)
						 2009, 519, 891, 
						 229, 5611, 8926, 
						 9011, 902
						);
		
		$arrEncCvv = array ("$2y$10\$weBjzechtR.BB1yXEwfbQu9o4S8kVma6l7CA0OSFCv0UF9Q7V5u.y",	// '\' in front of a characters means it is an escape character
							"$2y$10$1cXsGDYQyn0UdZhhfbMK1ewVLj9qeURCiu1nai3FOCscTjoAlpxKy",
							"$2y$10\$zeGYwXankjZOSmRZSACVMuDtBY7rcRmtdhCb2uK3lYqz.AloPYFR6",
							"$2y$10\$MeVIyqHpY6hdOSmP26/MNuWux0e8n.BufdvgewsQT6IhJiWbj.Hhq",
							"$2y$10\$K2wC7abpEKJ76nO8FeOejex8GLGIbHhY..M85VMR13df8qxvcMgDu",
							"$2y$10\$HN/GsAZkd7R6g3sJ61MW2ONlPo1Z3s/qhzPPkljM6R./qrH9Dbe2q",
							"$2y$10\$ydsdKeKfMG8dPOLieZ/wweiTFcXp5fcjtt9conOCvoosum/UITrVi",
							"$2y$10$6QiqFd6LuXFgklJdwAtu5uScTYs8IuUuxjaUAwhw8.E75Y5loX38G",
							"$2y$10\$s0R5qDmp7wNOgwrYXYC/m.C35kDv3m0JcV9MJpVIpysAzXRva3kNy",
							"$2y$10$3pEBwZgWYxuXv1UYLdmd5uA2mAopMs9.Dvu4T79fi4Y43mJAZ3Sd6",
							"$2y$10\$a1K4nZRFCfSTZOAGzP6JpOOUkU8fo2PYgPEozF0BNPQgAONlpZpyW"
							);
		
		// Checks if all the encrypted values used in orders.txt matches the values in the array
		foreach ($arrCvv as $cvv) {
			foreach ($arrEncCvv as $encCvv) {
				if (password_verify($cvv, $encCvv)) {
					echo "<p>$cvv matches $encCvv</p>\n";
				}
			}
		}
	?>