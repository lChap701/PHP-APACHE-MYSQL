<!-- Created by Lucas Chapman 5/27/2020 -->
<!-- Updated 7/12/2020 by Lucas Chapman -->
<!-- This webpage demonstrates PHP, arrays, foreach loops, the include statement, and the require statement -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Home</title>
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

				<section class="sect-2">
					<!-- About Section -->
					<h2>What is Networking Inc.?</h2>
					<p>Networking Inc. is a large computer networking company founded in Iowa that offers a verity of affordable services, applications, and software that can be used to create secure and protected networks. Our products are offered worldwide with a large tech support team being around to answer questions about our products and sort out any technical issues. Currently, we have over a million consumers accross the world and can be found in many US states, but we are working towards expanding across the globe.</p>
					<img class="img-med" src="images/ball-457334_640.jpg" alt="holding-a-world-with-binary-code">

					<h2>Headquarters</h2>
					<p>Our headquarters is located on 5th Avenue, Des Moines, Iowa. It's been there since the beginning of our company with the building being the first Networking Inc. store. Since then, we have continued to grow and expand the number of stores across the US and around the world.</p>
					<img class="img-lar" src="images/apartment-apartment-building-architecture-building-323705.jpg">					
				</section>
				
				<section class="sect-3">
					<!-- Locations Section -->
					<h2>Locations</h2>
					<?php
						/* Sets a date and uses . for concatenation */
						$date=date_create("2020-02-15");
						echo "<i>Updated: " . date_format($date,"n/j/Y") . "</i>\n"; 
					?>
					<hr>
					<p>Iowa</p>
					<ul>	
						<li><a href="#" title="123 1st Street, Ottumwa, IA">123 1st Street, Ottumwa, IA</a></li>
						<li><a href="#" title="456 5th Avenue, Des Moines, IA">456 5th Avenue, Des Moines, IA</a></li>
						<li><a href="#" title="310 B. Avenue, West Des Moines, IA">310 B. Avenue, West Des Moines, IA</a></li>
						<li><a href="#" title="129 Blake Drive, Centerville, IA">129 Blake Drive, Centerville, IA</a></li>
						<li><a href="#" title="285 East Avenue, Iowa City, IA">285 East Avenue, Iowa City, IA</a></li>
					</ul>
					<hr>
					<p>New York</p>
					<ul>
						<li><a href="#" title="31 Great Avenue, New York City, NY">31 Great Avenue, New York City, NY</a></li>
						<li><a href="#" title="10 G. Townson Drive, Albany, NY">10 G. Townson Drive, Albany, NY</a></li>
					</ul>
					<hr>
					<p>Illinois</p>
					<ul>
						<li><a href="#" title="255 Brick Street, Chicago, IL">255 Brick Street, Chicago, IL</a></li>
					</ul>
					<hr>
					<p>Minnesota</p>
					<ul>
						<li><a href="#" title="56 Washington Drive, Minneapolis, MN">56 Washington Drive, Minneapolis, MN</a></li>
						<li><a href="#" title="67 North Avenue, Saint Paul, MN">76 North Avenue, Saint Paul, MN</a></li>
					</ul>
					<hr>
					<p>Texas</p>
					<ul>
						<li><a href="#" title="1 Dewie Avenue, Austin, TX">1 Dewie Avenue, Austin, TX</a></li>
					</ul>
					<hr>
					<p>Missouri</p>
					<ul>
						<li><a href="#" title="17 New Drive, Kanas City, MO">17 New Drive, Kanas City, MO</a></li>
					</ul>
					<hr>
					<p>Colorado</p>
					<ul>
						<li><a href="#" title="109 West Avenue, Denver, CO">109 West Avenue, Denver, CO</a></li>
					</ul>
					<hr>
					<p>Wisconsin</p>
					<ul>
						<li><a href="#" title="209 North Eastern, Milwaukee, WI">209 North Eastern, Milwaukee, WI</a></li>
					</ul>
				</div>
			</section>
		</main>
		<?php include "inc_footer.php"; ?>
	</body>
</html>