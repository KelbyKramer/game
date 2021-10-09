<?php
session_start();
$player_id = $_GET['player_id'];

if($player_id != $_SESSION['player_id']){
  header("Location:restrict.php");
}
 ?>

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
<button type="button" style='position: fixed; top: 10em; right: 1em; height:150px; width:150px; background-color:white;' data-toggle="modal" data-target="#myModal">

  <img src='book.png' style='height:100px; width:100px;'/>
  <div>Building and Crafting Recipes</div>
</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Recipes</h4>
                  </div>
                  <div class="modal-body">
                      <div>
                        Here is where the meat and potatoes of the crafting recipes will go
                      </div>
                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Town Hall </div>
                            <div style="float:left;"> <img src='town-hall.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>100x Wood</li>
                                <li>50x Stone</li>
                                <li>50x Iron</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Brewery </div>
                            <div style="float:left;"> <img src='brewery.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>10x Alcohol</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Butcher Shop </div>
                            <div style="float:left;"> <img src='butcher.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>25x Leather</li>
                                <li>10x Leather</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Town Hall </div>
                            <div style="float:left;"> <img src='town-hall.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>100x Wood</li>
                                <li>50x Stone</li>
                                <li>50x Iron</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Brewery </div>
                            <div style="float:left;"> <img src='brewery.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>10x Alcohol</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Butcher Shop </div>
                            <div style="float:left;"> <img src='butcher.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>25x Leather</li>
                                <li>10x Leather</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Town Hall </div>
                            <div style="float:left;"> <img src='town-hall.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>100x Wood</li>
                                <li>50x Stone</li>
                                <li>50x Iron</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Brewery </div>
                            <div style="float:left;"> <img src='brewery.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>10x Alcohol</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Butcher Shop </div>
                            <div style="float:left;"> <img src='butcher.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>25x Leather</li>
                                <li>10x Leather</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Town Hall </div>
                            <div style="float:left;"> <img src='town-hall.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>100x Wood</li>
                                <li>50x Stone</li>
                                <li>50x Iron</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Brewery </div>
                            <div style="float:left;"> <img src='brewery.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>10x Alcohol</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                        <div style="width: 100%; overflow: hidden;">
                            <div style="float: left; margin-top: 40px; width:100px;"> Butcher Shop </div>
                            <div style="float:left;"> <img src='butcher.png' style="width:100px; height:100px; margin-left:20px;"/></div>
                            <div style="float:left; margin-left:10px; margin-top:25px;">
                              <ul class='float-right'>
                                <li>50x Wood</li>
                                <li>50x Stone</li>
                                <li>25x Leather</li>
                                <li>10x Leather</li>
                              </ul>

                            </div>
                            <button id="craftTownHall" onclick="craftTownHall()" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>
                        </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
<!--TODO: Have this button contain village statistics and information -->


<button type="button" style='position: fixed; top: 20em; right: 1em; height:150px; width:150px; background-color:white;' data-toggle="modal" data-target="#villageStats">

  <img src='village.png' style='height:100px; width:100px;'/>
  <div>Village Statistics</div>
</button>

<div class="modal fade" id="villageStats" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Recipes</h4>
      </div>
      <div class="modal-body">
          <div>
            Here is where the meat and potatoes of the crafting recipes will go
          </div>

        </div>
          Power: 0 power
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--
            <button type="button" style='position: fixed; top: 10em; right: 1em; height:150px; width:150px; background-color:white;' data-toggle="modal" data-target="#myModal">

              <img src='village.png' style='height:100px; width:100px;'/>
              <div>Village Statistics</div>
            </button>

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Recipes</h4>
                              </div>
                              <div class="modal-body">



                                  Here is where the meat and potatoes of the crafting recipes will go
                                  <div class="border border-dark">
                                    Town Hall
                                    <button id="craftTownHall" onclick="craftTownHall()">Craft</button>
                                  </div>

                                  <div class="border border-dark">
                                    Brewery
                                  </div>

                                  <div class="border border-dark">
                                    Butcher
                                  </div>







                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>-->


<div id="overlay"></div>
<div id='playerFinal' class='flex-fill' style='width: 35px; height: 35px; background-color: black; z-index: 1; position: absolute;'>

  <img src="player.png" style='width:35px; height:35px;'/>
</div>

<?php
//TODO: Have player id be set in the GET of the url upon Login
//TODO: set up permissions for the player id in the GET of the url
//TODO: set a session variable on login that is equivalent to the player_id
//TODO: If the get ID and the session variable do not match, then the session is opcache_invalid
//TODO: and the user will get logged out
include("src/functions.php");



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
  <!--
  <script
  			  src="https://code.jquery.com/jquery-3.6.0.min.js"
  			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  			  crossorigin="anonymous"></script>


          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<script>

function craftTownHall(){
  console.log("Town hall has been crafted");

  $.ajax({
    type: "POST",
    url: "updateResources.php",
    data: {
      craft: "townHall",
      player_id: get_player_id//TODO: make this not hardcoded
    },
    success: function(result) {
        console.log(result);
    }
  });


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
var get_player_id = -1;

$(document).ready(function() {
  console.log(Date.now());
  onLoad = Date.now();

  var url_string = window.location.href;
  var url = new URL(url_string);
  get_player_id = url.searchParams.get("player_id");

  //Every 10 seconds, query the database to update the user totals for resources
  (function updateResourceList() {
  $.ajax({
    type: 'POST',
    url: 'updateResources.php',
    data: {
      func:"updateResources",
      player_id:get_player_id
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

   //TODO: refactor these into functions, and figure out how to softcode player_id
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
         player_id: get_player_id //TODO: make this not hardcoded
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
         player_id: get_player_id //TODO: make this not hardcoded
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
         player_id: get_player_id //TODO: make this not hardcoded
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
         player_id: get_player_id //TODO: make this not hardcoded
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
         player_id: get_player_id //TODO: make this not hardcoded
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
