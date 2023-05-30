function myFunction1() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunction2() {
  var x2 = document.getElementById("confirmpassword");
  if (x2.type === "password") {
    x2.type = "text";
  } else {
    x2.type = "password";
  }
}

function checkPassword(form) {
  password1 = form.password.value;
  password2 = form.confirmpassword.value;
if (password1 != password2) {
      alert ("\nPassword did not match: Please try again...")
      return false;
  }
}