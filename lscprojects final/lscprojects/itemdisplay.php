<!-- Created by Lucas Chapman 7/23/2020 -->
<!-- This PHP webpage demonstrates forms and form handling, superglobal variables, and database proccessing -->
<!DOCTYPE html>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Find Item</title>
		<!-- Font Awesome Script -->
		<script src="https://kit.fontawesome.com/855ee508c4.js" crossorigin="anonymous"></script>
		<!-- Stylesheet uses time() to avoid conflicts with cache -->
		<link rel="stylesheet" href="CSS/styles.css?<?php echo time(); ?>">
	</head>
	<body>
		<?php require_once("connect_to_database.php"); ?>
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
					<!-- Order Section -->
					<form name="order" method="post" action="<?php echo $_SERVER['PHP_SELF']; // links to it's self?>">
						<div class="row">
							<div class="col-50">
								<?php
									/* Form Handler Code */
									$showForm = true;	// used to display the form again 
									$prods = "";		// represents the selected product sent to the form handler 
									$servs = "";		// represents the selected service sent to the form handler
									$mons = "";			// represents the selected months of service sent to the form handler
									$cost = "";			// represents the cost displayed in the form 
									$disc = "";			// represents the discount displayed in the form

									// Sets the value of item
									if (isset($_POST['item'])) {	// if form had been posted
										$item = $_POST['item'];
									} else {
										$item = "prod";	// default value
									}

									// Checks if the form was posted to display valid data or an error message back to the user
									if (isset($_POST['search'])) {
										if ($item == "prod") {
											$prods = $_POST['prods'];

											$result = $con -> query("SELECT DISTINCT orgCostProd, discProd FROM products WHERE prodName = '$prods'");
											if ($result -> num_rows > 0) {
												echo "<script>alert('Product was found!')</script>\n";
												while ($rows = $result -> fetch_assoc()) {
													$cost = $rows["orgCostProd"];
													$cost = "$" . $cost;
													$disc = $rows["discProd"];
													// Checks if it's null
													if ($disc != null) {
														$disc = $disc . "%";
													} else {
														$disc = "0.00%";
													}
												}
											} else {
												echo "<script>alert('Product was not found')</script>\n";
											}
										} else {
											$servs = $_POST['servs'];	
											$mons = $_POST['mons'];	

											$result = $con -> query("SELECT DISTINCT orgCostServ, discServ FROM services NATURAL JOIN serviceOrders WHERE servName = '$servs' AND months = $mons");
											if ($result -> num_rows > 0) {
												echo "<script>alert('Service was found!')</script>\n";
												while ($rows = $result -> fetch_assoc()) {
													$cost = $rows["orgCostServ"];
													$cost = "$" . $cost;
													$disc = $rows["discServ"];
													// Checks if it's null
													$disc != null ? $disc = $disc . "%" : $disc = "0.00%";
												}
											} else {
												echo "<script>alert('Service was not found')</script>\n";
											}
										}
									}
								?>
								
								<label class="special"><b>Find Item</b></label>
								<div id="product" class="row  <?php echo $item == "serv" ? " hidden" : "";	// checks if hidden class should be added ?>">
									<div class="col-75">
										<label for="prods">Product</label>
										<select id="prods" name="prods">
											<option value=""></option>
											<!-- PHP generated code -->
											<?php
												/* Generates a list of options from MySQL */
												$result = $con -> query("SELECT DISTINCT prodName FROM products");
												while ($row = $result -> fetch_assoc()) {
													$valProd = $row["prodName"];
													$isSelected = $prods == $valProd ? " selected" : "";
													echo "<option value='$valProd' $isSelected>$valProd</option>\n";
												}
											?>
										</select>
									</div>
								</div>

								<div id="service" class="row <?php echo $item == "prod" ? " hidden" : "";	// checks if hidden class should be added ?>">
									<div class="col-50">
										<label for="servs">Service</label>
										<select id="servs" name="servs">
											<option value=""></option>	
											<option value="Safety Net" <?php echo $servs == "Safety Net" ? " selected" : ""; // checks if option was selected when posted ?>>Safety Net</option>	
											<option value="Network Manager" <?php echo $servs == "Network Manager" ? " selected" : ""; // checks if option was selected when posted ?>>Network Manager</option>
											<option value="Network Generator" <?php echo $servs == "Network Generator" ? " selected" : ""; // checks if option was selected when posted ?>>Network Generator</option>
										</select>
									</div>

									<div class="col-25">										
										<label for="mons">Months</label>
										<select id="mons" name="mons">
											<option value="0" >0</option>
											<option value="2" <?php echo $mons == "2" ? " selected" : ""; // checks if the option was selected ?>>2</option>
											<option value="6" <?php echo $mons == "6" ? " selected" : ""; // checks if the option was selected ?>>6</option>
											<option value="12" <?php echo $mons == "12" ? " selected" : ""; // checks if the option was selected ?>>12</option>
										</select>
									</div>
								</div>

								<div class="row">
									<div class="col-75">
										<label for="cost">Cost</label>
										<input type="text" id="cost" name=" cost" value="<?php echo $cost; ?>" readonly>
									</div>

									<div class="col-75">
										<label for="disc">Discount</label>
										<input type="text" id="disc" name="disc" value="<?php echo $disc; ?>" readonly>
									</div>
								</div>

								<div class="row" id="last-row">
									<div class="col-50" id="last-col-50">
										<label for="item">Type Of Item: </label>
										<div class="wrap">
											<input id="prod" name="item" value="prod" type="radio" <?php echo $item == "prod" ? " checked" : "";	// checks if the radio button was checked ?>>
											<label for="prod">Product</label>
											<input id="serv" name="item" value="serv" type="radio" <?php echo $item == "serv" ? " checked" : "";	// checks if the radio button was checked ?>>
											<label for="serv">Service</label><br><br>
										</div>
									</div>
								</div>

								<input type="submit" title="Search" name="search" value="Search">

								<!-- The script for the form and it also contains the time() fix -->
								<script src="js/displayForm.js?<?php echo time(); ?>"></script>
							</div>
						</div>
						<?php $con -> close(); // ends database processing ?>
					</form>

					<h1>Most Searched Items</h1>
					<ol>
						<li>Network Developer Tools</li>
						<li>Networking Dev Kit Pro</li>
						<li>Safty Net</li>
						<li>Network Manager</li>
						<li>Network Generator</li>
						<li>Networking Dev Tools Pro</li>
						<li>Netware</li>
						<li>Net Developer Tools Pro</li>
						<li>Netsoft</li>
						<li>Net</li>
						<li>Networking Dev Tools</li>
						<li>Net Developer Tools</li>
						<li>Social Network</li>
						<li>Network Creation Center</li>
						<li>Networking Dev Kit</li>
					</ol>
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
						<li>3% off for all members</li>
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
		<?php include "inc_footer.php"; ?>
	</body>
</html>