/* Created by Lucas Chapman 7/13/2020 */
/* Updated by Lucas Chapman 7/24/2020 */
/* This script file is for the orders placed by users in the itemform.php file */
-- IF NOT EXISTS is used to avoid creating a database or table that already exists
/* CREATE DATABASE statement */
CREATE DATABASE IF NOT EXISTS lscdatabase;

/* CREATE TABLE statements */
-- ENGINE = innoDB specifed for older versions of MySQL (not needed if you are using MySQL 8.0 like I am)
-- AUTO_INCREMENT makes a columns primary key go up by 1 with every row thats entered if value is not already specified
-- One way to add PRIMARY KEY constraints is to write PRIMARY KEY (primaryKey) this same idea applies to CHECK constraints (i.e. CHECK (condition))
-- One way to add FOREIGN KEY constraints is to write FOREIGN KEY (foriegnKey) REFERENCES table(primaryKey)
-- UNSIGNED is used to not allow negative numbers and when create foriegn keys, you should specify the foriegn key column UNSIGNED
CREATE TABLE IF NOT EXISTS customers (		-- use to store information about the people buying the product
	custId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (custId),
	firstName VARCHAR(20) NOT NULL,
	lastName VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL UNIQUE,		
	address VARCHAR(25) NOT NULL UNIQUE,
	city VARCHAR(20) NOT NULL,	
	st VARCHAR(14),							-- represents the state that was selected by the user
	CHECK ((st IS NULL) OR (st IS NOT NULL AND country = 'United States')),	-- makes st column NOT NULL only when the country column contains the value 'United States'
	country VARCHAR(14) NOT NULL,
	zipCode MEDIUMINT NOT NULL,				-- represents the zip/postal code that was entered by the user
	CHECK (zipCode <= 99999 AND zipCode >= 10000)
) ENGINE = innoDB;

-- Note: UNIQUE constraint was not added to cvv and creditCardNum to be able to have a user's credit card be used multiple times 
CREATE TABLE IF NOT EXISTS orders (		-- stores the information about an order that had been placed
	ordId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY(ordId),
	custId INT UNSIGNED NOT NULL,
	FOREIGN KEY (custId) REFERENCES customers(custId),
	creditCardNum VARCHAR(60) NOT NULL,	-- represents the credit card number that was entered by the user that was entered which will be encrytpted before being added to the table
	creditExpMon VARCHAR(9) NOT NULL,	-- represents the credit card expiration month that was selected by the user
	creditExpYr YEAR NOT NULL,			-- represents the credit card expiration year that was entered by the user (uses YEAR datatype which is 4-digits long by default)
	cvv VARCHAR(60) NOT NULL,			-- represents the user's CVV on their credit card (values in this column will also be encrytpted before being added to the table)
	memDisc CHAR(1) DEFAULT 'N',		-- represents the value in the 'Are you a member?' checkbox
	CHECK (memDisc = 'Y' OR memDisc = 'N')
) ENGINE = innoDB;

CREATE TABLE IF NOT EXISTS products (	-- used to store information about the products that the company offers and who ordered it
	prodId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (prodId),
	ordId INT UNSIGNED NOT NULL,
	FOREIGN KEY (ordId) REFERENCES orders(ordId),
	prodName VARCHAR(23) NOT NULL,		-- represents the product that the user selected
	inStock INT NOT NULL,				-- represents how much of a product was in stock before more were purchased
	orgCostProd DEC(5,2) NOT NULL,		-- represents the orginal cost for a product
	discProd DEC(2,2)					-- represents the discount the product has
) ENGINE = innoDB;

CREATE TABLE IF NOT EXISTS services (	-- used to store information about the services that the company sells and who ordered it
	servId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (servId),
	ordId INT UNSIGNED NOT NULL,
	FOREIGN KEY (ordId) REFERENCES orders(ordId),
	servName VARCHAR(17) NOT NULL,		-- represents the service that the user selected
	orgCostServ DEC(4,2) NOT NULL,		-- represents the orginal cost for a service
	discServ DEC(2,2)					-- represents the discount the service has
) ENGINE = innoDB;

/* No shipping fees are included for products */
CREATE TABLE IF NOT EXISTS productOrders (	-- used to store information about the orders placed on products
	prodOrdId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (prodOrdId),
	prodId INT UNSIGNED NOT NULL,
	FOREIGN KEY (prodId) REFERENCES products(prodId),
	prodOrdDate DATE NOT NULL,
	shipDate DATE,							-- the date the order is shipped
	arrivDate DATE,							-- the date the order arrives to a customer
	quantity SMALLINT NOT NULL,				-- represents the quantity that the user selected
	CHECK (quantity <= 999 AND quantity >= 1),
	prodCost DEC(7,2) NOT NULL,				-- represents the price of a order with quantity and discounts being included
	CHECK (prodCost > 0),
	totProdDisc DEC(2,2)					-- represents the total discount on the order
) ENGINE = innoDB;

CREATE TABLE IF NOT EXISTS serviceOrders (	-- used to store information about the orders placed on services
	servOrdId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (servOrdId),
	servId INT UNSIGNED NOT NULL,
	FOREIGN KEY (servId) REFERENCES services(servId),
	months SMALLINT NOT NULL,				-- represents the duration of service (in months) that the user selected
	CHECK (months = 2 OR months = 6 OR months = 12),
	startOfServ DATE NOT NULL,				-- represents the start of service (starts immediately after being ordered)
	endOfServ DATE NOT NULL,				-- represents the end of service
	CHECK (TIMESTAMPDIFF(MONTH, startOfServ, endOfServ) = months),	-- the TIMESTAMPDIFF() can be used to exact months between dates
	servCost DEC(4,2) NOT NULL,				-- represents the cost of a order with discounts being included
	CHECK (servCost > 0),
	totServDisc DEC(2,2)					-- represents the total discount on the order
) ENGINE = innoDB;