var other_type = document.getElementById("panel_other_type");
var upi = document.getElementById("panel_upi");
var paytm = document.getElementById("panel_paytm");
var payment_options = document.getElementById("payment-options");
var bill = document.getElementById("billing-details");
var x = window.matchMedia("(max-width: 800px)");

function showPaymentPanels(index) {
    if (index == 1) {
        other_type.style.display = 'block';
        upi.style.display = 'none';
        paytm.style.display = 'none';

        if (x.matches) {
            window.scroll({
                top: 80,
                // left: 100,
                behavior: 'smooth'
            });
        }
        else {
            window.scroll({
                top: 360,
                // left: 100,
                behavior: 'smooth'
            });
        }
        // $('body').addClass('stop-scrolling');
    }

    else if (index == 2) {
        other_type.style.display = 'block';
        upi.style.display = 'none';
        paytm.style.display = 'none';

        if (x.matches) {
            window.scroll({
                top: 80,
                // left: 100,
                behavior: 'smooth'
            });
        }
        else {
            window.scroll({
                top: 340,
                // left: 100,
                behavior: 'smooth'
            });
        }
        // $('body').addClass('stop-scrolling');
    }

    else {
        other_type.style.display = 'none';
        upi.style.display = 'block';
        paytm.style.display = 'none';

        if (x.matches) {
            window.scroll({
                top: 80,
                // left: 100,
                behavior: 'smooth'
            });
        }
        else {
            window.scroll({
                top: 340,
                // left: 100,
                behavior: 'smooth'
            });
        }
        // $('body').addClass('stop-scrolling');
    }
}

// for (var i = 0; i < btns.length; i++) {
//     btns[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//     });
// }

/*===== ACTIVE AND REMOVE MENU =====*/

const btns = document.querySelectorAll('.payment-col');

function activeFunction() {
    /*Active link*/
    btns.forEach(n => n.classList.remove('active'));
    this.classList.add('active');
}
btns.forEach(n => n.addEventListener('click', activeFunction));

function makePaytmPayment() {
    document.getElementById("submit_form").submit();
}

function showAlert() {
    swal({
        title: "Are you sure?",
        text: "You want to cancel checking out ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            window.location.href = '../index.php';
        }
    })
}

function show_hide_options(index) {
    if (index == 0) {
        payment_options.style.display = 'none';
        bill.style.display = 'block';
    }

    else if (index == 1) {
        bill.style.display = 'none';
        payment_options.style.display = 'block';
    }

}


function paymentStatus(message,logo) {
    swal({
        title: "Good Job!",
        text: message,
        icon: logo,
        button: "OK",
    }).then((value) => {
    // swal(`The returned value is: ${value}`);
    if(`${value}`) {
        if(logo == "success") {
            window.location.href = '../printticket/print.php';
        }
        else if(logo == "error") {
            window.location.href = '../index.php';
        }
    }
    });
}

window.onload = function () {
    var pre_loader = document.getElementById("pre-loader");
    var load_html = document.getElementById("load-html");

    load_html.style.display = 'block';
    pre_loader.style.display = 'none';
}