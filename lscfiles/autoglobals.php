<?php
	/* Created 6/22/2020 by Lucas Chapman */
	/* This is a php page created to demonstrate autoglobal/supervariables */
	echo "<p>Prints the contents of one autoglobal variable ('SCRIPT_NAME') from an autoglobal array (\$_SERVER):</p>";
	echo $_SERVER['SCRIPT_NAME'];
	echo "<p>Prints the contents of one autoglobal variable from the \$_ENV autoglobal array (Not able to be used with \$_ENV autoglobal array, so the getenv function is used):</p>";
	echo getenv('USERNAME');
	echo "<p>Prints the contents of all the variables in one of the autoglobal arrays (except \$_ENV):</p>";
	echo var_dump($_SERVER);
	echo "<p>Prints the contents of all the variables in all of the previous autoglobal array (except \$_ENV):</p>";
	echo var_dump($GLOBALS);
	echo "<p>Prints the contents of all the variables in all of the autoglobal array including \$_ENV and configuration information:</p>";
	echo phpinfo();
?>