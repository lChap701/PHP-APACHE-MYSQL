<!-- Created by Lucas Chapman 6/23/2020 -->
<!-- This PHP file is used to allow users to login and demonstrates the use of form handling -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Login Form Example</title>
		<link rel="stylesheet" href="CSS/login.css?<?php echo time(); ?>">
	</head>
	<body>
		<div id="container">
			<form method="post" action="logindisplay.php">
				<label class="special"><b>Login</b></label>
						
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname"></input>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw"></input>
							
				<input type="submit" title="Login" name="login" value="Login"></input>

				<label><input type="checkbox" checked="checked" name="remember"> Remember me</label>
					
				<div class="separate">
					<button type="button" disabled title="Sign Up" class="sign" >Sign Up</button>
					<span class="psw"><a href="#" title="Forgot password?">Forgot password?</a></span>
				</div>
			</form>
		</div>
	</body>
</html>
