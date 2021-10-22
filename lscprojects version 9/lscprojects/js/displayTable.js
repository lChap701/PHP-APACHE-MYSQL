// JavaScript source code
const prod = document.getElementById("prod");	// the Product radio button
const serv = document.getElementById("serv");   // the Service radio button

function selected() {
	const product = document.getElementById("product"); // the Products section
	const service = document.getElementById("service"); // the Services section

	if (prod.checked == true) {
		product.classList.remove("hidden");
		service.classList.add("hidden");
	} else if (serv.checked == true) {
		service.classList.remove("hidden");
		product.classList.add("hidden");
	}
}
prod.addEventListener("change", selected);
serv.addEventListener("change", selected);