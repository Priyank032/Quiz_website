const Timer=(endTime)=>{
	var quizEndTime = new Date(endTime).getTime();

    var x = setInterval(()=> {

      var currentTime = new Date().getTime();

      var distance = quizEndTime-currentTime;

      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);


       document.getElementById("rem_time").innerHTML =minutes + "m " + seconds + "s ";

      if (distance < 0) {
        clearInterval(x);
        document.getElementById("submitbtn").click();
        document.getElementById("rem_time").innerHTML = "Times Up";
      }
    }, 1010);
};