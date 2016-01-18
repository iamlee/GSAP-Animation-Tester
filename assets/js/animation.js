var playBtn = $("#playBtn"),
    pauseBtn = $("#pauseBtn"),
    time = $("#time"),
    progress = $("#progress"),
    tl = new TimelineLite({onUpdate:updateSlider, delay:0.4});

window.onload = function () {
  var textObj = document.getElementById('text');

  tl.to(textObj, 1, {top: "300px", rotationX:360});
  tl.to(textObj, 1.5, {left: "900px", ease: Elastic.easeIn.config(1, 0.3), delay: 2});

}

$( "#progressSlider" ).slider({
  range: false,
  min: 0,
  max: 1,
  step:.001,
  slide: function ( event, ui ) {
    tl.progress( ui.value ).pause();
  }
});

$("#playBtn").on("click", function(){
  //Play the timeline forward from the current position.
  //If tween is complete, play() will have no effect
  tl.play();
});

$("#pauseBtn").on("click", function(){
  tl.pause();
});

$("#restartBtn").on("click", function(){
  tl.restart();
});

function updateSlider() {
  $("#progressSlider").slider("value", tl.progress());
  time.html(tl.time().toFixed(2));
  progress.html(Math.floor((tl.progress().toFixed(2)) * 100));

  document.getElementById("pausedTime").value = tl.time().toFixed(2);
  //$("#pausedTime").value(tl.time().toFixed(2));
}

var notes = document.getElementById('notes'),
    note = document.getElementById('note-info');

//- Using and anonymous function:
document.getElementById("save").onclick = function () {
  notes.innerHTML += '<div><span>Time: ' + tl.time().toFixed(2) + '</span>Comment: ' + note.value + '</div>';
};
