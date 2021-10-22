<?php echo "\n<!-- This code is part of a separate PHP file that is used to allow users to login and demonstrates the use of decision structure, functions, and the require statement -->" // use to start on the next line ?>
<div id="special-tag">
	<!-- Opens the login form when clicked on -->
	<a id="log" title="Login" onclick="document.getElementById('login').style.display = 'flex'"><i class="fas fa-user-alt"></i> Login</a>
	<?php
		/* Created by Lucas Chapman 6/9/2020 */
		/* Updated 7/24/2020 by Lucas Chapman */
		/* PHP code that checks if the user is logged in or not */
		$isLogin = false;
		$username = null;
		$password = null;
						
		if (isset($_POST["button"])) {	// checks if the login form has been submitted
			$username = $_REQUEST["uname"];	// stores what was in 'uname' (the username prompt) in variable
			$password = $_REQUEST["psw"];	// stores what was in 'psw' (the password prompt) in variable
			$isLogin = checkAccount();
			login();
		}
					
		/*
		 * Checks if a username and password has been entered and returns a Boolean value to store in another variable
		 */
		function checkAccount() {
			global $username, $password;	// passes global variables to the function
			/*$username = validUsername();
			$password = validUsername();*/
				
			if ($username != null && $password != null) {	// checks if a username and password has been entered
				$login = true;
			} else {
				$login = false;
			}
			return $login;
		}

		function login() {
			global $isLogin, $username;	// passes global variables to the function
						
			if ($isLogin == true) {	// checks if the user is logged in
				echo "<script>";
				echo "alert('Welcome $username!');";	// displays a welcome message
				echo "var log = document.getElementById('log');";
				echo "log.title = 'Logout';";	// sets the value of title/tool tip attribute
				echo "log.setAttribute('href', window.location.href.split('#')[0]);";	// sets the value of the href attribute to the current page without the '#' hash
				echo "log.removeAttribute('onclick');";	// removes the onclick attribute
				echo "var str = log.title;";	// sets what the innerHTML (text displayed in the tag) will be
				echo "var i = document.createElement('i');";	// creates a new <i> tag
				echo "var attr = document.createAttribute('class');";	// creates a new class attribute
				echo "attr.value = 'fas fa-user-alt';";	// assigns a value to the new class
				echo "i.setAttributeNode(attr);";	// sets the new class to be an attribute of the <i> tag
				echo "log.innerHTML = ' ' + str;";	// sets the text that will be displayed in (the innerHTML of) the tag 
				echo "log.insertBefore(i, log.childNodes[0]);";	// inserts the <i> tag before the log id text	
				echo "</script>";
			} else {
				echo "<script>alert('Please consider logging in');</script>";	// displays a login message
			}
		}
	?>
</div>

<div id="login">
	<form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label class="special"><b>Login</b></label>
				
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname"></input>
				
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