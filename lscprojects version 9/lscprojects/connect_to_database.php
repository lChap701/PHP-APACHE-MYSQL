<!-- Code from a separate PHP file placed up here to prevent everything else from being executed in this file when database connection errors occur -->
<?php
	/* Created by Lucas Chapman 7/22/2020 */ 
	/* This file is used to connect to MySQL and the lscdatabase */ 
	// Connects to the server and the database that is being used for this site
	$con = @new mysqli("localhost", "root", "", "lscdatabase", 3308);	// specifies the host, username, password, database, and MySQL port (for me, the port is required for this code to work)
	
	// Checks for connection errors and displays messages based on the error that occurred (if any)
	if ($con -> connect_error) {
		echo "<script>document.body.style.textAlign = 'center';</script>\n";
		echo "<h1>Connect Error " . $con -> connect_errno . " " . $con -> connect_error . "</h1>\n";
		echo "<h2>This website is temporily unavailabe due to a serious error with our server. We are currently working on fixing this issue, sorry for the inconvience!</h2>\n";
		echo "</body>\n";	// adds the ending <body> tag
		exit();	// exit() is used to stop all other code from being executed when errors occur
	} else {
		echo "<script>console.log('Connection was successful!')</script>\n";
	}
?>