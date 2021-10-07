<?php

$ret = "<div id='arena' class='border border-dark' style='height: 1750px; width: 1750px;'>";
$ret = "<div id='boxesFinal' class='border border-dark' style='height: 1750px; width: 1750px;'>";
for($i = 0; $i < 50; $i++){
  for($j = 0; $j < 50; $j++){
    //coordinates of each block
    $xCoord = $i * 35;
    $yCoord = $j * 35;
    $xString = $xCoord."px";
    $yString = $yCoord."px";
    $ret .= "<div id='blocks' class='border border-primary' style='margin-left:$xString; margin-top:$yString;  height: 35px; width: 35px; position: absolute;'></div>";
  }
}
//$ret .= "<div id='blocks' class='border border-primary' style='marginTop=35 px; marginLeft=35 px; height: 35px; width: 35px;'></div>";


$ret .= "</div>";
$ret .= "</div>";


echo $ret;
 ?>
<head>
  <script
  			  src="https://code.jquery.com/jquery-3.6.0.min.js"
  			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  			  crossorigin="anonymous"></script>

          <!-- CSS only -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<div id="moves">
  Moves: 0
</div>
<div id="winner" class="h1">

</div>
<div id="arena" class="border border-dark" style="height: 700px; width: 700px;">
<div id="boxes" class="border border-dark" style="height: 700px; width: 700px;">

</div>
<div id="player" class="flex-fill" style="width: 35px; height: 35px; background-color: black;">


</div>
</div>



<script>

n = 30;
count = 0;
x = 0;
y = 700;
moves = 0;
boxCoords = [];


$(document).ready(function() {
  console.log(Date.now());
  onLoad = Date.now();
  var player = document.createElement('div');
  player.style.height = '35px';
  player.style.width = '35px';
  player.style.backgroundColor = "black";
  player.style.marginTop = 0;
  player.style.marginRight = 0;

  for(i = 0; i < n; i++){
    var xCoord = Math.floor(Math.random()*25)*35;
    var yCoord = Math.floor(Math.random()*25)*35;
    while (xCoord > 665){
      xCoord = Math.floor(Math.random()*25)*35;
    }
    while (yCoord > 665){
      yCoord = Math.floor(Math.random()*25)*35;
    }
    var box = document.createElement('div');
    var pic = document.createElement('img');
    pic.setAttribute("id", "pic");
    pic.src = "gold.png";
    pic.setAttribute("width", "35");
    pic.setAttribute("height", "35");

    box.setAttribute('id', xCoord + " " + yCoord);
    box.style.backgroundColor = "blue";
    box.style.position = 'absolute';
    box.style.height = '35px';
    box.style.width = '35px';
    box.style.marginTop = yCoord;
    box.style.marginLeft= xCoord;
    box.style.zIndex = -1;
    box.append(pic);

    document.querySelector('#boxes').append(box);
    if(boxCoords.hasOwnProperty(xCoord)){
      console.log("Duplicate");
      boxCoords[xCoord].push(yCoord);
    }
    else{
      boxCoords[xCoord] = [yCoord];
    }

  }
  console.log(boxCoords);
 });

document.onkeydown = function (event) {
   switch (event.keyCode) {
      case 37:
         console.log("Left key is pressed.");
         if(x == 0){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         x -= 35;
         $('#player').css({marginLeft: '-=35px'});
         break;
      case 38:
         console.log("Up key is pressed.");
         if(y == 0){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         y -= 35;
         $('#player').css({marginTop: '-=35px'});
         break;
      case 39:
         console.log("Right key is pressed.");
         if(x == 665){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         x += 35;
         $('#player').css({marginLeft: '+=35px'});
         break;
      case 40:
         console.log("Down key is pressed.");
         if(y == 665){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         y += 35;
         $('#player').css({marginTop: '+=35px'});
         break;
   }

   console.log(boxCoords[x]);
   console.log(x);
   console.log(y);
   if(typeof(boxCoords[x]) !== 'undefined'){
     //remove that bluediv
     for(k = 0; k < boxCoords[x].length; k++){
       if(boxCoords[x][k] == y){
         console.log("on a blue box");
         var boxRemove = document.getElementById(x + " " + y);
         boxRemove.style.backgroundColor = "red";
         boxRemove.innerHTML = "";
         var picSeen = document.createElement("img");
         picSeen.setAttribute("width", "35");
         picSeen.setAttribute("height", "35");
         picSeen.setAttribute("src", "dirt.png");

         boxRemove.appendChild(picSeen);
         count++;
         delete boxCoords[x][k];
         break;
         console.log(boxCoords);
       }
     }
   }

   if(count == n){
     onWin = Date.now();
     console.log(onWin - onLoad);
     var time = (onWin - onLoad) / 1000;
     document.getElementById("winner").innerHTML = "Congrats, you won!  Number of moves: " + moves + " Time Taken: " + time;

   }
};

</script>
