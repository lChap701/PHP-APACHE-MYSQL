<?php
	/* Created by Lucas Chapman 6/9/2020 */
	/* Updated 7/23/2020 by Lucas Chapman */
	/* This PHP file demonstrates the require statement and foreach loops */
	$navCaptions = array("Home", "Products & Services", "Updates", "Link");
	$navLinks = array("index.php", "products.php", "updates.php", "#");
	$subNavLinks = array("itemdisplay.php", "ordersdisplay.php");
	$subNavCaps = array("Find Item", "Check Order");
				
	// Displays all the links in the navigation area
	// Both loops loop through each element and it's key (index) in each array
	foreach ($navCaptions as $capKey => $captions) {
		foreach ($navLinks as $linkKey => $links) {
			if ($capKey == $linkKey) {	// checks if both arrays keys (indexes) match
				if ($links == "products.php") {	// prints tags if the keys (indexes) match
					echo "<div class='subnav'>\n";
					echo "<a href='$links' title='$captions'>$captions <i class='fa fa-caret-down'></i></a>\n";	
					echo "<nav class='subnav-content'>\n";
					foreach ($subNavLinks as $subLinkKey => $subLinks) {
						foreach ($subNavCaps as $subCapKey => $subCaps) {
							if ($subCapKey == $subLinkKey) {
								echo "<a href='$subLinks' title='$subCaps'>$subCaps</a>\n";
							}
						}
					}
					echo "</nav>\n";
					echo "</div>\n";
				} else {
					echo "<a href='$links' title='$captions'>$captions</a>\n";	// prints <a> tags if keys (indexes) match
				}
			}
		}
	}
?>
<!-- Script for adding extra styles to subnav -->
<script src="js/subnavStyles.js"></script>