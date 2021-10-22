<?php
	/* Created by Lucas Chapman 6/9/2020 */
	/* Updated 7/9/2020 by Lucas Chapman */
	/* This PHP file demonstrates the require statement and foreach loops */
	$navCaptions = array("Home", "Products & Services", "Updates", "Link");
	$navLinks = array("index.php", "products.php", "updates.php", "#");
				
	// Displays all the links in the navigation area
	// Both loops loop through each element and it's key (index) in each array
	foreach ($navCaptions as $capKey => $captions) {	
		foreach ($navLinks as $linkKey => $links) {
			if ($capKey == $linkKey) {	// checks if both arrays keys (indexes) match
				echo "<a href='$links' title='$captions'></i>$captions</a>\n";	// prints <a> tags if keys (indexes) match
			}
		}
	}
?>