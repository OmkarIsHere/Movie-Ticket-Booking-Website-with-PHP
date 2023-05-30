var el;
var et;
var lt;
var gpsTog;

var myspan;

function ToggleSearch() {

    if (el.style.display == 'none') {
        el.style.display = "flex";
        et.style.color = '#D72323';
        lt.style.display = 'none';
        gpsTog.style.color = 'white';

    } else {
        el.style.display = "none";
        et.style.color = 'white';
    }
}

function ToggleLocation() {
    if (lt.style.display == 'none') {
        lt.style.display = "flex";
        gpsTog.style.color = '#D72323';
        et.style.color = 'white';
        el.style.display = 'none';

    } else {
        lt.style.display = "none";
        gpsTog.style.color = 'white';
    }

}

function slideMenuBar() {
    if (myMenu.style.right == '0px') {
        myMenu.style.right = '-400px';
    } else {
        myMenu.style.right = '0px';
    }
}

function moveright() {
    if (myspan.style.left = "53px") {
        myspan.style.left = "200px";
        theaterslide.style.right = "0px";
        movieslide.style.left = "1000px";
    }
}

function moveleft() {
    if (myspan.style.left = "200px") {
        myspan.style.left = "53px";
        theaterslide.style.right = "1000px";
        movieslide.style.left = "0px";
    }
}

function myActive() {
    if (myspan2.style.left = "140px") {


        myspan2.style.left = "37px"
        bookingCanceled.style.right = "1000px"
        BookingHistory.style.right = "1000px";
        ActiveBookings.style.right = "0px";
    }
    if (myspan2.style.left = "234px") {
        myspan2.style.left = "37px"
        bookingCanceled.style.right = "1000px"
        BookingHistory.style.right = "1000px";
        ActiveBookings.style.right = "0px";
    }

}

function mycancel() {

    if (myspan2.style.left = "37px") {
        myspan2.style.left = "140px";
        ActiveBookings.style.right = "-1000px";
        bookingCanceled.style.right = "0px"
    }

    if (myspan2.style.left = "234px") {
        myspan2.style.left = "140px";
        BookingHistory.style.right = "1000px";
    }


}

function myhistory() {
    if (myspan2.style.left = "37px") {
        myspan2.style.left = "234px";
        BookingHistory.style.right = "0px";
        ActiveBookings.style.right = "-1000px";
        bookingCanceled.style.right = "-1000px"

    }
    if (myspan2.style.left = "140px") {
        myspan2.style.left = "234px";
        bookingCanceled.style.right = "-1000px";
        BookingHistory.style.right = "0px";

    }


}
(function(window, document, undefined) {

    // code that should be taken care of right away

    window.onload = init;

    function init() {
        // the code to be called when the dom has loaded
        // #document has its nodes
        el = document.querySelector('#SearchContainer');
        et = document.querySelector('#SearchToggle');
        lt = document.querySelector('#LocationContainer');
        gpsTog = document.querySelector('#LocationToggle');
        myMenu = document.querySelector('#myMenuBar');
        myspan = document.querySelector(".line");
        myspan2 = document.querySelector(".myline");
        movieslide = document.querySelector(".MovieReview");
        theaterslide = document.querySelector(".TheaterReview ");
        bookingCanceled = document.querySelector(".BookingCanceled");
        ActiveBookings = document.querySelector(".ActiveBookings");
        BookingHistory = document.querySelector(".Bookinghistory");
    }
})(window, document, undefined);