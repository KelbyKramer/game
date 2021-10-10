<?php
//include("dbDefine.php");
include("src/functions.php");

$conn = dbConnect();

if(isset($_POST['craft'])){
  $building = $_POST['craft'];
  //$buildings = file_get_contents("./src/buildings.json", "buildings");
  //$buildingsArray = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $buildings), true );
  //var_dump($decodedObject);
  //var_dump($buildings);

  craftBuilding($building);
  /*
  switch($building){
    case 'town_hall':
      //Read in JSON file
      $resourcesArray = $buildingsArray['town_hall']['resources'];
      var_dump($resourcesArray);
      $sql = "SELECT ";
      $x = 1;
      foreach($resourcesArray as $resource=>$value){
        if($x == count($resourcesArray)){
          $sql .= $resource." ";
        }
        else{
          $sql .= $resource.", ";
        }
        $x++;
      }
      $sql .= " FROM resources WHERE player_id=".$_POST['player_id'];
      echo $sql;

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $wood = $row['wood'];
          $stone = $row['stone'];
          $iron = $row['iron'];
          $leather = $row['leather'];
          $wool = $row['wool'];
          $gold= $row['gold'];
          //$player_id = $row['player_id'];
        }
      }

      $player_id = $_POST['player_id'];
      $sql = "SELECT town_hall FROM buildings WHERE player_id=".$player_id;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $level = $row['town_hall'];
        }
      }

      $woodBool = (bool)($wood >= $resourcesArray['wood'] * ($level + 1));
      $stoneBool = (bool) ($stone >= $resourcesArray['stone'] * ($level + 1));
      $ironBool = (bool) ($iron >= $resourcesArray['iron'] * ($level + 1));
      $leatherBool = (bool) ($leather >= $resourcesArray['leather'] * ($level + 1));
      $woolBool = (bool) ($wool >= $resourcesArray['wool'] * ($level + 1));
      $goldBool = (bool) ($gold >= $resourcesArray['gold'] * ($level + 1));

      if($woodBool && $stoneBool && $ironBool && $leatherBool && $woolBool && $goldBool){
        //can be crafted

        echo "Level".$level;
        $newLevel = $level + 1;
        $wood -= $resourcesArray['wood'];
        $stone -= $resourcesArray['stone'];
        $iron -= $resourcesArray['iron'];
        $leather -= $resourcesArray['leather'];
        $wool -= $resourcesArray['wool'];
        $gold -= $resourcesArray['gold'];

        $sql = "UPDATE resources SET wood=$wood, stone=$stone, iron=$iron, leather=$leather, wool=$wool, gold=$gold WHERE player_id=$player_id";
        $result = $conn->query($sql);
        $sql = "UPDATE buildings SET town_hall=$newLevel WHERE player_id=$player_id";
        $result = $conn->query($sql);
        echo "test";
      }
      else{
        //can't be crafted
        echo "Can't be crafted";
      }
      break;
  }*/
}

if(isset($_POST['func'])){
  $player_id = $_POST['player_id'];
  if($_POST['func'] == "updateResources"){
    $player_id=$_POST['player_id'];
    $sql = "SELECT * FROM resources WHERE player_id=$player_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $wood = $row['wood'];
        $stone = $row['stone'];
        $iron = $row['iron'];
        $leather = $row['leather'];
        $alcohol = $row['alcohol'];
        $water = $row['water'];
        $coal = $row['coal'];
        $flint = $row['flint'];
        $wool = $row['wool'];
        $herbs = $row['herbs'];
        $gold= $row['gold'];
        $player_id = $row['player_id'];
      }
    }
    $resourceArray = array(
      "wood" => $wood,
      "stone" => $stone,
      "iron" => $iron,
      "leather" => $leather,
      "alcohol" => $alcohol,
      "water" => $water,
      "coal" => $coal,
      "flint" => $flint,
      "wool" => $wool,
      "herbs" => $herbs,
      "gold" => $gold
    );
    echo json_encode($resourceArray);
  }
  else{
    $resource = $_POST['func'];
    updateResourceCount($resource, $player_id);
  }
}
