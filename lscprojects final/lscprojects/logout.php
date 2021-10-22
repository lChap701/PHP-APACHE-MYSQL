<!-- Created by Lucas Chapman 8/7/2020 -->
<!-- This page is used to demonstrate sessions and the header() function -->
<?php 
	/* Used to logout the user and redirect back to the previous page */
	session_start();	// starts a new session
	unset($_SESSION ['login']);	// logouts the user
	$_SESSION['logout'] = true;	// used to display a logout message
	header('Location: ' . $_SERVER['HTTP_REFERER']);	// goes back to the previous page
?>