<?php
	/* Created by Lucas Chapman 6/9/2020 */
	/* Updated 7/26/2020 by Lucas Chapman */
	/* Finds the username and password that was entered and checks if the user is logged in or not */
	/* This is the first part of the PHP code */
	session_start();	// starts a new session
	$_SESSION['login'] = false;
	$username = null;
	$password = null;
	$errCtr = 0;
							
	// Performs validation when the form is submitted
	if (isset($_POST['button'])) {	// checks if the login form has been submitted
		$username = validUsername($_REQUEST['uname']);	// stores what was in 'uname' (the username prompt) in variable if it's valid
		$password = validPassword($_REQUEST['psw']);	// stores what was in 'psw' (the password prompt) in variable if it's valid
		$_SESSION['login'] = checkAccount();
		if (isset($_POST['remember'])) {	// checks if the 'Remember Me' checkbox was checked
			setcookie("unme", $username, time() + 60 * 60 * 24 * 30);	// creates a cookie for the username that was entered that will expire 30 days from the current date
		} else {
			// Deletes a cookie when a 'unme' cookie exists and the 'Remember Me' checkbox is not checked 
			if (isset($_COOKIE['unme'])) {
				setcookie("unme", $username, time() - 60 * 60 * 24 * 30);	// deletes an existing cookie for the username that was entered 
			}
		}
	}
