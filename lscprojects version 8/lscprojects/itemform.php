<!-- Created by Lucas Chapman 6/25/2020 -->
<!-- Updated 7/16/2020 by Lucas Chapman -->
<!-- This PHP webpage demonstrates forms and form handling, as well as superglobal variables -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Order Form</title>
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
				<section class="sect-2">
					<!-- Order Section -->
					<?php
						/* Form Handler Code */
						$showForm = true;	// used to display the form again 
						$errCtr = 0;		// used to keep track of errors
						$fname = "";		// represents the firstname sent to the form handler
						$lname = "";		// represents the lastname sent to the form handler
						$email = "";		// represents the email sent to the form handler
						$addr = "";			// represents the address sent to the form handler
						$city = "";			// represents the city sent to the form handler
						$st = "";			// represents the state sent to the form handler
						$ctry = "";			// represents the country sent to the form handler
						$zip = "";			// represents the zip code sent to the form handler
						$crednum = "";		// represents the creditcard number sent to the form handler
						$credexpm = "";		// represents the expiration month sent to the form handler
						$credexpy = "";		// represents the expiration year sent to the form handler		
						$cvv = "";			// represents the CVV sent to the form handler
						$prods = "";		// represents the selected product sent to the form handler
						$qty = "";			// represents the selected quantity sent to the form handler
						$servs = "";		// represents the selected service sent to the form handler
						$mons = "";			// represents the selected months of service sent to the form handler
						
						// Sets the value of item
						if (isset($_POST['item'])) {	// if form had been posted
							$item = $_POST['item'];
						} else {
							$item = "prod";	// default value
						}
						
						// Sets the value of item
						if (isset($_POST['mem'])) {	// if form had been posted
							$mem = $_POST['mem'];
						} else {
							$mem = "";	// default value
						}
						
						// Sets the value of cost
						if (isset($_POST['cost'])) {	// if form had been posted
							$cost = $_POST['cost'];
						} else {
							$cost = "$0.00";	// default value
						}
						
						// Checks if the form was posted and performs validation, as well as display valid data back to the user
						if (isset($_POST['purchase'])) {
							$fname = validFname($_POST['fname']);
							$lname = validLname($_POST['lname']);
							$email = validEmail($_POST['email']);
							$addr = validAddr($_POST['addr']);
							$city = validCity($_POST['city']);
							$ctry = validCtry($_POST['ctry']);
							
							// Checks if validation for state should occur
							if (!empty($ctry) && $ctry == "United States") {
								$st = validSt($_POST['st']);
							}
							
							$zip = validZip($_POST['zip']);
							$crednum = validCrednum($_POST['crednum']);
							$credexpy = validCredexpy($_POST['credexpy']);
							$credexpm = validCredexpm($_POST['credexpm']);
							$cvv = validCvv($_POST['cvv']);
							
							// Checks which Item Type radio button was selected
							if($item == "prod") {	// if the 'prod' radio button was selected
								$prods = validProds($_POST['prods']);
								$qty = validQty((int) $_POST['qty']);
							} else if($item == "serv") {	// if the 'serv' radio button was selected
								$servs = validServs($_POST['servs']);
								$mons = validMons((int) $_POST['mons']);
							}
							
							// Checks if any errors were found
							if ($errCtr > 0) {
								$showForm = true;	// forces form to be displayed
							} else {
								$showForm = false;
								$disc = displayDisc();
								
								/* Styles added via the <script> tag */
								echo "<script>\n";
								echo "document.getElementById('container').style.display = 'block';\n";
								echo "document.getElementById('container').style.textAlign = 'center';\n";
								echo "document.getElementsByClassName('sect-2')[0].style.backgroundColor = '#286e85';\n";
								echo "document.getElementsByClassName('sect-2')[0].style.color = '#fff';\n";
								echo "</script>\n";
								
								/* Messages */
								echo "<p>Thank you $fname $lname, your purchase has been sent</p>\n";
								echo "<p>Email: $email</p>\n";
								
								// Checks it state should be shown
								if ($ctry == "United States") {
									echo "<p>Address: $addr, $city, $st, $ctry $zip</p>\n";
								} else {
									echo "<p>Address: $addr, $city, $ctry $zip</p>\n";
								}
								
								echo "<p>Credit Card Number: $crednum</p>\n";
								echo "<p>Credit Card Exp Date: $credexpm $credexpy</p>\n";
								echo "<p>CVV: $cvv</p>\n";
								
								// Checks if which Item Type radio button was selected
								if ($item == "serv") {
									echo "<p>Selected: Service</p>\n";
									echo "<p>Service Purchased: $servs</p>\n";
									echo "<p>Months: $mons</p>\n";
								} else if ($item == "prod") {
									echo "<p>Selected: Product</p>\n";
									echo "<p>Product Purchased: $prods</p>\n";
									echo "<p>Quantity: $qty</p>\n";
								}
								
								// Checks if the Membership checkbox was checked
								if ($mem == "on") {
									echo "<p>Member: Yes</p>\n";
								} else {
									echo "<p>Member: No</p>\n";
								}
								
								echo "<p>Cost: $cost</p>\n";
								echo "<p>Discount: $disc%</p>\n";
								echo "<p>$fname $lname " . time() . "</p>";
							}
							
							// Used to get the extra information need for tables in the MySQL database lscdatabase (more will be added in later assignments)
							if ($item == "prod") {
								$arrProdInfo = extraProdInfo();
							} else if ($item == "serv") {
								$arrServInfo = extraServInfo();
							}
						}

						/*
						 * Checks if the first name sent to the form handler is valid or not
						 */
						function validFname(String $fname) {
							global $errCtr;
							
							if (empty($fname)) {
								echo "<script>alert('Nothing was entered for firstname');</script>";
								$errCtr++;
							} else if (is_numeric($fname)) {
								echo "<script>alert('$fname is invalid, firstname should not contain numbers');</script>";
								$fname = "";
								$errCtr++;
							}
							
							return $fname;
						}
						
						/*
						 * Checks if the last name sent to the form handler is valid or not
						 */
						function validLname(String $lname) {
							global $errCtr;
							
							if (empty($lname)) {
								echo "<script>alert('Nothing was entered for lastname');</script>";
								$errCtr++;
							} else if (is_numeric($lname)) {
								echo "<script>alert('$lname is invalid, lastname should not contain numbers');</script>";
								$lname = "";
								$errCtr++;
							}
							
							return $lname;
						}
						
						/*
						 * Checks if the email sent to the form handler is valid or not
						 */
						function validEmail(String $email) {
							global $errCtr;
							
							if (empty($email)) {
								echo "<script>alert('Nothing was entered for email');</script>";
								$errCtr++;
							} elseif (!preg_match("/^([\S]{1,}[@][\w]{4,}[\.][a-z]{2,4})$/", $email)) {	// checks if email does or does not contain an @ symbol
								echo "<script>alert('$email is invalid, email should look something like this: example@gmail.com');</script>";
								$email = "";
								$errCtr++;
							}

							return $email;
						}
						
						/*
						 * Checks if the address sent to the form handler is valid or not
						 */
						function validAddr(String $ad) {
							global $errCtr;
							
							if (empty($ad)) {
								echo "<script>alert('Nothing was entered for address');</script>";
								$errCtr++;
							} elseif (!preg_match ("/^([\d]{1,3}[\s][A-Z|a-z|\d](([\d|\s|A-Z|a-z])?){1,})$/", $ad)) {
								echo "<script>alert('$ad is invalid, address should look something like this: 123 West Avenue');</script>";
								$ad = "";
								$errCtr++;
							}
							
							return $ad;
						}
						
						/*
						 * Checks if the city sent to the form handler is valid or not
						 */
						function validCity(String $cty) {
							global $errCtr;
							
							if (empty($cty)) {
								echo "<script>alert('Nothing was entered for city');</script>";
								$errCtr++;
							} else if (is_numeric($cty)) {
								echo "<script>alert('$cty is invalid, city should not contain numbers');</script>";
								$cty = "";
								$errCtr++;
							}
							
							return $cty;
						}
						
						/*
						 * Checks if the country sent to the form handler is valid or not
						 */
						function validCtry(String $ctry) {
							global $errCtr;
							
							if (empty($ctry)) {
								echo "<script>alert('No country was selected');</script>";
								$errCtr++;
							} 
							
							return $ctry;
						}
						
						/*
						 * Checks if the state sent to the form handler is valid or not
						 */
						function validSt(String $st) {
							global $errCtr;
														
							if (empty($st)) {
								echo "<script>alert('No state was selected');</script>";
								$errCtr++;
							} 
							
							return $st;
						}
						
						/*
						 * Checks if the zip code sent to the form handler is valid or not
						 */
						function validZip(String $zip) {
							global $errCtr;
							
							if (!empty($zip)) {
								if (ctype_digit($zip)) {
									if (strlen($zip) < 10) {	// the max length an int can be
										if ((int) $zip < 10000) {
											echo "<script>alert('$zip is invalid, a zip code should not be less than 10000');</script>";
											$zip = "";
											$errCtr++;
										} else if ((int) $zip > 99999) {
											echo "<script>alert('$zip is invalid, a zip code should not be greater than 99999');</script>";
											$zip = "";
											$errCtr++;
										}
									} else {
										echo "<script>alert('$zip is invalid, zip code is to long');</script>";
										$zip = "";
										$errCtr++;
									}
								} else {
									echo "<script>alert('$zip is invalid, a zip code should be numeric with no decimals');</script>";
									$zip = "";
									$errCtr++;
								}
							} else {
								echo "<script>alert('No zip code was entered');</script>";
								$errCtr++;
							}
							
							return $zip;
						}							
						
						/*
						 * Checks if the credit card number sent to the form handler is valid or not
						 */
						function validCrednum(String $ccnum) {
							global $errCtr;
							$for = preg_match("/([\d{3,6}][-][\d{4,5}][-][\d{4,5}])*?([-][\d{4,5}])/", $ccnum);
							
							if (empty($ccnum)) {
								echo "<script>alert('Nothing was entered for credit card number');</script>";
								$errCtr++;
							} else if (strlen($ccnum) < 16 || strlen($ccnum) > 22) {
								echo "<script>alert('Invalid length, credit card number $ccnum should be 16 to 22 characters long');</script>";
								$ccnum = "";
								$errCtr++;
							} 
							
							if (!($for || empty($ccnum))) {
								echo "<script>alert('Invalid format, credit card number $ccnum should look something like this: 1111-11111-11111-11111');</script>";
								$ccnum = "";
								$errCtr++;
							}
							
							return $ccnum;
						}
						
						/*
						 * Checks if the credit card expiration year sent to the form handler is valid or not
						 */
						function validCredexpy(String $expy) {
							global $errCtr;
							$currYear = date("Y");	// the current year
							
							if (!empty($expy)) {
								if (ctype_digit($expy)) {
									if (strlen($expy) < 10) {
										if ((int) $expy < (int) $currYear) {
											echo "<script>alert('Expiration year $expy should not be less than the current year');</script>";
											$expy = "";
											$errCtr++;
										} elseif ((int) $expy > 9999) {	
											echo "<script>alert('$expy should not be greater than the expiration year 9999');</script>";
											$expy = "";
											$errCtr++;
										}
									} else {
										echo "<script>alert('$expy is invalid, credit card expiration year is to long');</script>";
										$expy = "";
										$errCtr++;
									}
								} else {
									echo "<script>alert('$expy is invalid, credit card expiration year must be numeric with no decimals');</script>";
									$expy = "";
									$errCtr++;
								}
							} else {
								echo "<script>alert('No credit card expiration year was entered');</script>";
								$errCtr++;
							}
							
							return $expy;
						}
						
						/*
						 * Checks if the credit card expiration month sent to the form handler is valid or not
						 */
						function validCredexpm(String $expm) {
							global $expy, $errCtr;	
							$currMon = date("n");	// the current month
							$currYear = date("Y");	// the current year
							
							if (empty($expy)) {
								$expy = $_REQUEST['credexpy'];	// will always get the posted credexpy
							}
							
							if (empty($expm)) {
								echo "<script>alert('No credit card expiration month was selected');</script>";
								$errCtr++;
							} else {
								switch($expm) {
									case "January":
										$monNum = 1;
										break;
									case "February":
										$monNum = 2;
										break;
									case "March":
										$monNum = 3;
										break;
									case "April":
										$monNum = 4;
										break;
									case "May":
										$monNum = 5;
										break;
									case "June":
										$monNum = 6;
										break;
									case "July":
										$monNum = 7;
										break;
									case "August":
										$monNum = 8;
										break;
									case "September":
										$monNum = 9;
										break;
									case "October":
										$monNum = 10;
										break;
									case "November":
										$monNum = 11;
										break;
									case "December":
										$monNum = 12;
										break;
								}
								
								if ($currMon > $monNum && $currYear >= $expy) {
									echo "<script>alert('Error, $expm should not be less than the current month if the sected year is $expy');</script>";
									$expm = "";
									$errCtr++;
								}
							}
							
							return $expm;
						}
						
						/*
						 * Checks if the CVV sent to the form handler is valid or not
						 */
						function validCvv(String $cvv) {
							global $errCtr;
							
							if (!empty($cvv)) {
								if (ctype_digit($cvv)) {
									if (strlen($cvv) < 10) {	// 10 would be the max length an int could be
										if ((int) $cvv < 100) {
											echo "<script>alert('$cvv is invalid, CVV should not be less than 100');</script>";
											$cvv = "";
											$errCtr++;
										} elseif ((int) $cvv > 9999) {
											echo "<script>alert('$cvv is invalid, CVV should not be greater than 9999');</script>";
											$cvv = "";
											$errCtr++;
										}
									} else {
										echo "<script>alert('$cvv is invalid, CVV is to long');</script>";
										$cvv = "";
										$errCtr++;
									}
								} else {
									echo "<script>alert('$cvv is invalid, CVV must be numeric with no decimals');</script>";
									$cvv = "";
									$errCtr++;
								}
							} else {
								echo "<script>alert('No CVV was entered');</script>";
								$errCtr++;
							}
							
							return $cvv;
						}
												
						/*
						 * Checks if the product sent to the form handler is valid or not
						 */
						function validProds(String $prod) {
							global $errCtr;
							
							if (empty($prod)) {
								echo "<script>alert('No product was selected');</script>";
								$errCtr++;
							}
							
							return $prod;
						}
						
						/*
						 * Checks if the quantity sent to the form handler is valid or not
						 */
						function validQty(int $qty) {
							global $errCtr, $prods, $cost;	
							$maxQty = 999; 	// default value
							
							if ($prods == "Networking Dev Kit Pro") {
								$maxQty = 500;
							} elseif ($prods == "Net Developer Tools") {
								$maxQty = 200;
							}
							
							if ($qty > $maxQty) {
								echo "<script>alert('$qty is invalid, the selected quantity is more than the $maxQty we have on stock for this product');</script>";
								$errCtr++;
								$qty = "";
								$cost = "$0.00";
							} elseif ($qty == 0) {
								echo "<script>alert('$qty is invalid, the selected quantity should be between 1 and $maxQty');</script>";
								$errCtr++;
							}
							
							return $qty;
						}
						
						/*
						 * Checks if the service sent to the form handler is valid or not
						 */
						function validServs(String $serv) {
							global $errCtr;
							
							if (empty($serv)) {
								echo "<script>alert('No service was selected');</script>";
								$errCtr++;
							}
							
							return $serv;
						}
						
						/*
						 * Checks if the months of service sent to the form handler is valid or not
						 */
						function validMons(int $mons) {
							global $errCtr, $cost;
							
							if ($mons == 0) {
								echo "<script>alert('$mons is invalid, the selected months of service should be either 2, 6, or 12');</script>";
								$errCtr++;
							}
							
							return $mons;
						}
						
						/* 
						 * Finds the total discount for the product/service when an order is purchased 
						 */
						function  displayDisc() {
							global $prods, $servs, $mons, $item, $mem;
							$disc = 0;

							// Checks what the total discount would be
							// 10% and 20% discounts applies for all customers 
							if ($item == "prod") {							
								switch($prods) {
									case "Networking Dev Kit":
										$disc = (.03 + .10 + .20) * 100;
										break;
									case "Networking Dev Kit Pro":
										$disc = (.10 + .10 + .20) * 100;
										break;
									case "Network Creation Center":
										$disc = (.15 + .10 + .20) * 100;
										break;
									case "Net Developer Tools":
										$disc = (.20 + .10 + .20) * 100;
										break;
									case "Net Developer Tools Pro":
										$disc = (.35 + .10 + .20) * 100;
										break;
									case "Netware":
										$disc = (.45 + .10 + .20) * 100;
										break;
									case "Netsoft":
										$disc = (.45 + .10 + .20) * 100;
										break;
									case "Net":
										$disc = (.55 + .10 + .20) * 100;
										break;
									case "Social Network":
										$disc = (.65 + .10 + .20) * 100;
										break;
								}
							} elseif ($item == "serv") {
								if ($servs == "Safety Net") {
									if ($mons == "2") {
										$disc = (.02 + .10 + .20) * 100;
									} elseif ($mons == "6") {
										$disc = (.09 + .10 + .20) * 100;
									} elseif ($mons == "12") {
										$disc = (.20 + .10 + .20) * 100;
									}
								} elseif ($servs == "Network Manager") {
									if ($mons == "2") {
										$disc = (0 + .10 + .20) * 100;
									} elseif ($mons == "6") {
										$disc = (.01 + .10 + .20) * 100;
									} elseif ($mons == "12") {
										$disc = (.07 + .10 + .20) * 100;
									}
								} elseif ($servs == "Network Generator") {
									if ($mons == "2") {
										$disc = (0 + .10 + .20) * 100;
									} elseif ($mons == "6") {
										$disc = (.05 + .10 + .20) * 100;
									} elseif ($mons == "12") {
										$disc = (.15 + .10 + .20) * 100;
									}
								}
							}
							
							// Checks if the Membership discount should apply or not
							if ($mem == "on") {	// if Membership checkbox was checked
								$disc += 3;	// 3% discount for being a member
							}
							
							return $disc;
						}
						
						/*
						 * Gets the extra data needed for the Products table in the MySQL database 
						 */
						function extraProdInfo() {
							global $prods;
							
							switch($prods) {
								case "Networking Dev Kit":
									$orgCost = 19.99;
									$inStock = 9000;
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
						
						/* Gets the extra data needed for the Services table in the MySQL database  */
						function extraServInfo() {
							global $servs, $mons;
							
							if ($servs == "Safety Net") {
								if ($mons == 2) {
									$orgCost = 9.99;
									$itemDisc = .02;
								} elseif ($mons == 6) {
									$orgCost = 29.99;
									$itemDisc = .09;
								} elseif ($mons == 12) {
									$orgCost = 59.99;
									$itemDisc = .20;
								}
							} elseif ($servs == "Network Manager") {
								if ($mons == 2) {
									$orgCost = 4.99;
									$itemDisc = 0;
								} elseif ($mons == 6) {
									$orgCost = 14.99;
									$itemDisc = .01;
								} elseif ($mons == 12) {
									$orgCost = 29.99;
									$itemDisc = .07;
								}
							} elseif ($servs == "Network Generator") {
								if ($mons == 2) {
									$orgCost = 5.99;
									$itemDisc = 0;
								} elseif ($mons == 6) {
									$orgCost = 17.99;
									$itemDisc = .05;
								} elseif ($mons == 12) {
									$orgCost = 35.99;
									$itemDisc = .15;
								}
							}
							
							$arrExtraInfo = array($orgCost, $itemDisc);
							
							return $arrExtraInfo;
						}
						
						if ($showForm) {
					?>
					<form name="order" method="post" action="<?php echo $_SERVER['PHP_SELF']; // links to it's self?>">
						<div class="row">
							<div class="col-50">
								<label class="special"><b>Billing Information</b></label>

								<div class="row">
									<div class="col-50">
										<label for="fname">First Name</label>
										<input type="text" name="fname" value="<?php echo $fname; ?>">
									</div>
												
									<div class="col-50">				
										<label for="lname">Last Name</label>
										<input type="text" name="lname" value="<?php echo $lname; ?>">
									</div>
									<div class="col-75">										
										<label for="email">Email</label>
										<input type="text" name="email" value="<?php echo $email; ?>">
									</div>
									
									<div class="col-50">
										<label for="addr">Address</label>
										<input type="text" name="addr" value="<?php echo $addr; ?>">
									</div>

									<div class="col-50">
										<label for="city">City</label>
										<input type="text" name="city" value="<?php echo $city; ?>">
									</div>
		 												
									<div class="col-25">
										<label for="st">State</label>
										<select id="st" name="st" <?php echo $ctry == "United States" ? "" : " disabled"; // checks if the dropdown menu should be disabled after the form has been posted ?>>
											<option value=""></option>
											<!-- PHP generated code -->
											<?php
												/* Used to simplify code */
												/* Prints all the options for st */
												$valSts = array("Alabama", 
																"Alaska", 
																"Arizona", 
																"Arkansas", 
																"California", 
																"Colorado",
																"Connecticut",
																"Delaware",
																"Florida",
																"Georgia",
																"Hawaii",
																"Idaho",
																"Illinois",
																"Indiana",
																"Iowa",
																"Kansas",
																"Louisiana",
																"Maine",
																"Maryland",
																"Massachusetts",
																"Michigan",
																"Minnesota",
																"Mississippi",
																"Missouri",
																"Montana",
																"Nebraska",
																"Nevada",
																"New Hampshire",
																"New Jersey",
																"New Mexico",
																"New York",
																"North Carolina",
																"North Dakota",
																"Ohio",
																"Oklahoma",
																"Pennsylvania",
																"Rhode Island",
																"South Carolina",
																"South Dakota",
																"Tennessee",
																"Utah",
																"Vermont",
																"Virginia",
																"Washington",
																"West Virginia",
																"Wisconsin",
																"Wyoming"
															   );
																
												for ($i = 0; $i < count($valSts); $i++) {
													$isSelected = $st == $valSts[$i] ? " selected" : "";	// checks if any option in the array was selected when posted
													echo "<option value='$valSts[$i]' $isSelected>$valSts[$i]</option>\n";
												}
											?>
										</select>
									</div>
											
									<div class="col-25">
										<label for="ctry">Country</label>
										<select id="ctry" name="ctry">
											<option value=""></option>
											<!-- PHP generated code -->
											<?php
												/* Used to simplify code */
												/* Prints all the options for ctrys */
												$valCtrys = array("Africa",
																  "Antarctica",
																  "Argentina",
																  "Austrila",
																  "Belgium",
																  "Boliva",
																  "Brazil",
																  "Canada",
																  "Chile",
																  "China",
																  "Colombia",
																  "Denmark",
																  "Egypt",
																  "Finland",
																  "France",
																  "Germany",
																  "Greenland",
																  "Iceland",
																  "Iran",
																  "Iraq",
																  "Ireland",
																  "Italy",
																  "Japan",
																  "Netherlands",
																  "New Zeland",
																  "North Korea",
																  "Norway",
																  "Puerto Rico",
																  "Russia",
																  "Singapore",
																  "South Korea",
																  "Spain",
																  "Sweden",
																  "Switzerland",
																  "Syria",
																  "Taiwan",
																  "United Kingdom",
																  "United States",
																  "Venezuela"
																 );
													
												for ($i = 0; $i < count($valCtrys); $i++) {
													$isSelected = $ctry == $valCtrys[$i] ? " selected" : "";	// checks if any option in the array was selected when posted
													echo "<option value='$valCtrys[$i]' $isSelected>$valCtrys[$i]</option>\n";
												}
											?>
										</select>
									</div>
														
									<div class="col-25">
										<label for="zip">Zip/Postal Code</label>
										<input type="text" name="zip" value="<?php echo $zip; ?>">
									</div>
													
									<div class="col-50">
										<label class="special"><b>Payment Information</b></label>

										<label for="crednum">Credit Card Number</label>
										<input type="text" name="crednum" value="<?php echo $crednum; ?>">
												
										<div class="row">
											<div class="col-25">
												<label for="credexpm">Exp Month</label>
												<select id="credexpm" name="credexpm">
													<option value=""></option>
													<!-- PHP generated code -->
													<?php
														/* Used to simplify code */
														/* Prints all the options for credexpm */
														$valExpMons = array("January",
																			"February",
																			"March",
																			"April",
																			"May",
																			"June",
																			"July",
																			"August",
																			"September",
																			"October",
																			"November",
																			"December"
																		   );
														
														for ($i = 0; $i < count($valExpMons); $i++) {
															$isSelected = $credexpm == $valExpMons[$i] ? " selected" : "";	// checks if any option in the array was selected when posted
															echo "<option value='$valExpMons[$i]' $isSelected>$valExpMons[$i]</option>\n";	// checks if any option in the array was selected when posted
														}
													?>
												</select>
											</div>
													
											<div class="col-25">
												<label for="credexpy">Exp Year</label>
												<input type="text" name="credexpy" value="<?php echo $credexpy; ?>">
											</div>
										
											<div class="col-25">
												<label for="cvv">CVV</label>
												<input type="text" name="cvv" value="<?php echo $cvv; ?>">
											</div>
										</div>

										<div id="product" class="row  <?php echo $item == "serv" ? " hidden" : "";	// checks if hidden class should be added ?>">
											<div class="col-50">
												<label for="prods" onchange="setMaxQty();">Product</label>
												<select id="prods" name="prods">
													<option value=""></option>
													<!-- PHP generated code -->
													<?php
														/* Used for simplify code */
														/* Prints all the other options for prods */
														$valProds = array("Networking Dev Kit",  
																		  "Networking Dev Kit Pro", 
																		  "Network Creation Center", 
																		  "Net Developer Tools", 
																		  "Net Developer Tools Pro", 
																		  "Netware", 
																		  "Netsoft",
																		  "Net",
																		  "Social Network"
																		 );

														for($i = 0; $i < count($valProds); $i++) {
															$isSelected = $prods == $valProds[$i] ? " selected" : "";	// checks if any option in the array was selected when posted
															echo "<option value='$valProds[$i]' $isSelected>$valProds[$i]</option>\n";
														}
													?>
												</select>
											</div>
													
											<div class="col-25">										
												<label for="qty">Quantity</label>
												<select id="qty" name="qty">
													<option value="0">0</option>
													<!-- PHP generated code -->
													<?php
														/* Use to simplify code */
														/* Prints options 1 to 999 */
														for ($valQty = 1; $valQty <= 999; $valQty++) {
															$isSelected = $qty == $valQty ? " selected" : "";	// checks if any option in the array was selected when posted
															echo "<option value='$valQty' $isSelected>$valQty</option>\n";
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
													<option value="0">0</option>
													<option value="2" <?php echo $mons == "2" ? " selected" : ""; // checks if the option was selected ?>>2</option>
													<option value="6" <?php echo $mons == "6" ? " selected" : ""; // checks if the option was selected ?>>6</option>
													<option value="12" <?php echo $mons == "12" ? " selected" : ""; // checks if the option was selected ?>>12</option>
												</select>
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
												
											<div class="col-25">
												<label><input id="member" type="checkbox" name="mem" value="on" <?php echo $mem == "on" ? " checked" : "";	// checks if the checkbox was checked ?>> Are you a member?</label><br><br>
											</div>
										</div>

										<!-- Changes when items and amounts are selected -->
										<!-- readonly is used to prevent users from editing the amount -->
										<label for="cost">Cost</label>
										<input id="cost" name="cost" type="text" value="<?php echo $cost; ?>" readonly>
										<input type="submit" title="Purchase" name="purchase" value="Purchase">
											
										<!-- The script for the form and it also contains the time() fix -->
										<script src="js/form.js?<?php echo time(); ?>"></script>
									</div>
								</div>
							</div>
						</div>
					</form>
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
				<?php
					}	// end curly brace
				?>
			</div>
		</main>
		<?php include "inc_footer.php"; ?>
	</body>
</html>