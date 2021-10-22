// JavaScript source code
const product = document.getElementById("product"); // the Products section
const service = document.getElementById("service"); // the Services section
const prods = document.getElementById("prods"); // the Product dropdown menu
const qty = document.getElementById("qty"); // the Quantity dropdown menu
const servs = document.getElementById("servs"); // the Service dropdown menu
const mons = document.getElementById("mons"); // The Months dropdown menu
const prod = document.getElementById("prod"); // the Product radio button
const serv = document.getElementById("serv");   // the Service radio button
const member = document.getElementById("member");   // the Member checkbox
const cost = document.getElementById("cost");   // the Cost field

/**
 * Checks which country was selected to determine if the State dropdown menu should be enabled 
 */
function ctrySelected() {
    const ctry = document.getElementById("ctry");   // the select tag of the Country dropdown menu
    const st = document.getElementById("st");   // the select tag of the State dropdown menu
    const selectedCtry = ctry.options[ctry.selectedIndex].text; // any of the option tags in the country dropdown menu
    
    if (selectedCtry == "United States") {  // if the 'United States' was selected in the Country dropdown menu
        st.disabled = false;    // enables the State dropdown menu
    } else {
        st.disabled = true; // disables the State dropdown menu
    }
}
document.getElementById("ctry").addEventListener("change", ctrySelected);
document.getElementById("ctry").addEventListener("load", ctrySelected);

/**
 * Displays either the Product prompts or Service prompts depending on which radiobutton was selected
 */ 
function selected() {
    const prodKeepAmt = prods.options[prods.selectedIndex].text != "";
    const servKeepAmt = servs.options[servs.selectedIndex].text != "";

    if (prod.checked == true) {
        product.classList.remove("hidden");
        service.classList.add("hidden");

        // Checks if previous amount should be kept if any
        if (prodKeepAmt) {  // represents when previous amounts should be kept
            prodPrice();    // finds the previous amount 
        } else {
            cost.value = "$0.00";
        }
    } else if (serv.checked == true) {
        service.classList.remove("hidden");
        product.classList.add("hidden");

        // Checks if previous amount should be kept if any
        if (servKeepAmt) {  // represents when previous amounts should be kept
            servPrice();
        } else {
            cost.value = "$0.00";
        }
    }
}
prod.addEventListener("change", selected);
serv.addEventListener("change", selected);

/**
 * Calculates the price for the Products section
 */
function prodPrice() {
    var orgCost = 0;    //
    var price = 0;  //
    var discount = 0;   //
    var discountAmt = 0;    
    var num = 0;    // the result before formatting takes place
    const selectedProd = prods.options[prods.selectedIndex].value;
    const selectedQty = parseInt(qty.options[qty.selectedIndex].value);

    // Looks for which product (if any) was selected
    switch (selectedProd) {
        case "Networking Dev Kit":
            price = 19.99;  // represents the original price of the product
            discount = .03 + .10 + .20;  // the first discount listed in this calculation is only for that product
            break;
        case "Networking Dev Kit Pro":
            price = 29.99;
            discount = .10 + .10 + .20;
            break;
        case "Network Creation Center":
            price = 39.99;
            discount = .15 + .10 + .20;
            break;
        case "Net Developer Tools":
            price = 49.99;
            discount = .20 + .10 + .20;
            break;
        case "Net Developer Tools Pro":
            price = 59.99;
            discount = .35 + .10 + .20;
            break;
        case "Netware":
            price = 69.99;
            discount = .45 + .10 + .20;
            break;
        case "Netsoft":
            price = 67.99;
            discount = .45 + .10 + .20;
            break;
        case "Net":
            price = 99.99;
            discount = .55 + .10 + .20;
            break;
        case "Social Network":
            price = 199.99;
            discount = .65 + .10 + .20;
            break;
    }

    // Checks if a membership discount should apply based on if the membership checkbox was checked
    if (member.checked == true) {
        discount += .03;
    }

    if (prod.checked == true) {
        orgCost = (price * selectedQty).toFixed(2); // rounds two decimal places
        discountAmt = (orgCost * discount).toFixed(2);
        num = (orgCost - discountAmt).toFixed(2);
        cost.value = "$" + thousands_separators(num);   // applies the formating to the result
    }
}
prods.addEventListener("change", prodPrice);
qty.addEventListener("change", prodPrice);

/**
 * Calculates the price of the Service section
 */
function servPrice() {
    var price = 0;
    var discount = 0;
    var discountAmt = 0;
    const selectedServ = servs.options[servs.selectedIndex].value;
    const selectedMon = parseInt(mons.options[mons.selectedIndex].value);

    // Checks which service was selected and how many months were selected
    if (selectedServ == "Safety Net") {
        if (selectedMon == 2) {
            price = 9.99;   // represents the original price of the service
            discount = .02 + .10 + .20; // the first discount listed in this calculation is only for that specific service and length(in months)
        } else if (selectedMon == 6) {
            price = 29.99;
            discount = .09 + .10 + .20;
        } else if (selectedMon == 12) {
            price = 59.99;
            discount = .20 + .10 + .20;
        }
    } else if (selectedServ == "Network Manager") {
        if (selectedMon == 2) {
            price = 4.99;
            discount = 0 + .10 + .20;
        } else if (selectedMon == 6) {
            price = 14.99;
            discount = .01 + .10 + .20;
        } else if (selectedMon == 12) {
            price = 29.99;
            discount = .07 + .10 + .20;
        }
    } else if (selectedServ == "Network Generator") {
        if (selectedMon == 2) {
            price = 5.99;
            discount = 0 + .10 + .20;
        } else if (selectedMon == 6) {
            price = 17.99;
            discount = .05 + .10 + .20;
        } else if (selectedMon == 12) {
            price = 35.99;
            discount = .15 + .10 + .20;
        }
    }

    // Checks if a membership discount should apply
    if (member.checked == true) {
        discount += .03;
    }

    // Checks if the service radio button was clicked on, if so then it calculates the total cost
    if (serv.checked == true) {
        discountAmt = (price * discount).toFixed(2);    // gets the discount amount
        num = (price - discountAmt).toFixed(2); // gets the price with the discount being included
        cost.value = "$" + thousands_separators(num);   // sets the value that was calcuated to the Cost field
    }
}
servs.addEventListener("change", servPrice);
mons.addEventListener("change", servPrice);

/**
 * Used for formatting numbers
 * Taken from: https://www.w3resource.com/javascript-exercises/javascript-math-exercise-39.php
 * @param num the number passed to the function
 */
function thousands_separators(num) {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
}

/**
 * Used to call servPrice() or prodPrice()
 */
member.onchange = function checked() {  // called this way to keep script tag where it is at in the HTML
    // Checks which radio button is checked
    if (serv.checked == true) {
        servPrice();
    } else if (prod.defaultChecked) {   // checks if prod is checked (checked by default thus, the defaultChecked property is used)
        prodPrice();
    }
}