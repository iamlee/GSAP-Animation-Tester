var tl = new TimelineLite();

window.onload = function () {
  var logo1 = document.getElementById("logo1"),
      logo2 = document.getElementById("logo2"),
      logo3 = document.getElementById("logo3"),
      logo4 = document.getElementById("logo4"),
      logo5 = document.getElementById("logo5"),
      logo6 = document.getElementById("logo6"),
      updateOutput = document.getElementById("updateOutput"),
      completeOutput = document.getElementById("completeOutput"),
      updateCount = 0;


  var tweens =
  tl.to(logo1, 3, {left: "632px"});
  tl.to(logo2, 3, {left: "632px", ease:Elastic.easeOut}, "-=1");
  tl.to(logo3, 3, {left: "632px", ease:Elastic.easeOut, delay:0.5, onUpdate:updateHandler, onComplete:completeHandler, onCompleteParams:["animation Complete!"]});
  tl.to(logo4, 3, {left: "632px", backgroundColor: '#000'});
  tl.from(logo5, 3, {left: "632px", ease:Elastic.easeIn});
  tl.to(logo6, 3, {left: "+=100px"});
  tl.to([logo2,logo4,logo6], 2, {scale: 0.2, opacity: 0.7})


  function updateHandler() {
     updateCount++;
     updateOutput.innerHTML = "onUpdate fired " + updateCount;
  }

  function completeHandler(message) {
     completeOutput.innerHTML = "onComplete fired <br/> completeParams = " + message;
  }

}
