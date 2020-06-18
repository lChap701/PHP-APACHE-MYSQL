<?php
	/* Created by Lucas Chapman 6/16/2020 */
	/* This PHP file demonstrates regex in PHP */
	// The array of passwords
	$passwords = array("aM1_!k1815Rl", "LK16@a\$bzr39", "?qLp163c[H-E\'aN5", "0aNm73;B,\"j*k", "kQbUz1~7%<>a", "password", "aBcD1234cv56", "password 123", "MYPASSWORDISSTRONG", "012345678910");
			
	// Checks if each password in the array is valid
	foreach ($passwords as $pwd) {	// $pwd represents each password in $passwords
		$result = checkPassword($pwd);
		
		if ($result[0] == true) {	// if a password is valid
			echo "<script>alert('$result[1]');</script>";
		} else {	// if a password is invalid
			echo "$result[1]";
		}
	}
	
	/* 
	 * Checks if a password is valid or invalid and calls errors() when invalid passwords are found and messages() for valid passwords 
	 */
	function checkPassword(String $pwd) {	// $pwd represents each password sent to this function
		$length = preg_match("/.{12,}/", $pwd);	// represents the condition for checking if each password is 12 or more characters long
		$whitespace = preg_match("/\s+/", $pwd);	// represents the conditon for checking if each password contains any whitespace characters (spaces, tabs, etc.)
		$letters = preg_match("/[A-Z]+/", $pwd) && preg_match("/[a-z]+/", $pwd);	// represents the combined condition for checking if each password contains 1 or more uppercase and lowercase letters
		$digits = preg_match("/\d+/", $pwd);	//represents the condition for checking if each password contains any digits (numbers)
		$nonWordChars = preg_match("/\W+/", $pwd);	// represents the condition for checking if each password contains any non-word characters (non-alphanumeric characters) such as ?
		$isValid = false;	// represents if a password is valid
		
		if ($length) {
			if ($whitespace) {
				$msg = "<script>alert('$pwd is invalid, it should not contain white space characters such as spaces');</script>";
			} elseif ($letters) {
				if ($digits) {
					if ($nonWordChars) {
						$isValid = true;
						$msg = "$pwd is valid!";
					} else {
						$msg = "<script>alert('$pwd is invalid, it should contain at least one letter (uppercase and lowercase), one digit, and one non-alphanumeric character (any character that is not a letter, digit, or underscore (_))');</script>";
					}
				} else {
					$msg = "<script>alert('$pwd is invalid, it should contain at least one letter (uppercase and lowercase), one digit, and one non-alphanumeric character (any character that is not a letter, digit, or underscore (_))');</script>";
				}
			} else {
				$msg = "<script>alert('$pwd is invalid, it should contain at least one letter (uppercase and lowercase), one digit, and one non-alphanumeric character (any character that is not a letter, digit, or underscore (_))');</script>";
			}	
		} else {
			$msg = "<script>alert('$pwd is invalid, it needs to be at least 12 characters long');</script>";
		}
		$results = array($isValid, $msg);	// stores the results in an array
		return $results;
	}
?>