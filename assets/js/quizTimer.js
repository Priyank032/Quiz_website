const Timer = (endTime, start_time) => {

  var quizEndTime = new Date(endTime).getTime();

  // var quizEndTime = localStorage.getItem("end_time")

  var quizstartTime = new Date(start_time).getTime();
  var currentTime3 = new Date().getTime();
  localStorage.setItem("start_time", quizstartTime)
  localStorage.setItem("end_time", quizEndTime)

  if (localStorage.getItem("stopTime")) {
    var stopTime = localStorage.getItem("stopTime");
    //  var CurrentTime2 = localStorage.getItem("start_time");
    if (currentTime3 !== stopTime) {

      var resultTime = currentTime3 - stopTime;
      quizEndTime = quizEndTime + resultTime;
      console.log(quizEndTime)
      //  localStorage.setItem("end_time",quizEndTime)
    }
  }
  var x = setInterval(() => {

    var currentTime = new Date().getTime();
    localStorage.setItem("stopTime", currentTime)


    var distance = quizEndTime - currentTime;

    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);



    document.getElementById("rem_time").innerHTML = minutes + "m " + seconds + "s ";

    if (distance < 0) {
      clearInterval(x);
      document.getElementById("submitbtn").click();
      document.getElementById("rem_time").innerHTML = "Times Up";
      localStorage.clear();
    }
  }, 1010);
};