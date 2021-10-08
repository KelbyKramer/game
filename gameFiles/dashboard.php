<div id="moves">
  Moves: 0
</div>
<div id="winner" class="h1">

</div>

</div>
<div style='position: fixed; top: 0em; right: 0em; background-color:white' class='border border-dark'>
    <button>
      <a href='index.php' style='width:150px;'>Logout</a>
    </button>

</div>
<div id='resourceCount' style='position: fixed; top: 2em; right: 1em; pointer-events: none; background-color:white' class='border border-dark' readonly = 'readonly'>
  <div id='woodCount'>Wood: <span id="woodSpan">0</span></div>
  <div id='stoneCount'>Stone: <span id="stoneSpan">0</span></div>
  <div id='leatherCount'>Leather: <span id="leatherSpan">0</span></div>
  <div id='ironCount'>Iron: <span id="ironSpan">0</span></div>
  <div id='alcoholCount'>Alcohol: <span id="alcoholSpan">0</span></div>
</div>
<div style='position: fixed; top: 10em; right: 1em; background-color:white' class='border border-dark'>
    <button>
      <img src="book.png" style='height:100px; width:100px;'/>
      <div>Building and Crafting recipes</div>
    </button>

</div>
<div id='playerFinal' class='flex-fill' style='width: 35px; height: 35px; background-color: black; z-index: 1; position: absolute;'></div>

<?php
//TODO: Create pop-up menu when Building and Crafting recipes is clicked
$resourceOptions = ['wood', 'iron', 'alcohol', 'leather', 'stone', 'dirt'];


$ret = "<div id='arena' class='border border-dark' style='height: 1750px; width: 1750px;'>";

$ret = "<div id='boxesFinal' class='border border-dark' style='height: 1750px; width: 1750px;'>";

for($i = 0; $i < 50; $i++){
  for($j = 0; $j < 50; $j++){
    //coordinates of each block
    $xCoord = $i * 35;
    $yCoord = $j * 35;
    $xString = $xCoord."px";
    $yString = $yCoord."px";
    $resource = rand(0, 99);

    $resourceType = "";
    if($resource < 85){
      $resourceType = "dirt.png";
      $resourceName = "dirt";
    }
    else if($resource > 84 && $resource < 90){
      $resourceType = "wood.png";
      $resourceName = "wood";

    }
    else if($resource > 89 && $resource < 95){
      $resourceType="stone.png";
      $resourceName = "stone";
    }
    else if($resource == 95 || $resource ==96){
      $resourceType="iron.png";
      $resourceName = "iron";
    }
    else if($resource == 97 || $resource ==98){
      $resourceType="leather.png";
      $resourceName = "leather";
    }
    else if($resource == 99){
      $resourceType="alcohol.png";
      $resourceName = "alcohol";
    }

    $ret .= "<div id='$xCoord $yCoord' class='border border-primary' style='z-index:-1; margin-left:$xString; margin-top:$yString;  height: 35px; width: 35px; position: absolute;'>";

    $ret .="<img src=$resourceType name=$resourceName width='35' height='35'/>";

    $ret .= "</div>";
  }
}

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
<script>

function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}

n = 30;
count = 0;
x = 0;
y = 0;
moves = 0;
boxCoords = [];
woodCount = 0;
stoneCount = 0;
ironCount = 0;
alcoholCount = 0;
leatherCount = 0;


$(document).ready(function() {
  console.log(Date.now());
  onLoad = Date.now();

  //Every 10 seconds, query the database to update the user totals for resources
  (function updateResourceList() {
  $.ajax({
    type: 'POST',
    url: 'updateResources.php',
    data: {
      func:"updateResources",
    },
    success: function(data) {
      console.log("resources updated");
      var parsedData = JSON.parse(data);

      $('#woodSpan').html(parsedData['wood']);
      $('#stoneSpan').html(parsedData['stone']);
      $('#leatherSpan').html(parsedData['leather']);
      $('#ironSpan').html(parsedData['iron']);
      $('#alcoholSpan').html(parsedData['alcohol']);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(updateResourceList, 5000);
    }
  });
})();
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
         $('#playerFinal').css({marginLeft: '-=35px'});
         break;
      case 38:
         console.log("Up key is pressed.");
         if(y == 0){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         y -= 35;
         $('#playerFinal').css({marginTop: '-=35px'});
         break;
      case 39:
         console.log("Right key is pressed.");
         if(x == 1715){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         x += 35;
         $('#playerFinal').css({marginLeft: '+=35px'});
         break;
      case 40:
         console.log("Down key is pressed.");
         if(y == 1715){
           break;
         }
         moves++;
         document.getElementById("moves").innerHTML = "Moves: " + moves;
         y += 35;
         $('#playerFinal').css({marginTop: '+=35px'});
         break;
   }

   console.log(x);
   console.log(y);

   var tile = document.getElementById(x + " " + y);


   var child = tile.firstChild;

   if(child.name == "dirt"){
     console.log("It's dirt!!!");
   }
   else if(child.name == "wood"){
     woodCount += 1;
     child.setAttribute("name", "dirt");
     child.setAttribute("src", "dirt.png");

     $.ajax({
       type: "POST",
       url: "updateResources.php",
       data: {
         func: "wood",
         player_id: "1" //TODO: make this not hardcoded
       },
       success: function(result) {
           console.log(result);
       }
     });
   }
   else if(child.name == "stone"){
     stoneCount += 1;
     child.setAttribute("name", "dirt");
     child.setAttribute("src", "dirt.png");

     $.ajax({
       type: "POST",
       url: "updateResources.php",
       data: {
         func: "stone",
         player_id: "1" //TODO: make this not hardcoded
       },
       success: function(result) {
           console.log(result);
       }
     });
   }
   else if(child.name == "iron"){
     ironCount += 1;
     child.setAttribute("name", "dirt");
     child.setAttribute("src", "dirt.png");

     $.ajax({
       type: "POST",
       url: "updateResources.php",
       data: {
         func: "iron",
         player_id: "1" //TODO: make this not hardcoded
       },
       success: function(result) {
           console.log(result);
       }
     });
   }
   else if(child.name == "leather"){
     leatherCount += 1;
     child.setAttribute("name", "dirt");
     child.setAttribute("src", "dirt.png");

     $.ajax({
       type: "POST",
       url: "updateResources.php",
       data: {
         func: "leather",
         player_id: "1" //TODO: make this not hardcoded
       },
       success: function(result) {
           console.log(result);
       }
     });
   }
   else if(child.name == "alcohol"){
     alcoholCount += 1;
     child.setAttribute("name", "dirt");
     child.setAttribute("src", "dirt.png");

     $.ajax({
       type: "POST",
       url: "updateResources.php",
       data: {
         func: "alcohol",
         player_id: "1" //TODO: make this not hardcoded
       },
       success: function(result) {
           console.log(result);
       }
     });
   }
   else{
     test = 0;
   }

   if(count == n){
     onWin = Date.now();
     console.log(onWin - onLoad);
     var time = (onWin - onLoad) / 1000;
     document.getElementById("winner").innerHTML = "Congrats, you won!  Number of moves: " + moves + " Time Taken: " + time;
   }
};
</script>
