<?php
session_start();
$player_id = $_GET['player_id'];
include("src/functions.php");
if($player_id != $_SESSION['player_id']){
  header("Location:restrict.php");
}
 ?>

<div id="moves">
  Moves: 0
</div>


<div style='position: fixed; top: 0em; right: 0em; background-color:white' class='border border-dark'>
    <button>
      <a href='logout.php' style='width:150px;'>Logout</a>
    </button>
</div>

  <div id='resourceCount' style='position: fixed; top: 2em; right: 1em; pointer-events: none; background-color:white' class='border border-dark' readonly = 'readonly'>
    <div id='woodCount'>Wood: <span id="woodSpan">0</span></div>
    <div id='stoneCount'>Stone: <span id="stoneSpan">0</span></div>
    <div id='leatherCount'>Leather: <span id="leatherSpan">0</span></div>
    <div id='ironCount'>Iron: <span id="ironSpan">0</span></div>
    <div id='alcoholCount'>Alcohol: <span id="alcoholSpan">0</span></div>
    <div id='waterCount'>Water: <span id="waterSpan">0</span></div>
    <div id='coalCount'>Coal: <span id="coalSpan">0</span></div>
    <div id='flintCount'>Flint: <span id="flintSpan">0</span></div>
    <div id='woolCount'>Wool: <span id="woolSpan">0</span></div>
    <div id='herbsCount'>Herbs: <span id="herbsSpan">0</span></div>
    <div id='goldCount'>Gold: <span id="goldSpan">0</span></div>
  </div>

  <button type="button" style='position: fixed; top: 20em; right: 1em; height:150px; width:150px; background-color:white;' data-toggle="modal" data-target="#myModal">
    <img src='./src/images/book.png' style='height:100px; width:100px;'/>
    <div>Building and Crafting Recipes</div>
  </button>

  <button type="button" style='position: fixed; top: 30em; right: 1em; height:150px; width:150px; background-color:white;' data-toggle="modal" data-target="#leaderboard">
    <img src='./src/images/village.png' style='height:100px; width:100px;'/>
    <div>Leaderboard</div>
  </button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div id="confirmMessage"></div>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Recipes</h4>
      </div>
      <div class="modal-body">
        <?php
          echo generateBuildingInfo("town_hall", "Town Hall");
          echo generateBuildingInfo("brewery", "Brewery");
          echo generateBuildingInfo("butcher", "Butcher");
          echo generateBuildingInfo("tailor", "Tailor");
          echo generateBuildingInfo("lumberMill", "Lumber Mill");
          echo generateBuildingInfo("blacksmith", "Blacksmith");
          echo generateBuildingInfo("herbalist", "Herbalist");
          echo generateBuildingInfo("cemetery", "Cemetery");
          echo generateBuildingInfo("chapel", "Chapel");
          echo generateBuildingInfo("school", "School");
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="leaderboard" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Global Leaderboard</h4>
      </div>
      <div class="modal-body">
          <div>
            <?php
              $sql = "SELECT resources.player_id, resources.prestige, persons.Username FROM resources INNER JOIN persons ON resources.player_id=persons.player_id";
              $conn = dbConnect();

              $result = $conn->query($sql);
              $unsortedArray = array();
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $unsortedArray[$row['Username']] = $row['prestige'];
                }
              }
              arsort($unsortedArray);
              //TODO: Make this look better
              foreach($unsortedArray as $key=>$value){
                $ret = "";
                $ret .="<div>";
                $ret .= $key." ".$value;
                $ret .= "</div>";
                echo $ret;
              }
             ?>
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class='d-flex justify-content-center'>
  <button type="button" class="btn btn-warning " style="width:300px; height:75px;" onClick="window.location.reload();"><span class="h1" style="color:black;">Refresh Pit</span></button>
</div>

<div id="overlay"></div>
<div id='playerFinal' class='flex-fill' style='width: 35px; height: 35px; background-color: black; z-index: 1; position: absolute;'>
  <img src="./src/images/player.png" style='width:35px; height:35px;'/>
</div>

<?php
//$resourceOptions = ['wood', 'iron', 'alcohol', 'leather', 'stone', 'dirt', 'flint', 'herbs', 'water', 'gold', 'wool'];
generatePit();
 ?>
<head>
          <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          <script src="./src/script.js"></script>

</head>
<script>
x = 0;
y = 0;
moves = 0;
var get_player_id = -1;

$(document).ready(function() {
  //Get player_id from URL
  var url_string = window.location.href;
  var url = new URL(url_string);
  get_player_id = url.searchParams.get("player_id");

  //Every 5 seconds, query the database to update the user totals for resources
  (function updateResourceList() {
  $.ajax({
    type: 'POST',
    url: 'updateResources.php',
    data: {
      func:"updateResources",
      player_id:get_player_id
    },
    success: function(data) {
      var parsedData = JSON.parse(data);

      $('#woodSpan').html(parsedData['wood']);
      $('#stoneSpan').html(parsedData['stone']);
      $('#leatherSpan').html(parsedData['leather']);
      $('#ironSpan').html(parsedData['iron']);
      $('#alcoholSpan').html(parsedData['alcohol']);
      $('#waterSpan').html(parsedData['water']);
      $('#coalSpan').html(parsedData['coal']);
      $('#flintSpan').html(parsedData['flint']);
      $('#woolSpan').html(parsedData['wool']);
      $('#herbsSpan').html(parsedData['herbs']);
      $('#goldSpan').html(parsedData['gold']);
    },
    complete: function() {
      // Schedule the next request when the current one's complete
      setTimeout(updateResourceList, 5000);
    }
  });
})();
 });
//On movement, move the player and update resources accordingly
document.onkeydown = function (event) {
   moveHandler(event.keyCode);
   var tile = document.getElementById(x + " " + y);
   var child = tile.firstChild;
   resourceUpdateAJAX(child.name, child);
};

</script>
