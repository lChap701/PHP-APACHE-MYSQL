// JavaScript source code
const product = document.getElementById("product"); // the Products section
const service = document.getElementById("service"); // the Services section
const prods = document.getElementById("prods"); // the Product dropdown menu
const servs = document.getElementById("servs"); // the Service dropdown menu
const mons = document.getElementById("mons"); // the Months dropdown menu
const prod = document.getElementById("prod"); // the Product radio button
const serv = document.getElementById("serv");   // the Service radio button

function selected() {
    const cost = document.getElementById("cost");   // the Cost field
    const disc = document.getElementById("disc");   // the discount field

    if (prod.checked == true) {
        product.classList.remove("hidden");
        service.classList.add("hidden");
        cost.value = "";
        disc.value = "";
    } else if (serv.checked == true) {
        service.classList.remove("hidden");
        product.classList.add("hidden");
        cost.value = "";
        disc.value = "";
    }
}
prod.addEventListener("change", selected);
serv.addEventListener("change", selected);
prods.addEventListener("change", selected);
servs.addEventListener("change", selected);