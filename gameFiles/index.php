
<head>
  <script
  			  src="https://code.jquery.com/jquery-3.6.0.min.js"
  			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  			  crossorigin="anonymous"></script>

          <!-- CSS only -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<?php

include("src/functions.php");


if(isset($_POST) && count($_POST) == 2){

  $username = $_POST['userName'];
  $password = $_POST['password'];

  login($username, $password);
}

 ?>
<html>

<div id="frown" class="d-flex justify-content-center" style="height: 15%; width: 100%;">

</div>
<center>
<div class='.container'>
  <div class='eye'></div>
  <div class='eye'></div>
</div>
</center>

<div id="container" class="d-flex justify-content-center h-25">
  <img src="./src/images/firstMouth.png" alt=""/>
</div>

<form method='post' action=''>
  <div class='d-flex justify-content-center'>
    <input id="field" name='userName' type="text" style='width: 400px; height: 50px; font-size:20px;' placeholder='Username' autocomplete='off'/>
  </div>
<div class='d-flex justify-content-center' id="password" onClick='passwordSelect()'>
  <input id="password" name='password' type="password" style='width: 400px; height: 50px; font-size:20px;' placeholder='Password' autocomplete='off'/>
</div>
<div class='d-flex justify-content-center'>
  <input type='submit' class='d-flex justify-content-center' style='width: 400px; height: 50px;' />
</div>
</form>

<a href='createAccount.php' class='d-flex justify-content-center'>Create Account</a>
</html>

<script>

var boxX =field.offsetHeight;
var boxY= field.offsetLeft;
var count = 0;

function passwordSelect(){
  console.log("selected");
  document.getElementById("frown").innerHTML = '<img src=\'./src/images/mad.png\'>';
  document.getElementById("container").innerHTML = '<img src=\'./src/images/frown.png\'>';

  var eye = $(".eye");
  eye.css({
    'transform': 'rotate(' + 180 + 'deg)'
  });
  var x = e.target.offsetLeft + e.target.selectionEnd;
  var y = e.target.offsetTop + e.target.selectionEnd;
  var rad = Math.atan2(x,y);
  var rot = (rad * (180 / Math.PI) * -1) + 180;
  //on each instance of the event, update the eye css
  var eyes = document.getElementsByClassName('eye');

  eye.css({
    'transform': 'rotate(' + count + 'deg)'
  });

  if(e.keyCode == 8){
    count += 2;
  }
  else{
    count -= 2;
  }
  if(count > 0){
    count = 0;
  }
}

document.getElementById("password").addEventListener('onClick', e=> {
  console.log("password is selected");
})
document.getElementById("field").addEventListener('keydown', e => {
    var eye = $(".eye");
    eye.css({
      'transform': 'rotate(' + 180 + 'deg)'
    });
    var x = e.target.offsetLeft + e.target.selectionEnd;
    var y = e.target.offsetTop + e.target.selectionEnd;
    var rad = Math.atan2(x,y);
    var rot = (rad * (180 / Math.PI) * -1) + 180;
    //on each instance of the event, update the eye css
    var eyes = document.getElementsByClassName('eye');

    eye.css({
      'transform': 'rotate(' + count + 'deg)'
    });

    if(e.keyCode == 9){
      passwordSelect();
      return;
    }

    if(e.keyCode == 8){
      count += 2;
    }
    else{
      count -= 2;
    }
    if(count > 0){
      count = 0;
    }

    if(count < 0){
      document.getElementById("container").innerHTML = '<img src=\'./src/images/firstMouth.png\'>';
    }
    if(count < -12){
      //change to second mouth
      document.getElementById("container").innerHTML = '<img src=\'./src/images/secondMouth.png\'>';
    }
    if(count < -24){
      //change to third mouth
      document.getElementById("container").innerHTML = '<img src=\'./src/images/thirdMouth.png\'>';
    }

  });

function activate(){
  console.log("Username Entry");
  document.getElementById("change").innerHTML = "Username Changed!";
}

function activate2(){
  console.log("Password entry");
  document.getElementById("change").innerHTML = "I'm not looking! (Maybe)";
}


</script>

<style>
.eye {
  position: relative;
  display: inline-block;
  border-radius: 50%;
  height: 150px;
  width: 150px;
  background: #CCC;
}
.eye:after { /*pupil*/
  position: absolute;
  bottom: 5px;
  right: 85px;
  width: 15px;
  height: 15px;
  background: #000;
  border-radius: 50%;
  content: " ";
}

</style>
