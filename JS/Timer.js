//timer to input otp code

var timeleft = 60;
var downloadTimer = setInterval(function () {
  if (timeleft <= 0) {
    window.location.replace("../php/Timer_Finished.php");
  } else {
    document.getElementById("countdown").innerHTML =
      timeleft + " seconds remaining";
  }
  timeleft -= 1;
}, 1000);
