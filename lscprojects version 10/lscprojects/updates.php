<!-- Created by Lucas Chapman 7/9/2020 -->
<!-- This PHP page was created to demonstrate 2 dimensional arrays and associative arrays -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Updates</title>
		<!-- Font Awesome Script -->
		<script src="https://kit.fontawesome.com/855ee508c4.js" crossorigin="anonymous"></script>
		<!-- Stylesheet uses time() to avoid conflicts with cache -->
		<link rel="stylesheet" href="CSS/styles.css?<?php echo time(); ?>">
	</head>
	<body>
		<header>
			<h1>Networking Inc.</h1>
			<i>Proctected. Secure. Affordable.</i>
		</header>
		<nav>
			<!-- PHP generated code -->
			<?php require "inc_navigation.php"; ?>
			<?php require "inc_welcome.php"; ?>
		</nav>
		<main>
			<div id="container">
				<section class="sect-1">
					<!-- Help Section -->
					<h2>Help</h2>
					<h3>Tech Support Hours</h3>
					<p>Monday thru Thursday</p>
					<ul>
						<li>8:00 AM to 8:00 PM</li>
					</ul>
					<hr>
					<p>Friday thru Saturday</p>
					<ul>
						<li>9:00 AM to 5:00 PM</li>
					</ul>
					<hr>
					<p>Sunday - Closed</p>
					<hr>
					<!-- Displays the current time with the script containing the time() fix -->
					<p id="time"></p>
					<script src="js/currentTime.js?<?php echo time(); ?>"></script>
					<hr>
					<h3>Reach Out</h3>
					<h4>Email</h4>
					<a href='#' title="techsupport.netinc@gmail.com" target="_blank">techsupport.netinc@gmail.com</a>
					
					<h4>Phone</h4>
					<p>641-514-9001</p>
					
					<h4>Online</h4>
					<ul>
						<li><a href="#" title="Online Support">Online Support</a></li>
						<li><a href="#" title="FaceTime">FaceTime</a></li>
						<li><a href="#" title="Skype">Skype</a></li>
						<li><a href="#" title="Zoom">Zoom</a></li>
						<li><a href="#" title="Google Hangout">Google Hangout</a></li>
					</ul>
					<hr>
					<h3>More Resources</h3>
					<ul>
						<li><a href="#" title="Schedule an appointment">Schedule an appointment</a></li>
						<li><a href="#" title="FAQ">FAQ</a></li>
						<li><a href="#" title="Common mistakes">Common mistakes</a></li>
						<li><a href="https://www.youtube.com/" title="Video tutorials" target="_blank">Video tutorials</a></li>
						<li><a href="manual.txt" download title="Manual">Manual</a></li>
					</ul>
				</section>
				
				<section class="sect-3">
				<!-- Updates Section -->
				<h2>Updates</h2>
				<i>Updated: <?php echo date_format(date_create("2020-06-01"),"n/j/Y");	// formats and creates a date ?></i>
				
				<div class="rows">
				<!-- PHP generated code -->
				<?php
					/* 2 dimensional associative array to print all the dates and other related information for each update*/
					$arrDates = array(
						"Products" => array(
							"Social Network Out Now!" => date_format(date_create("2020-05-20"), "n/j/Y"),
							"Netty Prototype" => date_format(date_create("2020-05-15"), "n/j/Y"),
							"Net Connects Prototype" => date_format(date_create("2020-05-06"), "n/j/Y")
						),
						"Services" => array(
							"Connection Center Protype" => date_format(date_create("2020-06-01"), "n/j/Y"),
							"Safety Net Is Now 20% Off For 6 Months!" => date_format(date_create("2020-05-31"), "n/j/Y"),
							"Connect Net Protype" => date_format(date_create("2020-05-15"), "n/j/Y")
						),
						"Locations" => array(
							"Paris, France Location Is Being Set Up!" => date_format(date_create("2020-02-04"), "n/j/Y"),
							"Hong Kong, China Location Is Being Set Up!" => date_format(date_create("2019-11-03"), "n/j/Y"),
							"Tokyo, Japan Location Is Being Set Up!" => date_format(date_create("2019-10-31"), "n/j/Y")
						),
						"Awards" => array(
							"Most Reliable Networking Company Of The 2010's" => date_format(date_create("2020-01-04"), "n/j/Y"),
							"Top 10 Comapanies To Work At Of The 2010's" => date_format(date_create("2020-01-01"), "n/j/Y"),
							"The Fastest Growing Comapanies Of The 2010's" => date_format(date_create("2019-12-20"), "n/j/Y")
						)
					);
					// Loops that prints out all of the content from the array
					foreach ($arrDates as $category => $arrTopics) {	// prints categories
						echo "<div class='columns'>\n";
						echo "<h3>$category</h3>\n";

						foreach ($arrTopics as $topic => $date) {	// prints topics and dates
							echo "<h4>$topic</h4>\n";
							echo "<i>Updated: $date</i>\n";
							echo "<br><br><a href='#' title='Read More'>Read More</a>\n";						

							// Check if the last element in the topics associative array has been reached 
							if ($date == end($arrTopics)) {
								echo "<br><br><a href='#' title='See More'>See More</a>\n";
								echo "</div>\n";
							}
						}
					}
				?>
				</div>
				</section>
		</main>
		<?php include "inc_footer.php"; ?>
	</body>
</html>