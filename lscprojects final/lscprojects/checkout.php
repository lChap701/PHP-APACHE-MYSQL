<!-- Created by Lucas Chapman 8/6/2020 -->
<!-- This PHP webpage demonstrates forms and form handling, as well as superglobal variables, database processing, sessions, and OOP -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Checkout</title>
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
			<?php require_once("classes.php");	// put here so it will be processed before any sessions are started ?>
			<!-- PHP generated code -->
			<?php require "inc_navigation.php"; ?>
			<?php require "inc_welcome.php";	// starts a new session ?>
		</nav>
		<main>
			<div id="container">
				<section class="sect-2">
					<!-- Checkout Section -->
					<?php
						/* Determines if the data entered is in session storage and if any data was added to the database */
						$found = false;	// used to determine if the object was found in session storage

						if (isset($_SESSION['order'])) {
							echo "<script>console.log('The object is in session storage!')</script>\n";
							$found = true;
							insertCust();
							insertOrd();

							if ($_SESSION['order'] -> getItemType() == "prod") {
								$arrProdInfo = extraProdInfo();
								insertProd();
								insertProdOrd();
							} elseif ($_SESSION['order'] -> getItemType() == "serv") {
								$arrServInfo = extraServInfo();
								insertServ();
								insertServOrd();
							}
							
							$con -> close();	// closes the connection with the database
						}
						
						if ($found) {
							/* Styles added via the <script> tag */
							echo "<script>\n";
							echo "document.getElementById('container').style.display = 'block';\n";
							echo "document.getElementById('container').style.textAlign = 'center';\n";
							echo "document.getElementsByClassName('sect-2')[0].style.backgroundColor = '#286e85';\n";
							echo "document.getElementsByClassName('sect-2')[0].style.color = '#fff';\n";
							echo "</script>\n";

							/* Messages */
							echo "<p>Thank you " . $_SESSION['order'] -> getFname() . " " . $_SESSION['order'] -> getLname() . ", your purchase has been sent</p>\n";
							echo "<p>An email with your order ID was sent to " . $_SESSION['order'] -> getEmail() . "</p>\n";
							echo "<p>" . $_SESSION['order'] -> getFname() . " " . $_SESSION['order'] -> getLname() . " " . time() . "</p>\n"; 
						} else {
							/* Styles added via the <script> tag */
							echo "<script>\n";
							echo "document.getElementById('container').style.display = 'block';\n";
							echo "document.getElementById('container').style.textAlign = 'center';\n";
							echo "document.getElementsByClassName('sect-2')[0].style.backgroundColor = '#286e85';\n";
							echo "document.getElementsByClassName('sect-2')[0].style.color = '#fff';\n";
							echo "</script>\n";
							
							/* Messages */
							echo "<h1>Error</h1>";
							echo "<p>No order was found, please place another order!</p>\n";
							echo "<a href='makeorder.php' class='checkout' title='Place Order'><b>Go Back</b></a>\n";
						}
						
						/**
						 * Inserts data stored in the order object in the Customers Table
						 */
						function insertCust() {
							global $con;

							// '?' represents the column (it's a placeholder for each column)
							$insert = "INSERT INTO customers (firstName, lastName, email, address, city, st, country, zipCode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
							
							// Prepare
							$prep = $con -> prepare($insert);
							// Checks if the prepare was successful
							if ($con -> error) {
								echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in customers")</script>';
							} else {
								echo "<script>console.log('Prepare was successful for customers!')</script>\n";
								
								// Bind	
								// The first parameter represents the datatype of the columns parameters
								// Each character in the first parameter represents the datatype for each column (i - integer, d - double, s - string, and b - BLOB) 
								$prep -> bind_param("sssssssi", $first, $last, $mail, $ad, $cit, $ste, $cont, $zCode);	// binds all parameters to placeholders
								if ($prep -> error) {
									echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in customers")</script>';
								} else {
									echo "<script>console.log('Bind was successful for customers!')</script>\n";
								
									// Set values to parameters
									$first = $_SESSION['order'] -> getFname();
									$last = $_SESSION['order'] -> getLname();
									$mail = $_SESSION['order'] -> getEmail();
									$ad = $_SESSION['order'] -> getAddr();
									$cit = $_SESSION['order'] -> getCity();

									// Checks what value $ste should be set to
									if ($_SESSION['order'] -> getCntry() == "United States") {	// if the selected country is the 'United States'
										$ste = $_SESSION['order'] -> getState();
									} else {
										$ste = null;
									}

									$cont = $_SESSION['order'] -> getCntry();
									$zCode = $_SESSION['order'] -> getZip();
								
									// Execute
									$prep -> execute();
									// Checks if execute was successful
									if ($prep -> error) {
										echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in customers")</script>';
									} else {
										echo "<script>console.log('Execute was successful for customers!')</script>\n";
									}
								}
							}

							$prep -> close();	// closes $prep to end processing
						}

						/**
						 * Inserts data stored in the order object in the Orders Table
						 */
						function insertOrd() {
							global $con;

							$id = checkFkCustId();	// gives a value to $id
							$arrEncData = checkHash();	// gets the encrypted Credit Card Number And CVV
														
							if ($id > 0 && $arrEncData != null) {
								// Prepare
								$insert = "INSERT INTO orders (custId, creditCardNum, creditExpMon, creditExpYr, cvv, memDisc) VALUES (?, ?, ?, ?, ?, ?)";
								$prep = $con -> prepare($insert);
								// Checks if the prepare was successful
								if ($con -> error) {
									echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in orders")</script>';
								} else {
									echo "<script>console.log('Prepare was successful for orders!')</script>\n";
									
									// Bind
									$prep -> bind_param("ississ", $custId, $ccnum, $expm, $expy, $cv, $memDisc);	// binds all parameters to placeholders
									if ($prep -> error) {
										echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in orders")</script>';
									} else {
										echo "<script>console.log('Bind was successful for orders!')</script>\n";
									
										// Set values to parameters
										$custId = $id;
										$ccnum = $arrEncData[0];	
										$expm = $_SESSION['order'] -> getCcexpm();
										$expy = $_SESSION['order'] -> getCcexpy();
										$cv = $arrEncData[1];
										//Sets $memDisc to 'Y' or 'N'
										if ($_SESSION['order'] -> getMem() == "on") {
											$memDisc = "Y";
										} else {
											$memDisc = "N";
										}
									
										// Execute
										$prep -> execute();
										// Checks if execute was successful
										if ($prep -> error) {
											echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in orders");</script>';
										} else {
											echo "<script>console.log('Execute was successful for orders!');</script>\n";
										}
									} 
								}
								
								$prep -> close();	// closes $prep to end processing
							}
						}

						/*
						 * Checks if there is a customer that matches what was entered by the user (checks for a foriegn key)
						 */
						function checkFkCustId() {
							global $con;

							// SELECT statement for checking what customer ID should be checked
							$result = $con -> query("SELECT custId FROM customers WHERE email = '" . $_SESSION['order'] -> getEmail() . "' AND address = '" . $_SESSION['order'] -> getAddr() . "'");
							
							// Checks what value $custId should be set to
							if ($result -> num_rows == 1) {	// if a row was found
								$row = $result -> fetch_assoc();
								$custId = $row['custId'];
								echo "<script>console.log('Customer was found')</script>\n";
							} elseif ($result -> num_rows == 0) {
								$custId = null;	// used to represent that nothing was found
								echo "<script>console.log('Customer was not found');</script>\n";
							} else {
								$custId = null;	
								echo "<script>console.log('Customer was not specific enough to be found');</script>\n";
							}
							
							return $custId;
						}
						
						/*  
						 * Checks the hash of credit card information and memDisc column to check if an order has already been placed with the data that was entered
						 */
						function checkHash() {
							global $con;
							$found = false;
							
							if ($_SESSION['order'] -> getMem() == "on") {
								$member = "Y";
							} else {
								$member = "N";
							}
							
							// SELECT statement for checking existing hashes for credit card information and customers who are members
							$result = $con -> query("SELECT creditCardNum, cvv, memDisc FROM orders");
							if ($result -> num_rows > 0) {
								while ($rows = $result -> fetch_assoc()) {
									$rows['creditCardNum'];
									$rows['cvv'];
									$rows['memDisc'];
									if (password_verify($_SESSION['order'] -> getCcnum(), $rows['creditCardNum']) && password_verify($_SESSION['order'] -> getCvv(), $rows['cvv'])) {
										if ($member == $rows['memDisc']) {
											echo "<script>console.log('The credit card information that was entered already exists')</script>\n";
											$found = true;
											$arrHashes = null;
										}
									}
								}
								if (!$found) {
									$arrHashes = array(password_hash($_SESSION['order'] -> getCcnum(), PASSWORD_DEFAULT), password_hash($_SESSION['order'] -> getCvv(), PASSWORD_DEFAULT));
								}
							}

							return $arrHashes;
						}
						
						/*
						 * Gets the extra data needed for the Products table in the MySQL database 
						 */
						function extraProdInfo() {
							switch($_SESSION['order'] -> getItem()) {
								case "Networking Dev Kit":
									$orgCost = 19.99;
									$inStock = 9000;	// Note: The value in $inStock is the base amount that's in stock (meaning it will never change due to more being added in stock)
									$itemDisc = .03;
									break;
								case "Networking Dev Kit Pro":
									$orgCost = 29.99;
									$inStock = 500;
									$itemDisc = .10;
									break;
								case "Network Creation Center":
									$orgCost = 39.99;
									$inStock = 5000;
									$itemDisc = .15;
									break;
								case "Net Developer Tools":
									$orgCost = 49.99;
									$inStock = 200;
									$itemDisc = .20;
									break;
								case "Net Developer Tools Pro":
									$orgCost = 59.99;
									$inStock = 3000;
									$itemDisc = .35;
									break;
								case "Netware":
									$orgCost = 69.99;
									$inStock = 50000;
									$itemDisc = .45;
									break;
								case "Netsoft":
									$orgCost = 67.99;
									$inStock = 100000;
									$itemDisc = .45;
									break;
								case "Net":
									$orgCost = 99.99;
									$inStock = 10000;
									$itemDisc = .55;
									break;
								case "Social Network":
									$orgCost = 199.99;
									$inStock = 200000;
									$itemDisc = .65;
									break;
							}
							
							$arrExtraInfo = array($orgCost, $inStock, $itemDisc);
							
							return $arrExtraInfo;
						}

						/*
						 * Checks data that was entered to determine if they should be added to Products table using prepare
						 */
						function insertProd() {
							global $con, $arrProdInfo;
							$id = checkFkOrdId();	// gives a value to $id

							if ($id > 0) {
								// Prepare
								$insert = "INSERT INTO products (ordId, prodName, inStock, orgCostProd, discProd) VALUES (?, ?, ?, ?, ?)";
								$prep = $con -> prepare($insert);
								// Checks if the prepare was successful
								if ($con -> error) {
									echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in products")</script>';
								} else {
									echo "<script>console.log('Prepare was successful for products!')</script>\n";
									
									// Bind
									$prep -> bind_param("isidd", $ordId, $name, $inSt, $cost, $disc);	// binds all parameters to placeholders
									if ($prep -> error) {
										echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in products")</script>';
									} else {
										echo "<script>console.log('Bind was successful for products!')</script>\n";
									
										// Set values to parameters
										$ordId = $id;
										$name = $_SESSION['order'] -> getItem();
										$inSt = $arrProdInfo[1]; 
										$cost = $arrProdInfo[0];
										$disc = $arrProdInfo[2];
									
										// Execute
										$prep -> execute();
										// Checks if execute was successful
										if ($prep -> error) {
											echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in products");</script>';
										} else {
											echo "<script>console.log('Execute was successful for products!')</script>\n";
										}
									}
								}
								
								$prep -> close();	// closes $prep to end processing
							} 
						}

						/*
						 * Checks if a order that was entered exists (checks for a foriegn key)
						 */
						function checkFkOrdId() {
							global $con;
							$ordId = null;
							$custId = checkFkCustId();

							// Checks if the customer is a member
							if ($_SESSION['order'] -> getMem() == "on") {
								$member = "Y";
							} else {
								$member = "N";
							}
							
							if (!empty($custId)) {
								// SELECT statement for determining what order ID should be used
								$select = "SELECT ordId FROM orders NATURAL JOIN customers WHERE custId = $custId"; 
								$select .= " AND email = '" . $_SESSION['order'] -> getEmail() . "'";
								$select .= " AND address = '" . $_SESSION['order'] -> getAddr() . "'";
								$select .= " AND memDisc = '$member'";
								$result = $con -> query($select); 

								// Checks what value $ordId should be set to
								if ($result -> num_rows == 1) {	// if a row was found
									$row = $result -> fetch_assoc();
									$ordId = $row['ordId'];
									echo "<script>console.log('Order was found')</script>\n";
								} elseif ($result -> num_rows == 0) {
									$ordId = null;	// used to represent that nothing was found
									echo "<script>console.log('Order was not found')</script>\n";
								} else {
									$ordId = null;	
									echo "<script>console.log('Order was specific enough to be found')</script>\n";
								}
							} else {
								$ordId = null;
								echo "<script>console.log('Order was not found')</script>\n";
							}

							return $ordId;
						}

						/*
						 * Checks data that was entered to determine if they should be added to the ProductOrders table using prepare
						 */
						function insertProdOrd() {
							global $con;
							$id = checkFkProdId();	// gives a value to $id							

							if ($id > 0) {
								// Prepare
								$insert = "INSERT INTO productOrders (prodId, prodOrdDate, shipDate, arrivDate, quantity, prodCost, totProdDisc) VALUES (?, ?, ?, ?, ?, ?, ?)";
								$prep = $con -> prepare($insert);
								// Checks if the prepare was successful
								if ($con -> error) {
									echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in productOrders")</script>';
								} else {
									echo "<script>console.log('Prepare was successful for productOrders!');</script>\n";

									// Bind
									$prep -> bind_param("isssidd", $prodId, $ordDate, $shipDate, $arrivDate, $quan, $totPrice, $totDisc);	// binds all parameters to placeholders
									if ($prep -> error) {
										echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in productOrders")</script>';
									} else {
										echo "<script>console.log('Bind was successful for productOrders!')</script>\n";

										// Set values to parameters
										$prodId = $id;
										$ordDate= date("Y-m-d");	// set to a local date
										$shipDate = date_format(date_add(date_create(), date_interval_create_from_date_string("4 days")), "Y-m-d");		// creates a date that's 4 days from the local date
										$arrivDate = date_format(date_add(date_create(), date_interval_create_from_date_string("14 days")), "Y-m-d");	// creates a date that's 14 days from the local date
										$quan = $_SESSION['order'] -> getQtyMon();
										$totPrice = str_replace(",", "", str_replace("$", "", $_SESSION['order'] -> getCost()));	// gets rid of the '$' and ',' so cost can be added to the database
										$totDisc = $_SESSION['order'] -> getDisc() / 100;

										// Execute
										$prep -> execute();
										// Checks if execute was successful
										if ($prep -> error) {
											echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in productOrders");</script>';
										} else {
											echo "<script>console.log('Execute was successful for productOrders!')</script>\n";
										}
									}
								}

								$prep -> close();	// closes $prep to end processing
							}
						}

						/*
						 * Checks if there is a product that matches what was entered by the user (checks for a foriegn key)
						 */
						function checkFkProdId() {
							global $con;
							$ordId = checkFkOrdId();		// gives a value to $ordId
							$arrEncData = getHash();
							
							if ($ordId > 0 && !empty($arrEncData)) {
								$encCcnum = reset($arrEncData);	
								$encCvv = end($arrEncData);
								
								// SELECT statement for checking what product ID should be checked
								$result = $con -> query("SELECT prodId FROM products NATURAL JOIN orders WHERE ordId = $ordId AND creditCardNum = '$encCcnum' AND cvv = '$encCvv'");
								// Checks what value $ordId should be set to
								if ($result -> num_rows > 0) {	// if something was found
									while ($row = $result -> fetch_assoc()) {
										$prodId = $row['prodId'];	// would be set to the last value that was found
										echo "<script>console.log('Product was found!')</script>\n";
									}
								} else {
									$prodId = null;	// used to represent that nothing was found
									echo "<script>console.log('Product was not found')</script>\n";
								}
							} else {
								$prodId = null;
							}

							return $prodId;
						}
						
						/*  
						 * Gets the hash of credit card information to check if a row has already been added with the data that was entered
						 */
						function getHash() {
							global $con;
							$found = false;
							
							// SELECT statement for checking existing hashes for credit card information
							$result = $con -> query("SELECT creditCardNum, cvv FROM orders");
							if ($result -> num_rows > 0) {
								while ($rows = $result -> fetch_assoc()) {
									$rows['creditCardNum'];
									$rows['cvv'];
									if (password_verify($_SESSION['order'] -> getCcnum(), $rows['creditCardNum']) && password_verify($_SESSION['order'] -> getCvv(), $rows['cvv'])) {
										echo "<script>console.log('Credit card was found!')</script>\n";
										$found = true;
										$arrHashes = array($rows['creditCardNum'], $rows['cvv']);
									}
								}
								if (!$found) {
									$arrHashes = null;
								}
							}
							
							return $arrHashes;
						}

						/* 
						 * Gets the extra data needed for the Services table in the MySQL database 
						 */
						function extraServInfo() {							
							if ($_SESSION['order'] -> getItem() == "Safety Net") {
								if ($_SESSION['order'] -> getQtyMon() == 2) {
									$orgCost = 9.99;
									$itemDisc = .02;
								} elseif ($_SESSION['order'] -> getQtyMon() == 6) {
									$orgCost = 29.99;
									$itemDisc = .09;
								} elseif ($_SESSION['order'] -> getQtyMon() == 12) {
									$orgCost = 59.99;
									$itemDisc = .20;
								}
							} elseif ($_SESSION['order'] -> getItem() == "Network Manager") {
								if ($_SESSION['order'] -> getQtyMon() == 2) {
									$orgCost = 4.99;
									$itemDisc = 0;
								} elseif ($_SESSION['order'] -> getQtyMon() == 6) {
									$orgCost = 14.99;
									$itemDisc = .01;
								} elseif ($_SESSION['order'] -> getQtyMon() == 12) {
									$orgCost = 29.99;
									$itemDisc = .07;
								}
							} elseif ($_SESSION['order'] -> getItem() == "Network Generator") {
								if ($_SESSION['order'] -> getQtyMon() == 2) {
									$orgCost = 5.99;
									$itemDisc = 0;
								} elseif ($_SESSION['order'] -> getQtyMon() == 6) {
									$orgCost = 17.99;
									$itemDisc = .05;
								} elseif ($_SESSION['order'] -> getQtyMon() == 12) {
									$orgCost = 35.99;
									$itemDisc = .15;
								}
							}
							
							$arrExtraInfo = array($orgCost, $itemDisc);

							return $arrExtraInfo;
						}						

						/*
						 * Checks the data that was entered to determine if they should be added to Products table using prepare
						 */
						function insertServ() {
							global $con, $arrServInfo;
							$id = checkFkOrdId();	// gives a value to $id

							if ($id > 0) {
								// Prepare
								$insert = "INSERT INTO services (ordId, servName, orgCostServ, discServ) VALUES (?, ?, ?, ?)";
								$prep = $con -> prepare($insert);
								// Checks if the prepare was successful
								if ($con -> error) {
									echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in services")</script>';
								} else {
									echo "<script>console.log('Prepare was successful for services!')</script>\n";
									
									// Bind
									$prep -> bind_param("isdd", $ordId, $name, $cost, $disc);	// binds all parameters to placeholders
									if ($prep -> error) {
										echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in services")</script>';
									} else {
										echo "<script>console.log('Bind was successful for services!')</script>\n";
									
										// Set values to parameters
										$ordId = $id;
										$name = $_SESSION['order'] -> getItem();
										$cost = $arrServInfo[0];
										if ($arrServInfo[1] > 0) {
											$disc = $arrServInfo[1];
										} else {
											$disc = null;
										}
									
										// Execute
										$prep -> execute();
										// Checks if execute was successful
										if ($prep -> error) {
											echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in services");</script>';
										} else {
											echo "<script>console.log('Execute was successful for services!')</script>\n";
										}
									}
								}
								
								$prep -> close();	// closes $prep to end processing
							} 
						}

						/*
						 * Checks the data that was entered to determine if they should be added to the ProductOrders table using prepare
						 */
						function insertServOrd() {
							global $con;
							$id = checkFkServId();	// gives a value to $id							

							if ($id > 0) {
								// Prepare
								$insert = "INSERT INTO serviceOrders (servId, months, startOfServ, endOfServ, servCost, totServDisc) VALUES (?, ?, ?, ?, ?, ?)";
								$prep = $con -> prepare($insert);
								// Checks if the prepare was successful
								if ($con -> error) {
									echo '<script>console.log("Prepare error ' . $con -> errno . ' ' . $con -> error . ' in serviceOrders")</script>';
								} else {
									echo "<script>console.log('Prepare was successful for serviceOrders!');</script>\n";

									// Bind
									$prep -> bind_param("iissdd", $servId, $months, $start, $end, $totPrice, $totDisc);	// binds all parameters to placeholders
									if ($prep -> error) {
										echo '<script>console.log("Bind error ' . $prep -> errno . ' ' . $prep -> error . ' in serviceOrders")</script>';
									} else {
										echo "<script>console.log('Bind was successful for serviceOrders!')</script>\n";
									
										// Set values to parameters
										$servId = $id;
										$months = $_SESSION['order'] -> getQtyMon();
										$start = date("Y-m-d");	// set to the local date
										$end = date_format(date_add(date_create(), date_interval_create_from_date_string($_SESSION['order'] -> getQtyMon() . " months")), "Y-m-d");	// set 2, 6, or 12 months from the local date
										$totPrice = str_replace("$", "", $_SESSION['order'] -> getCost());	// gets rid of the '$' so cost can be added to the database
										$totDisc = $_SESSION['order'] -> getDisc() / 100;	// set to a percent but as a decimal

										// Execute
										$prep -> execute();
										// Checks if execute was successful
										if ($prep -> error) {
											echo '<script>console.log("Execute error ' . $prep -> errno . ' ' . $prep -> error . ' in serviceOrders");</script>';
										} else {
											echo "<script>console.log('Execute was successful for serviceOrders!')</script>\n";
										}
									}
								}

								$prep -> close();	// closes $prep to end processing
							}
						}

						/*
						 * Checks if there is a product that matches what was entered by the user (checks for a foriegn key)
						 */
						function checkFkServId() {
							global $con;
							$ordId = checkFkOrdId();	// gives a value to $ordId
							$arrEncData = getHash();

							if ($ordId > 0 && !empty($arrEncData)) {
								$encCcnum = reset($arrEncData);	
								$encCvv = end($arrEncData);

								// SELECT statement for checking what service ID should be checked
								$result = $con -> query("SELECT servId FROM services NATURAL JOIN orders WHERE ordId = $ordId AND creditCardNum = '$encCcnum' AND cvv = '$encCvv'");
								// Checks what value $ordId should be set to
								if ($result -> num_rows > 0) {	// if something was found
									while ($row = $result -> fetch_assoc()) {
										$servId = $row['servId'];	// would be set to the last value that was found
										echo "<script>console.log('Service was found')</script>\n";
									}
								} else {
									$servId = null;	// used to represent that nothing was found
									echo "<script>console.log('Service was not found')</script>\n";
								}
							} else {
								$servId = null;
								echo "<script>console.log('Service was not found')</script>\n";
							}

							return $servId;
						}
					?>
				</section>
			</div>
		</main>
		<?php include "inc_footer.php"; ?>
	</body>
</html>