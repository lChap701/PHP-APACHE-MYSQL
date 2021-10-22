// JavaScript source code
// This JavaScript file uses concepts used in https://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock
/* 
 * Finds the current time
 */
window.onload = function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var n = today.getDay();
    d = checkDay(n);
    m = checkMinutes(m, h);
    h = checkHours(h);
    document.getElementById("time").innerHTML = "Time: " + d + " " + h + ":" + m;
    var t = setTimeout(startTime, 500); // keeps calling the function
}

/*
 * Formats the minutes
 * i represents the minutes
 * n represents the hours
 */
function checkMinutes(i, n) {
    if (i < 10 && i >= 0) {
        i = "0" + i; // add zero in front of numbers < 10 and > 0
    }

    // Displays AM or PM depending on the hour (n)
    if (n < 12) {
        i = i + " AM";
    } else {
        i = i + " PM";
    }
    return i;
}

/*
 * Formats the hours
 * i represents the hours
 */
function checkHours(i) {
    if (i > 12) {
        i = i - 12; // keeps the hours in a 12-hour format
    }
    return i;
}

/*
 * Formats the day
 * i represents the day
 */
function checkDay(i) {
    // Changes the number value (0 - 6) to it's corresponding day (ex: a value 0 would be Sunday)
    switch (i) {
        case 0:
            i = "Sunday ";
            break;
        case 1:
            i = "Monday ";
            break;
        case 2:
            i = "Tuesday ";
            break;
        case 3:
            i = "Wednesday ";
            break;
        case 4:
            i = "Thursday ";
            break;
        case 5:
            i = "Friday ";
            break;
        case 6:
            i = "Saturday ";
            break;
        default:
            i = "Error ";
    }
    return i;
}