// JavaScript source code
/*
 * Determines if the user should be logged out or not 
 */
function login() {
    const log = document.getElementById("log");
    if (log.innerText == " Logout") {
        log.title = "Login";
        log.innerText = " " + log.title;
        log.setAttribute("href", window.location.href.split("#")[0]);
        var i = document.createElement("i");
        var attr = document.createAttribute("class");
        attr.value = "fas fa-user-alt";
        i.setAttributeNode(attr);
        log.insertBefore(i, log.childNodes[0]);
    }
}