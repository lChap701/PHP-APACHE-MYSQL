<!-- Created by Lucas Chapman 7/24/2020 -->
<!-- This PHP webpage demonstrates database proccessing -->
<!DOCTYPE html>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Check Order</title>
		<!-- Font Awesome Script -->
		<script src="https://kit.fontawesome.com/855ee508c4.js" crossorigin="anonymous"></script>
		<!-- Stylesheet uses time() to avoid conflicts with cache -->
		<link rel="stylesheet" href="CSS/styles.css?<?php echo time(); ?>">
	</head>
	<body>
		<!-- PHP generated code -->
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
					<!-- Check Order section -->
					<h1>Check Order</h1>
					
					<div class="row" id="last-row">
						<div class="col-50" id="last-col-50">
							<label for="item">Type Of Item Ordered: </label>
							<div class="wrap">
								<input id="prod" name="item" value="prod" type="radio" checked>
								<label for="prod">Product</label>
								<input id="serv" name="item" value="serv" type="radio">
								<label for="serv">Service</label><br><br>
							</div>
						</div>
					</div>
					<table id="product">
						<caption>Product Keys</caption>
							<tr>
								<!-- Note: the Order ID column represents the prodOrdId column in the ProductOrders table -->
								<th>Order ID</th>
								<th>Product ID</th>
								<th>Name</th>
								<th title="Quantity">Qty</th>
								<th>Ordered</th>
								<th>Shipped</th>
								<th>Arrives</th>
								<th>Price</th>
								<th>Discount</th>
							</tr>
							<?php
								/* Display all of the rows for an orders and additional information for a product */
								$select = "SELECT prodOrdId, prodId, prodOrdId, prodName, quantity, prodOrdDate, shipDate, arrivDate, prodCost, totProdDisc FROM products NATURAL JOIN productOrders ORDER BY prodOrdId";
								$result = $con -> query($select);
								if ($result -> num_rows > 0) {
									while ($rows = $result -> fetch_assoc()) {
										echo "<tr>\n";
										echo "<td>" . $rows["prodOrdId"] . "</td>";
										echo "<td>" . $rows["prodId"] . "</td>";
										echo "<td>" . $rows["prodName"] . "</td>";
										echo "<td>" . $rows["quantity"] . "</td>";
										echo "<td>" . date_format(date_create($rows["prodOrdDate"]), "m/d/y") . "</td>";
										echo "<td>" . date_format(date_create($rows["shipDate"]), "m/d/y") . "</td>";
										echo "<td>" . date_format(date_create($rows["arrivDate"]), "m/d/y") . "</td>";
										echo "<td>" . "$" . number_format($rows["prodCost"], 2) . "</td>";	// numer_format() used to add commas for large numbers 
										echo "<td>" . $rows["totProdDisc"] * 100 . "%" . "</td>";
										echo "</tr>\n";
									}
								} else {
									echo "<h1>Error " . $result -> errno . " " . $result -> error . "</h1>";
									echo "<b>We seem to be having issues with our database, we will resolve this issue shortly!</b>\n";
									echo "<script>console.log('Error, no products where found')</script>\n";
								}
							
							?>
					</table>
					
					<table id="service" class="hidden">
						<caption>Services</caption>
							<tr>
								<th>Order ID</th>
								<th>Service ID</th>
								<th>Name</th>
								<th>Months</th>
								<th>Start Of Service</th>
								<th>End Of Service</th>
								<th>Price</th>
								<th>Discount</th>
							</tr>
							<?php
								// Display all of the rows for the products and their orders as part of the requirements for this project
								$select = "SELECT servOrdId,  servId,servName, months, startOfServ, endOfServ, servCost, totServDisc FROM services NATURAL JOIN serviceOrders ORDER BY servOrdId";
								$result = $con -> query($select);
								if ($result -> num_rows > 0) {
									while ($rows = $result -> fetch_assoc()) {
										echo "<tr>\n";
										echo "<td>" . $rows["servOrdId"] . "</td>";
										echo "<td>" . $rows["servId"] . "</td>";
										echo "<td>" . $rows["servName"] . "</td>";
										echo "<td>" . $rows["months"] . "</td>";
										echo "<td>" . date_format(date_create($rows["startOfServ"]), "m/d/y") . "</td>";
										echo "<td>" . date_format(date_create($rows["endOfServ"]), "m/d/y") . "</td>";
										echo "<td>" . "$" . $rows["servCost"] . "</td>";
										echo "<td>" . $rows["totServDisc"] * 100 . "%" . "</td>";
										echo "</tr>\n";
									}
								} else {
									echo "<h1>Error " . $result -> errno . " " . $result -> error . "</h1><br>";
									echo "<b>We seem to be having issues with our database, we will resolve this issue shortly!</b>\n";
									echo "<script>console.log('Error, no products where found')</script>\n";
								}
							
							?>
					</table>
					<?php $con -> close(); 	// ends database proccessing ?>
					<script src="js/displayTable.js"></script>
				</section>
			</div>
		</main>
		<?php include "inc_footer.php"; ?>
	</body>
</html>