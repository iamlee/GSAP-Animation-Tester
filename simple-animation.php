<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name=”ad.size” content=”width=300,height=250”>
<script type="text/javascript">
  var clickTag = "http://www.google.com";
</script>

<title>Simple test of text based animation</title>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="assets/css/all.css" />
<style>body{margin:0px;padding:0px}</style>
</head>

<body>
  <div class="canvas threeHundredTwoFifty">
    <div class="wrapper">
      <div class="text" id="text">
        Animation Test using GSAP
      </div>

    </div>
    <div class="controls">

      <div class="sliderValues">time: <span id="time"></span>s / progress: <span id="progress"></span>%</div>
      <div class="slider" id="progressSlider"></div>

      <button id="playBtn">play</button>
      <button id="pauseBtn">pause</button>
      <button id="restartBtn">restart</button>

      <div class="comments">
        <form action="post-comments.php" method="POST">

          <input type="text" id="pausedTime" name="pausedTime" value=""></input>
          <textarea id="note-info" name="note-info" rows="10" cols="50"></textarea>
          <button type="button" id="save" name="button">Save</button>

          <div id="notes" class="comments-section" name="notes">

          </div>

          <button type="submit" id="submit" name="submit">Submit and Lock</button>
            <p class="lock warning">Lock file to finalise comments</p>
          <button type="button" class="unlock" id="unlock" name="unlock">Unlock comments</button>
            <p class="unlock warning">Unlocking will delete previous comments.</p>

        </form>




      </div>

    </div>


    <!--CDN links for the latest TweenLite, CSSPlugin, and EasePack-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

    <script>
    var jsonObj = [];

    $('#submit, .unlock, .lock').css({visibility: 'hidden', position: 'absolute'});

    $('#save').click(function() {
      $('#submit, .lock').css({visibility: 'visible', position: 'relative'});
      var time = $('#pausedTime').val(),
          note = $('#note-info').val(),
          obj = {
  	        time: time,
  	        note: note
  	      };
	    jsonObj.push(obj);
	    //console.log(JSON.stringify(jsonObj));
	  });

    $('#submit').click(function(e) {
      e.preventDefault();
      $('#submit, .unlock, .lock, #save, #note-info, #pausedTime').css({visibility: 'hidden', position: 'absolute'});
      $('.unlock').css({visibility: 'visible', position: 'relative'});
      $('#notes .comments-section').remove();

      //alert(JSON.stringify(jsonObj));
      var obj = JSON.stringify(jsonObj);

      $.ajax({
        type: 'POST',
        url: 'post-comments.php',
        data: {
          obj
        },
        success: function(json) {
          //alert("data saved");
          $('.comments').prepend(
            '<h2 class="saved">Data Saved!</h2>'
          );
          setTimeout(function(){
            $('.saved').fadeOut();
          }, 3000);
        }
      })
    });

    $.getJSON('comments.json').done(function(data){
      $('.unlock').css({visibility: 'visible', position: 'relative'});
      $('#submit, #save, #note-info, #pausedTime, .lock').css({visibility: 'hidden', position: 'absolute'});

      var readInfo = data,
          comments = '',
          target = $('#notes').innerHTML;

      readInfo.sort(function(a, b) {
        return parseFloat(a.time) - parseFloat(b.time);
      });

      comments += '<ul class="comments-section">';

      for (var i = 0; i < readInfo.length; i++) {
        //console.log(readInfo[i].time);
        //console.log(readInfo[i].note);
        comments += '<li><span>Time: ' + readInfo[i].time + '</span>Comment: ' + readInfo[i].note + '</li>';
      }

      comments += '</ul>';
      $('#notes').append(comments);
    }).fail(function(jqXHR){
      console.log('no json on file');
    });

    $('#unlock').click(function() {
      $('#save, #note-info, #pausedTime').css({visibility: 'visible', position: 'relative'});
      $('.unlock').css({visibility: 'hidden', position: 'absolute'});
      $('#notes .comments-section').remove();
    });

    </script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.11.5/TweenMax.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TimelineLite.min.js"></script>
    <script src="assets/js/animation.js"></script>


</body>
</html>
