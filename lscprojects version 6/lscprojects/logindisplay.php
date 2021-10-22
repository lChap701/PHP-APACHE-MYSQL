<!-- Created by Lucas Chapman 6/23/2020 -->
<!-- Updated 7/5/2020 By Lucas Chapman -->
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
					/* Gets the data that was submitted, checks if they are valid, stores it in files, and displays a message back to the user */
					$errCtr = 0;	// used to check if errors were found
					$isLogin = false;	// used to determine invalid logins and display error messages
					$uname = checkUsername($_POST['uname']);	// gets the username that was submitted and validates it
					$psw = checkPassword($_POST['psw']);	// gets the password that was submitted and validates it

					// Checks if the entered username and password contained any errors
					if ($errCtr == 0) {	// if no errors were found
						readRegFile();
					} else {
						echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
						echo "<a title='Go Back' href='loginform.php'>Go Back</a>";
					}

					/*
					 * Checks if the username is valid without worrying about matching with the data in password.txt
					 */
					function checkUsername(String $uname) {
						global $errCtr;
						$lenTrimUname = trim(strlen($uname), preg_match("/\s+/", $uname));	// represents length (not including whitespace charars scteuch as spaces)

						if (empty($uname)) {	// checks if username was left null 
							echo "<script>alert('No username was entered');</script>\n";
							$errCtr++;
						} elseif ($lenTrimUname < 4) {	// checks if username is less than 4 characters (not including whitespace characters)
							echo "<script>alert('Invalid username, $uname should be at least 4 characters long and all whitespace characters will be removed');</script>\n";
							$errCtr++;
						}

						return $uname;
					}

					/*
					 * Checks if the password is valid without worrying about matching with the data in password.txt
					 */
					function checkPassword(String $psw) {
						global $errCtr;
						$lenPsw = strlen($psw);	// represents the length
						$whitespace = preg_match("/\s+/", $psw);	// represents whitespace characters
						$letters = preg_match("/[A-Z]+/", $psw) && preg_match("/[a-z]+/", $psw);	// represents letters (uppercase and lowercase)
						$digits = preg_match("/\d+/", $psw);	// represents digits
						$nonWordChars = preg_match("/\W+/", trim($psw));	// represents non-alphanumeric characters

						if (empty($psw)) {	// checks if password was null when user tried to login
							echo "<script>alert('No password was entered');</script>\n";
							$errCtr++;
						} else {
							if ($whitespace) {	// checks if password contains any whitespace characters
								echo "<script>alert('Invalid password, $psw should not contain any whitespace characters (such as spaces)');</script>\n";
								$errCtr++;
							}
							if ($lenPsw < 12) {	// checks if the length is less than 12
								echo "<script>alert('Invalid password, $psw should be at least 12 characters long and with no whitespace characters');</script>\n";
								$errCtr++;
							}
							if (!$letters) {	// checks if password contains any uppercase and lowercase letters
								echo "<script>alert('Invalid password, $psw should contain at least one uppercase letter and one lowercase letter');</script>\n";
								$errCtr++;
							}
							if (!$digits) {	// checks if password contains any digits
								echo "<script>alert('Invalid password, $psw should contain at least one digit');</script>\n";
								$errCtr++;
							}
							if (!$nonWordChars) {	// checks if password contains any non-alphanumeric characters
								echo "<script>alert('Invalid password, $psw should contain at least one one non-alphanumeric character (any character that is not a letter, digit, or underscore (_))');</script>\n";
								$errCtr++;
							}
						}

						return $psw;
					}

					/* 
					 * Reads the password.txt file and calls the writeRegFile() function when the 'Create Login' button was pressed
					 */
					function readRegFile() {
						global $uname, $psw, $isLogin;
						$pswFile = "password.txt";	// name of the file
						$written = false;	// represents when a username is already taken by another user\written in the text file
						$fp = fopen($pswFile, "r+");	// 'r+' sets the mode for reading and writing, starts at the beginning of the file
						$check = false;	// determines if the readEncFile() function should be called for validation

						if (file_exists($pswFile)) {	// checks if the password text file is available
							// Prime Read
							$arrUnme[] = trim(fgets($fp));	// adds the first username to the array							
							$arrPsw[] = trim(fgets($fp));	// adds the first password to the array

							// EOF Loop
							while (!feof($fp)) {
								$arrUnme[] = trim(fgets($fp));	// adds each username in the file to the array
								$arrPsw[] = trim(fgets($fp));	// adds each password in the file to the array
							}

							// The length of the non-encrypted users array
							$usersCnt = count(explode("\n", file_get_contents($pswFile)));	// used for validation in the readEncFile() function
							
							// Checks if the 'Create Login' was pressed and takes the appropriate actions based on if the button was pressed
							if (isset($_POST['create'])) {	// checks if the 'Create Login' button was pressed
								for ($i = 0; $i < count($arrPsw); $i++) {	// uses count($arrPsw) but could also use count($arrUname) since they are the same length 
									if ($arrUnme[$i] == $uname) {	// if the $uname matches with any username in the file
										$written = true;
										writeRegFile($fp, $written);
										$i = count($arrUnme);	// sets $i to the length of the arrays to end the loop
									} elseif ($i == count($arrUnme) - 1) {	// if no match was found
										writeRegFile($fp, $written);
										addToEncFile();
									}
								}
							} else {
								// Loop for finding if the submitted username and password matches with anything in the file
								for ($i = 0; $i < count($arrUnme); $i++) {	// uses count($arrUname) but could also use count($arrPsw) since they are the same length 
									readEncFile($arrUnme[$i], $arrPsw[$i], $usersCnt, $check);	// called to encrypt data and write that data in the enc_password.txt

									if ($arrUnme[$i] == $uname && $arrPsw[$i] == $psw) {	// if the $uname and $psw match with any of the data in the file
										$check = true;
										readEncFile($arrUnme[$i], $arrPsw[$i], $usersCnt, $check);	// called to perform validation
										searchPasswordFile($arrUnme[$i], $arrPsw[$i]);	// uses arguments as part of the assignment
										$i = count($arrPsw);	// set to the length of the arrays to end to the loop
									} elseif ($i == count($arrUnme) - 1) {	// checks if no matches that were found
										$isLogin = false;
										$unme = $uname;	// used to pass the value in the global variable $uname to searchPasswordFile()
										$pwd = $psw;	// used to pass the value in the global variable $psw to searchPasswordFile() 
										searchPasswordFile($unme, $pwd);	// uses arguments as part of the assignment
									}
								}
							}
							fclose($fp);
						} else {
							echo "<script>alert('$pswFile was not found');</script>\n";
							echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
							echo "<a title='Go Back' href='loginform.php'>Go Back</a>\n";
						}
					}

					/*
					 * Writes in the regular text file if the form was submitted by pressing the 'Create Login' button or calls searchPasswordFile() for invalid data
					 * The parameter '$fp' represents the result of the fopen() function for the regular text file
					 */
					function writeRegFile($fp, bool $taken) {
						global $uname, $psw;

						// Checks if the $uname and $psw should be added to the file
						if (!$taken) {	// if username has not been taken
							fwrite($fp, "\n" . $uname);
							fwrite($fp, "\n" . $psw);
							echo "<script>alert('User $uname was created');</script>\n";
							echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
							echo "<a title='Login Again' href='loginform.php'>Login Again</a>\n";
						} else {
							echo "<script>alert('$uname is already taken by another user!');</script>\n";
							echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
							echo "<a title='Go Back' href='loginform.php'>Go Back</a>\n";
						}
					}

					/*
					 * Writes in the encrypted text file if the form was submitted by pressing the 'Create Login' button or calls searchPasswordFile() for invalid data
					 */
					function addToEncFile() {
						global $uname, $psw;
						$encFile = "enc_password.txt";	// represents the name of the file
						
						if (file_exists($encFile)) {	// if the file is available
							file_put_contents($encFile, "\n" . md5($uname), FILE_APPEND);	// adds the data to the file, FILE_APPEND uses to not overwrite existing data
							file_put_contents($encFile, "\n" . md5($psw), FILE_APPEND);	
						}
					}

					/*
					 * Reads the enc_password.txt and compares it with the data that was entered by the user
					 */
					function readEncFile(String $username, String $password, int $usersCnt, bool $check) {
						global $isLogin;
						$encFile = "enc_password.txt";	// represents the name of the file
						$efp = fopen($encFile, "c+");	// sets mode to reading and writting, starts at the beginning of the file
						$first = false;	// represents when data is first being written in a file
						$written = false; 	// represents when data is already written in the file

						if (file_exists($encFile)) {	// checks if the encrypted text file is available
							// Prime Read
							$arrEncUnme[] = trim(fgets($efp));	// adds the first username to the array							
							$arrEncPsw[] = trim(fgets($efp));	// adds the first password to the array

							// EOF Loop
							while (!feof($efp)) {
								$arrEncUnme[] = trim(fgets($efp));	// adds each username in the file to the array
								$arrEncPsw[] = trim(fgets($efp));	// adds each password in the file to the array
							}

							// The total length of the encrypted users array
							$encUsersCnt = count(explode("\n", file_get_contents($encFile)));	// used to compare the lengths between the encrypted array and the non-ecrypted array

							if ($encUsersCnt < $usersCnt) {	// checks if the length of the encrypted file is less than the regular text file
								if (empty($arrEncUnme[0]) && empty($arrEncPsw[0])) {	// checks if the current file is empty
									$first = true;
									writeEncFile($efp, $first);
								} else {
									$first = false;
									writeEncFile($efp, $first);
								}
							} elseif ($check) {	 // if data should be checked
								// Loop that compares the encrypted data from the file to what was entered by the user					
								for ($i = 0; $i < count($arrEncUnme); $i++) {	// uses count($arrEncUnme) but could also use count($arrEncPsw) since they are the same length
									if ($arrEncUnme[$i] == md5($username) && $arrEncPsw[$i] == md5($password)) {	// if the encrypted file's data matches with the data in the regular text file 
										$isLogin = true;
										$i = count($arrEncPsw);	// ends the loop by setting $i to the length of the arrays
									} elseif ($i == count($arrEncUnme) - 1) {	// if no matches were found
										$isLogin = false;
									}
								}
							}
							fclose($efp);
						} else {
							echo "<script>alert('$encFile was not found');</script>\n";
							echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
							echo "<a title='Go Back' href='loginform.php'>Go Back</a>\n";
						}
					}

					/*
					 * Writes the encrypted data in the encrypted text file
					 * The parameter '$efp' represents the result of the fopen() function for the encrypted file
					 */
					function writeEncFile($efp, bool $first) {
						global $uname, $psw;
						$check = true;	// determines if usernames and passwords should be added to the encrypted file
						$arrEncData = explode("\n", file_get_contents("enc_password.txt"));	// gets all the data in the encrypted file and puts it into an array

						// Loops that checks if the username and password should be encrypted and added to the file 
						for ($i = 0; $i < count($arrEncData) - 1; $i += 2) {	// count($arrEncData) - 1 and $i += 2 used to offset the data in order to get all the usernames in the file
							if ($arrEncData[$i] == md5($uname)) {	// if the username is already in enc_password.txt
								$check = false;
							}
						}

						for ($i = 1; $i < count($arrEncData) - 1; $i += 2) {	// $i starts at 1 to get all the passwords
							if ($arrEncData[$i] == md5($psw)) {	// if the password is already in enc_password.txt
								$check = false;
							}
						}

						// Checks how the username and password should be encrypted and added to the file 
						if ($check) {	// if data should be added to the file
							if ($first) {	// if this is the first data that is being written to the file
								fwrite($efp, md5($uname) . "\n");
								fwrite($efp, md5($psw));
							} else {
								fwrite($efp, "\n" . md5($uname));
								fwrite($efp, "\n" . md5($psw));
							}
						}
					}
					

					/*
					 * Displays a message back to the user based on $isLogin
					 */
					function searchPasswordFile(String $username, String $password) {
						global $isLogin;

						// Checks if the user is logged in
						if ($isLogin) {	// if the user is logged in
							echo "<script>alert('$username and $password matches a known user\'s username and password');</script>\n";
							echo "<p>Welcome $username!</p>\n";
						} else {
							echo "<script>alert('$username and $password does not match any known user\'s username and password, consider creating a new login');</script>\n";
							echo "<script>document.getElementById('content').classList.add('expand');</script>\n";
							echo "<a title='Go Back' href='loginform.php'>Go Back</a>\n";
						}
					}
				?>
			</div>
		</div>
	</body>
</html>