?>
<?php echo "\n<!-- This code is part of a separate PHP file that is used to allow users to login and demonstrates the use of decision structure, functions, the require statement, autoglobal variables, and cookies and sessions -->" // use to start this HTML comment on the next line ?>
<div id="special-tag">
	<!-- Opens the login form when clicked on -->
	<a id="log" name="log" title="Login" onclick="document.getElementById('login').style.display = 'flex'"><i class="fas fa-user-alt"></i> Login</a>
	<?php
		/* This is the second part of the PHP code */
		login();

		/*
		 * Used to check if a username that was entered is valid
		 * Returns a null value for invalid usernames
		 */
		function validUsername(String $uname) {
			global $errCtr;
			$lenTrimUname = strlen(str_replace(" ","", $uname));	// represents length (not including any whitespace characters such as spaces)

			if (empty(trim($uname))) {	// checks if username was left null or only whitespace characters were entered 
				echo "<script>alert('No username was entered. Note: Any white space characters that were entered were trimmed.');</script>\n";
				$uname = null;
				$errCtr++;
			} elseif ($lenTrimUname < 4) {	// checks if username is less than 4 characters (not including whitespace characters)
				echo "<script>alert('Invalid username, " . str_replace(" ","", $uname) . " should be at least 4 characters long and all whitespace characters will be removed');</script>\n";
				$uname = null;
				$errCtr++;
			} else {
				$uname = str_replace(" ","", $uname);	// used to remove all whitespace characters
				$errCtr++;
			}

			return $uname;
		}
		
		
		/*
		 * Used to check if a password that was entered is valid
		 * Returns a null value for invalid passwords
		 */
		function validPassword(String $psw) {
			global $errCtr;
			$lenPsw = strlen($psw);	// represents the length
			$whitespace = preg_match("/\s+/", $psw);	// represents whitespace characters
			$letters = preg_match("/[A-Z]+/", $psw) && preg_match("/[a-z]+/", $psw);	// represents letters (uppercase and lowercase)
			$digits = preg_match("/\d+/", $psw);	// represents digits
			$nonWordChars = preg_match("/\W+/", trim($psw));	// represents non-alphanumeric characters

			if (empty($psw)) {	// checks if password was null when user tried to login
				echo "<script>alert('No password was entered');</script>\n";
				$psw = null;
				$errCtr++;
			} else {
				if ($whitespace) {	// checks if password contains any whitespace characters
					echo "<script>alert('Invalid password, $psw should not contain any whitespace characters (such as spaces)');</script>\n";
					$psw = null;
					$errCtr++;
				}
				if ($lenPsw < 12) {	// checks if the length is less than 12
					echo "<script>alert('Invalid password, $psw should be at least 12 characters long and with no whitespace characters');</script>\n";
					$psw = null;
					$errCtr++;
				}
				if (!$letters) {	// checks if password contains any uppercase and lowercase letters
					echo "<script>alert('Invalid password, $psw should contain at least one uppercase letter and one lowercase letter');</script>\n";
					$psw = null;
					$errCtr++;
				}
				if (!$digits) {	// checks if password contains any digits
					echo "<script>alert('Invalid password, $psw should contain at least one digit');</script>\n";
					$psw = null;
					$errCtr++;
				}
				if (!$nonWordChars) {	// checks if password contains any non-alphanumeric characters
					echo "<script>alert('Invalid password, $psw should contain at least one one non-alphanumeric character (any character that is not a letter, digit, or underscore (_))');</script>\n";
					$psw = null;
					$errCtr++;
				}
			}

			return $psw;
		}
		
		
		/*
		 * Checks if a valid username and valid password has been entered and returns a Boolean value to store in another variable
		 */
		function checkAccount() {
			global $username, $password;	// passes global variables to the function

			if ($username != null && $password != null) {	// checks if a username and password has been entered
				$login = true;
			} else {
				$login = false;
			}

			return $login;
		}
		
		
		/*
		 * Checks if the user is logged in
		 */
		function login() {
			global $errCtr, $username;
			
			if ($_SESSION['login']) {	// checks if the user is logged in
				// Checks if the 'Login' button was pressed
				echo "<script>alert('Welcome $username!');</script>\n";	// displays a welcome message
				echo "<script>\n";
				echo "var log = document.getElementById('log');\n";
				echo "log.title = 'Logout';\n";	// sets the value of title/tool tip attribute
				echo "log.setAttribute('href', window.location.href.split('#')[0]);\n";	// sets the value of the href attribute to the current page without the '#' hash
				echo "log.setAttribute('onclick', 'login();');\n";	// removes the onclick attribute
				echo "var str = log.title;\n";	// sets what the innerHTML (text displayed in the tag) will be
				echo "var i = document.createElement('i');\n";	// creates a new <i> tag
				echo "var attr = document.createAttribute('class');\n";	// creates a new class attribute
				echo "attr.value = 'fas fa-user-alt';\n";	// assigns a value to the new class
				echo "i.setAttributeNode(attr);\n";	// sets the new class to be an attribute of the <i> tag
				echo "log.innerHTML = ' ' + str;\n";	// sets the text that will be displayed in (the innerHTML of) the tag 
				echo "log.insertBefore(i, log.childNodes[0]);\n";	// inserts the <i> tag before the log id text	
				echo "</script>\n";
			} else {
				if ($errCtr == 0) {
					echo "<script>alert('Please consider logging in. Note: click on \"Remember Me\" checkbox to have your username remembered');</script>\n";	// displays a login message
				} 
			}
		}
	?>
</div>
<script src="js/login.js"></script>

<div id="login">
	<form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label class="special"><b>Login</b></label>
				
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname" value="<?php if (isset($_COOKIE['unme'])) { echo $_COOKIE['unme']; } 	// checks if a cookie should be displayed ?>"></input>
				
		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="psw"></input>
				
		<input type="submit" title="Login" name="button" value="Login"></input>
			
		<label><input type="checkbox" name="remember"> Remember me</label>
			
		<div class="separate">
			<!-- The cancel button closes the login form -->
			<button type="button" title="Cancel" class="cancel" onclick="document.getElementById('login').style.display = 'none'">Cancel</button>
			<span class="psw"><a href="#" title="Forgot password?">Forgot password?</a></span>
			<span class="acnt"><a href="#" title="Create Account">Create Account</a></span>
		</div>
	</form>
</div>
