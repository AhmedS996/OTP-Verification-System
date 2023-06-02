// Set the initial time remaining to 300 seconds (5 minutes)
var timeleft = 300;

// Update the countdown timer every second using an interval timer
var downloadTimer = setInterval(function () {
  // If the time has run out, redirect to the "Timer_Finished.php" page
  if (timeleft <= 0) {
    window.location.replace("Timer_Finished.php");
  } else {
    // Compute the number of minutes and seconds remaining
    var minutes = Math.floor(timeleft / 60);
    var seconds = timeleft % 60;

    // Construct a string that displays the time remaining in minutes and seconds
    var countdownText = minutes + "m " + seconds + "s remaining";

    // Update the HTML element with the ID "countdown" to display the countdown text
    document.getElementById("countdown").innerHTML = countdownText;
  }

  // Decrement the time remaining by one second
  timeleft -= 1;
}, 1000);
