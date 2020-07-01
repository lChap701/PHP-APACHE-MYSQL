<!-- Created by Lucas Chapman 6/23/2020 -->
<!-- This code is part of a separate PHP file that is used to display to the user that they have logged in and demonstrates the use of form handling and superglobal variables -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Login Form Handler Example</title>
		<link rel="stylesheet" href="CSS/login.css?<?php echo time(); ?>">
	</head>
	<body>
		<div id="container">
			<div id="content">
				<?php
					/* Gets the data that was submitted, checks if they are valid, and displays it back to the user */
					$errCtr = 0;	// used to keep track of errors 
					$username = $_POST['uname'];	// gets the username that was submitted
					$password = $_POST['psw'];	// gets the password that was submitted
					checkUsername();
					checkPassword();
					validAccount();
						
					/*
					 * Checks if the username is valid
					 */
					function checkUsername() {
						global $username, $errCtr;
						$lenTrimUname = trim(strlen($username), preg_match("/\s+/", $username));	// represents length (not including whitespace charars scteuch as spaces)
					
						/* Conditions for username */
						if (empty($username)) {	// checks if username was left null 
							echo "<script>alert('No username was entered');</script>\n";
							$errCtr++;
						} elseif ($lenTrimUname < 4) {	// checks if username is less than 4 characters
							echo "<script>alert('Invalid username, $username should be at least 4 characters long and all whitespace characters will be removed');</script>\n";
							$errCtr++;
						}
					}
					
					/*
					 * Checks if the password is valid
					 */
					function checkPassword() {
						global $password, $errCtr;
						$lenTrimPwd = trim(strlen($password), preg_match("/\s+/", $password));	// represents length (not including whitespace charars scteuch as spaces)
						$letters = preg_match("/[A-Z|a-z]+/", $password);	// represents letters (uppercase or lowercase)
						$digits = preg_match("/\d+/", $password);	// represents digits
						$symbols = preg_match("/[\W|_]+/", $password);	// represents symbols
						$empty = false;	// used to skip most conditions when password is null
						
						if (empty($password)) {	// checks if password was null when user tried to login
							echo "<script>alert('No password was entered');</script>\n";
							$errCtr++;
							$empty = true;
						} 
						
						/* Conditions for when the password is not empty */
						if (!$empty) {	// checks if password is empty or not
							if ($lenTrimPwd < 12) {	// checks the length (not including whitespace characters) is less than 12
								echo "<script>alert('Invalid password, $password should be at least 12 characters long and all whitespace characters being removed');</script>\n";
								$errCtr++;						
							}
							if (!$letters) {	// checks if password contains any letters or not
								echo "<script>alert('Invalid password, $password should contain at least one letter (uppercase or lowercase)');</script>\n";
								$errCtr++;
							}
							if (!$digits) {	// checks if password contains any digits or not
								echo "<script>alert('Invalid password, $password should contain at least one digit');</script>\n";
								$errCtr++;
							}			
							if (!$symbols) {	// checks if password contains any symbols or not
								echo "<script>alert('Invalid password, $password should contain at least one symbol');</script>\n";
								$errCtr++;
							}
						}
					}
					
					/*
					 * Displays a message back to the user based on if the account is valid or invalid
					 */
					function validAccount() {
						global $errCtr, $username, $password;
						
						/* Checks if account is valid by seeing if any errors were found */
						if ($errCtr == 0) {
							echo "<p>Welcome $username, you are offical logged in.</p>\n";
							echo "<p>Username: $username</p>\n";
							echo "<p>Password: $password</p>\n";
							echo "<script>document.getElementById('content').removeAttribute('class');</script>";	// removes transition CSS effect
						} else {
							echo "<a href='loginform.php' title='Login Form'>Click here to try again</a>\n";
							echo "<script>document.getElementById('content').setAttribute('class', 'expand');</script>";	// adds transition CSS effect
						}
					}
				?>
			</div>
		</div>
	<body>
</html>
