// JavaScript source code
const subnav = document.getElementsByClassName("subnav");

function extraStyles() {
    const icon = document.querySelector(".subnav i");
    const actLink = document.querySelector(".subnav a");

    if (!icon.classList.contains("fa-caret-up")) {
        icon.classList.add("fa-caret-up");
        icon.classList.toggle("fa-caret-down");
    } else {
        icon.classList.toggle("fa-caret-up");
        icon.classList.toggle("fa-caret-down");
    }

    if (!actLink.classList.contains("active")) {
        actLink.classList.add("active");
    } else {
        actLink.classList.toggle("active");
    }
}
// Loop for adding an EventListener to all subnav classes
for (let i = 0; i < subnav.length; i++) {
    subnav[i].addEventListener("mouseover", extraStyles);
    subnav[i].addEventListener("mouseout", extraStyles);
}