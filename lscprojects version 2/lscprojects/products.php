<!-- Created by Lucas Chapman 6/3/2020 -->
<!-- This PHP webpage demonstrates arrays -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Products</title>
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
			<?php
				$navCaptions = array("Home", "Products & Services", "Link", "Link");
				$navLinks = array("index.php", "products.php", "#", "#");
				
				// Displays all the links in the navigation area
				for ($i = 0; $i < count($navCaptions); $i++) {
					echo "<a href='$navLinks[$i]' title='$navCaptions[$i]'>$navCaptions[$i]</a>";
				}
			?>
		</nav>
		<main>
			<div id="container">
				<!-- Help Section -->
				<section class="sect-1">
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
					<!-- Products & Services Section -->
					<h2>Products & Services</h2>
					<table>
						<caption>Product Keys</caption>
						<tr>
							<th>Name</th>
							<th>Price (Without Discount)</th>
							<th>In Stock</th>
							<th>Discount</th>
						</tr>
						<!-- PHP generated code -->
						<?php
							$products = array("Networking Dev Kit", "$19.99", "9,000", "3%", 
											  "Networking Dev Kit Pro", "$29.99", 500, "10%", 
											  "Network Creation Center", "$39.99", "5,000", "15%",
											  "Net Developer Tools", "$49.99", 200, "20%",
											  "Net Developer Tools Pro", "$59.99", "3,000", "35%",
											  "Netware", "$69.99", "50,000", "45%",
											  "Netsoft","$67.99","100,000","45%",
											  "Net","$99.99","10,000","55%",
											  "Social Network","$199.99","200,000","65%");
								
							// Displays all the product keys on the Product Keys table
							for ($i = 0; $i < count($products); $i++) {
								if ($i == 0 || $i == 4 || $i == 8 || $i == 12 || $i == 16 || $i == 20 || $i == 24 || $i == 28 || $i == 32) { 
									echo "<tr><td><a href='#' title='$products[$i]'>$products[$i]</a></td>";
								} elseif ($i == 3 || $i == 7 || $i == 11 || $i == 15 || $i == 19 || $i == 23 || $i == 27 || $i == 31 || $i == 35) {
									echo "<td>$products[$i]</td></tr>";
								} else {
									echo "<td>$products[$i]</td>";
								}
							}
						?>
					</table>
					<br>
					<br>
					<table>
						<caption>Services</caption>
						<tr>
							<th>Name</th>
							<th>Price (Without Discount)</th>
							<th>Months</th>
							<th>Discount</th>
						</tr>
						<!-- PHP generated code-->
						<?php
							$services = array("Safety Net", "$9.99", 2, "2%", "$29.99", 6, "9%", "$59.99", 12, "20%",
											  "Network Manager", "$4.99", 2, "None", "$14.99", 6, "1%", "$29.99", 12, "7%", 
											  "Network Generator", "$5.99", 2, "None", "$17.99", 6, "5%", "$35.99", 12, "15%");
								
							// Displays all the services on the Services table
							for ($i = 0; $i < count($services); $i++) {
								switch($i) {
									case 0:
									case 10:
									case 20:
										echo "<tr><td rowspan='3'><a href='#' title='$services[$i]'>$services[$i]</a></td>";
										break;
									case 3:
									case 6:
									case 9:
									case 13:
									case 16:
									case 19:
									case 23:
									case 26:
									case 29:
										echo "<td>$services[$i]</td></tr>";
										break;
									case 4:
									case 7:
									case 14:
									case 17:
									case 24:
									case 27:
										echo "<tr><td>$services[$i]</a></td>";
										break;
									default:
										echo "<td>$services[$i]</td>";
								}
							}
						?>
					</table>
				</section>
			
				<section class="sect-3">
					<!-- Recommendations Section -->
					<h2>Recommendations</h2>
					<h3>Products</h3>
					<h4>Most Recommended</h4>
					<ol>
						<li>Networking Dev Tools Pro</li>
						<li>Netware</li>
						<li>Net Developer Tools Pro</li>
						<li>Netsoft</li>
						<li>Net</li>
						<li>Networking Dev Tools</li>
						<li>Net Developer Tools</li>
						<li>Social Network</li>
						<li>Network Creation Center</li>
					</ol>
					<hr>
					<h3>Services</h3>
					<h4>Most Recommended</h4>
					<ol>
						<li>Safty Net</li>
						<li>Network Generator</li>
						<li>Network Manager</li>
					</ol>
					<hr>
					<!-- Deals Section -->
					<h2>Deals</h2>
					<h3>Current Deals</h3>
					<ul class="deals">
						<li>Free trials for all services</li>
						<li>Coronavirus Sale - 20% off</li>
						<li>15% off for all members</li>
						<li>Free Shipping Month</li>
						<li>Summer Sale - 10% off</li>
					</ul>
					<hr>
					<h3>Upcoming Deals</h3>
					<ul class="deals">
						<li>Buy one get one free</li>
						<li>First Purchase Sale - 5% off</li>
						<li>9% off for Iowan businesses</li>
						<li>Anniversary Sale - 10% off</li>
					</ul>
				</section>
			</div>
		</main>
		<footer>&copy; Copyright 2001 Networking Inc.</footer>
	</body>
</html>