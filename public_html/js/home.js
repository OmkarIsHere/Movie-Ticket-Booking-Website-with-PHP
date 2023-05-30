const forms = document.querySelector(".forms"),
    pwShowHide = document.querySelectorAll(".eye-icon"),
    pwShowHide1 = document.querySelectorAll(".eye-icon1"),
    links = document.querySelectorAll(".link");
var login = document.getElementById("login");
var signup = document.getElementById("signup");
var verify = document.getElementById("verification");
var forgot_pswd = document.getElementById("forgot_password");
var reset_code = document.getElementById("reset_code");
var new_pswd = document.getElementById("new_password");
var email_contact = document.getElementById("email_contact");
var now_showing_active = document.getElementById("now-showing-active");
var coming_soon_active = document.getElementById("coming-soon-active");
var now_showing = document.getElementById("slider-now-showing");
var coming_soon = document.getElementById("slider-coming-soon");
var x = window.matchMedia("(max-width: 800px)");
// var header = document.getElementById("payment-active");
// var btns = header.getElementsByClassName("payment-col");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

        pwFields.forEach(password => {
            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })

    })
})

pwShowHide1.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".con_password");

        pwFields.forEach(password => {
            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
                return;
            }
            password.type = "password";
            eyeIcon.classList.replace("bx-show", "bx-hide");
        })

    })
})

links.forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault(); //preventing form submit
        forms.classList.toggle("show-signup");
    })
})

// window.onload = function () {
//     var preLoader = document.getElementById("pre-loader");
//     var html = document.getElementById("load-html");

//     html.style.display = 'block';
//     preLoader.style.display = 'none';

// }

function show_hide_Panels(index) {
    if (index == 1) {
        login.style.display = 'block';
        signup.style.display = 'none';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'none';
    }
    else if (index == 2) {
        login.style.display = 'none';
        signup.style.display = 'block';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'none';
    }
    else if (index == 3) {
        login.style.display = 'none';
        signup.style.display = 'none';
        verify.style.display = 'block';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'none';
    }
    else if (index == 4) {
        login.style.display = 'none';
        signup.style.display = 'none';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'block';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'none';
    }
    else if (index == 5) {
        login.style.display = 'none';
        signup.style.display = 'none';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'block';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'none';
    }
    else if (index == 6) {
        login.style.display = 'none';
        signup.style.display = 'none';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'block';
        email_contact.style.display = 'none';
    }
    else if (index == 7) {
        login.style.display = 'none';
        signup.style.display = 'none';
        verify.style.display = 'none';
        forgot_pswd.style.display = 'none';
        reset_code.style.display = 'none';
        new_pswd.style.display = 'none';
        email_contact.style.display = 'block';
    }
}

function loginAlert(message) {
    swal({
        title: "Good Job!",
        text: message,
        icon: "success",
        button: "OK",
    }).then((value) => {
        // swal(`The returned value is: ${value}`);
        if (`${value}`) {
            window.location.href = '../index.php';
        }
    });
}

function backButton(index) {
    if(index == 0) {
        window.history.back();
    }
    else if (index == 1) {
        window.history.go(-2);
    }
}

function registerAlert(message) {
    swal({
        title: "Good Job!",
        text: message,
        icon: "success",
        button: "OK",
    }).then((value) => {
        // swal(`The returned value is: ${value}`);
        if (`${value}`) {
            // window.location = "http://localhost/projects/MovieTime/index.php";
            show_hide_Panels(1);
        }
    });
}

function showSuccess(message) {
    swal({
        title: "Good Job!",
        text: message,
        icon: "success",
        button: "OK",
    }).then((value) => {
        // swal(`The returned value is: ${value}`);
        if (`${value}`) {
            // window.location = "http://localhost/projects/MovieTime/index.php";
        }
    });
}

function showFailure() {
    swal({
        title: "Login Failed",
        text: "Incorrect Email or Password",
        icon: "error",
        button: "OK",
    }).then((value) => {
        // swal(`The returned value is: ${value}`);
        if (`${value}`) {
            window.location.href = '../login/login.php';
        }
    });
}

function showNowShowingMovies() {
    $("#now-showing-active").addClass("now-showing-active");
    $("#coming-soon-active").removeClass("coming-soon-active");

    now_showing.style.display = 'block';    
    coming_soon.style.display = 'none';
}

function showUpComingMovies() {
    $("#now-showing-active").removeClass("now-showing-active");
    $("#coming-soon-active").addClass("coming-soon-active");

    now_showing.style.display = 'none';    
    coming_soon.style.display = 'block';
}

var btn = $('#topbtn');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});