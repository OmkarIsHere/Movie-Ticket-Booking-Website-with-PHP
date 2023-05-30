
var el;
var et;
var lt;
var gpsTog;
var status = FontFaceSetLoadEvent;
var myspan;
var x = window.matchMedia("(max-width: 950px)");
// if(sessionStorage.getItem("login_status") == "true") {
//     switchButtons(0);
// }

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

function switchButtons(index) {
    var login_register = document.getElementById("login_register");
    var Dashboard = document.getElementById("dashboard-menu-link");
    var register = document.getElementById("register");
    var login_btn = document.getElementById("login-row");

    if (index == 0) {
        login_register.style.display = "none";
        register.style.display = "none";
        Dashboard.style.display = "block";
        login_btn.style.display = "block";
        // sessionStorage.setItem("login_status", "true");
    }

    if (index == 1) {
        login_register.style.display = "block";
        register.style.display = "block";
        Dashboard.style.display = "none";
        login_btn.style.display = "none";
        // sessionStorage.setItem("login_status", "false");
    }
}

function slideMenuBar() {
    var myMenu = document.querySelector('#myMenuBar');
    var open = document.getElementById("open");
    var close = document.getElementById("close");

    if (myMenu.style.right == '0px') {
        myMenu.style.right = '-400px';
        open.style.display = 'block';
        close.style.display = 'none';
    } else {
        myMenu.style.right = '0px';
        open.style.display = 'none';
        close.style.display = 'block';
    }
}

function moveright() {
    if (myspan.style.left = "53px") {
        myspan.style.left = "200px";
    }
}

function moveleft() {
    if (myspan.style.left = "200px") {
        myspan.style.left = "53px";
    }
}
(function (window, document, undefined) {

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
    }
})(window, document, undefined);


function loginAlert(message) {
    swal({
        title: "Good Job!",
        text: message,
        icon: "success",
        button: "OK",
    }).then((value) => {
        // swal(`The returned value is: ${value}`);
        if (`${value}`) {
            // window.location.href = '../index.php';
        }
    });
}


// $(document).ready(function () {
    // locationselector();
    function locationselector(cityName) {
        // $("#location").on('change', function () {
            var location = cityName;
            // console.log(location);
            $.ajax({
                url: "./locationload.php",
                async: false,
                cache: false,
                type: "POST",
                data: { location: location },
                success: function (result) {
                    //console.log(result);
                    showLocationPopup(1);
                }

            });
        // })
    }
// });


function showLocationPopup(index) {
    var searchBox = document.getElementById("selectLocation");
    if(x.matches) {
        if(index == 0) {
            searchBox.style.visibility = 'visible';
            document.body.style.position = 'unset';
        }
        else if(index == 1) {
            searchBox.style.visibility = 'hidden';
            document.body.style.position = 'unset';
            window.location.reload();
        }
    }

    else {
        if(index == 0) {
            searchBox.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
        }
        else if(index == 1) {
            searchBox.style.visibility = 'hidden';
            document.body.style.overflow = 'unset';
            window.location.reload();
        }
    }
}

window.onload = function () {
    var SearchResult = document.getElementById("myMenuBar");
    var open = document.getElementById("open");
    var close = document.getElementById("close");
    var pre_loader = document.getElementById("pre-loader");
    var load_html = document.getElementById("load-html");

    load_html.style.display = 'block';
    pre_loader.style.display = 'none';
    
    document.onclick = function (event) {
        // if (event.target.id !== "movie-list") {
        //     SearchResult.style.display = "block";
        // }
        if (event.target.id !== "open") {
            open.style.display = 'block';
            close.style.display = 'none';
            SearchResult.style.right = "-400px";
        }
    }
    // if (x.matches) {
    //     showNowShowingMovies();
    // }
};