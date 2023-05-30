var minutes;
var seconds;
// sessionStorage.clear();
if (sessionStorage.getItem("minutes")) {
  seconds = sessionStorage.getItem("seconds");
  minutes = sessionStorage.getItem("minutes");
  minutes = minutes + "." + seconds;
}

else {
  minutes = $('#set-time').val();
}

var target_date = new Date().getTime() + ((minutes * 60) * 1000); // set the countdown date
var time_limit = ((minutes * 60) * 1000);
//set actual timer
setTimeout(
  function () {
    // document.getElementById("left").innerHTML = "Timer Stopped";
    sessionStorage.clear();
    showTimeOutPopup();
  }, time_limit);

var days, hours; // variables for time units

var countdown = document.getElementById("tiles"); // get tag element

getCountdown();

setInterval(function () { getCountdown(); }, 1000);

function getCountdown() {

  // find the amount of "seconds" between now and target
  var current_date = new Date().getTime();
  var seconds_left = (target_date - current_date) / 1000;

  if (seconds_left >= 0) {
    console.log(time_limit);
    if ((seconds_left * 1000) < (time_limit / 2)) {
      $('#tiles').removeClass('color-full');
      $('#tiles').addClass('color-half');

    }
    if ((seconds_left * 1000) < (time_limit / 4)) {
      $('#tiles').removeClass('color-half');
      $('#tiles').addClass('color-empty');
    }

    days = pad(parseInt(seconds_left / 86400));
    seconds_left = seconds_left % 86400;

    hours = pad(parseInt(seconds_left / 3600));
    seconds_left = seconds_left % 3600;

    minutes = pad(parseInt(seconds_left / 60));
    seconds = pad(parseInt(seconds_left % 60));

    if(minutes == 01 && seconds == 00) {
      showCountDownPopup();
    }

    if(minutes == 05 && seconds == 00) {
      showCountDownPopup();
    }
    // format countdown string + set tag value
    sessionMinutes = sessionStorage.setItem("minutes", minutes);
    sessionMinutes = sessionStorage.setItem("seconds", seconds);
    countdown.innerHTML = "<span>" + hours + ":</span><span>" + minutes + ":</span><span>" + seconds + "</span>";

  }
}

function pad(n) {
  return (n < 10 ? '0' : '') + n;
}

function showCountDownPopup() {
    const section = document.getElementById("countdown-popup"),
    overlay = document.querySelector(".overlay"),
    showBtn = document.querySelector(".show-modal"),
    closeBtn = document.querySelector(".close-btn");

    // showBtn.addEventListener("click", () => 
    section.classList.add("active");

    overlay.addEventListener("click", () =>
        section.classList.remove("active")
    );

    closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
    );
}
var ctrlKeyDown = false;

$(document).ready(function(){    
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};


function showTimeOutPopup() {
  swal({
      title: "Payment",
      text: "Payment Session Expired",
      icon: "warning",
      button: "OK",
      dangerMode: true,
  }).then((willDelete) => {
          window.location.href = '../index.php';
  })
}