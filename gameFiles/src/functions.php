<?php
include("dbDefine.php");
define("IMAGE_PATH", "./src/images/");

function login($username, $password){
  $conn = dbConnect();
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "SELECT player_id, Password FROM persons WHERE Username='$username'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    //login credentials were successful

    while($row = $result->fetch_assoc()) {
      $hashFromDatabase = $row['Password'];
      $player_id = $row['player_id'];
    }

    if(!password_verify($password, $hashFromDatabase)){
      echo "Password is invalid";
    }
    else{
      session_start();
      $_SESSION['player_id'] = $player_id;
      header("location: dashboard.php?player_id=".$player_id);
    }
  }
  else{
    echo "<center>Credentials were not successful</center>";
  }
}

function registerUser($username, $password, $email){
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO persons (Username, Password, email) VALUES ('$username', '$hashed_password', '$email')";
  $conn = dbConnect();
  $result = $conn->query($sql);

  $sql = "SELECT player_id, password FROM persons WHERE Username = '$username' AND email = '$email' ";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()) {
    $player_id = $row['player_id'];
    $password_verify = $row['password'];
  }
  if(password_verify($password, $password_verify)){
    //Add player_id to resources and buildings tables
    $sql = "INSERT INTO resources(player_id) VALUES($player_id)";
    $result = $conn->query($sql);

    $sql = "INSERT INTO buildings(player_id) VALUES($player_id)";
    $result = $conn->query($sql);

    header("Location: index.php");
  }
  else{
    echo "Passwords did not match up";
  }

  $_POST = array();

}
function updateResourceCount($resource, $player_id){
  $conn = dbConnect();
  $sql = "SELECT $resource FROM resources WHERE player_id = $player_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $quantity = $row[$resource];
    }
  }
  echo $resource;
  $quantity++;

  $sql = "UPDATE resources SET $resource=$quantity WHERE player_id=$player_id";
  $result = $conn->query($sql);

}

function craftBuilding($building){
  $buildings = file_get_contents("./src/buildings.json", "buildings");
  $buildingsArray = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $buildings), true );

  $resourcesArray = $buildingsArray[$building]['resources'];
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
  //echo $sql;

  $conn = dbConnect();
  $result = $conn->query($sql);

  $array = array();
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //TODO: FIgure this out and use JSON object to advantage
      $array = $row;
    }
  }

  $player_id = $_POST['player_id'];
  $sql = "SELECT $building FROM buildings WHERE player_id=".$player_id;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $level = $row[$building];
    }
  }
  $level++;
  $craftable = true;
  foreach($array as $key=>$value){
    if($array[$key] >= $resourcesArray[$key] * $level){
      //have enough of that resource
      //echo "There is enough";
    }
    else{
      //Don't have enough of that resource
      $craftable = false;
      //echo "There is not enough ".$key;
    }
  }

  //echo $craftable;

  if($craftable){
    //subtract values and update them in database
    //update level in buildings table
    foreach($array as $key=>$value){
      $array[$key] -= $resourcesArray[$key] * $level;
      //echo $key." ".$array[$key];
    }

    $sql = "SELECT prestige FROM resources WHERE player_id=".$_POST['player_id'];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $prestige = $row['prestige'];
      }
    }
    //echo "Prestige: ".$prestige;
    $prestige += $buildingsArray[$building]['prestige'];

    $sql = "UPDATE resources SET ";

    foreach($array as $resource=>$value){
      $sql .= $resource."=".$array[$resource].", ";
    }

    $sql .= " prestige=$prestige WHERE player_id=".$_POST['player_id'];
    $result = $conn->query($sql);
    //echo $sql;
    $sql = "UPDATE buildings SET $building=$level WHERE player_id=$player_id";
    $result = $conn->query($sql);
    //echo $sql;
    echo "Building Upgraded!";
    //TODO: after crafting, update necessary resources in real time
  }
  else{
    echo "Insufficient Resources!";
    //TODO: Display on screen which resources are lacking
  }
}

function generateResourceList($buildingFileName){
  $resourceArray = file_get_contents("./src/buildings.json", "buildings");
  $JSONArray = json_decode($resourceArray, true);
  $conn = dbConnect();
  $sql = "SELECT $buildingFileName FROM buildings WHERE player_id=".$_SESSION['player_id'];
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $level= $row[$buildingFileName];
    }
  }
  $prestige = $JSONArray[$buildingFileName]['prestige'];
  $listOfResources = $JSONArray[$buildingFileName]['resources'];
  $ret = "";
  $ret .= "<ul class='float-right'>";

  $ret .= "<li style='background-color:#b5c308;'>Level ".$level."</li>";
  foreach($listOfResources as $key => $value){
    $quantity = ($level + 1) * $value;
    $ret .= "<li>".$quantity."x ".$key."</li>";
  }
  $prestige = ($level + 1) * $prestige;
  $ret .= "<li style='background-color:#03ea0d;'>".$prestige."x Prestige</li>";

  $ret .= "</ul>";
  return $ret;
}

function generateBuildingInfo($buildingFileName, $buildingName){
  $buildingQuoteName = "craftBuilding("."'".$buildingFileName."'".")";
  $hello = "parameter";
  $ret = "";
  $ret .="<div style='width: 100%; overflow: hidden;'>";
  $ret .= "<div style='float: left; margin-top: 40px; width:100px;'> $buildingName </div>";
  $ret .= "<div style='float:left;''> <img src='./src/images/$buildingFileName.png' style='width:100px; height:100px; margin-left:20px;'/></div>";
  $ret .= "<div style='float:left; margin-left:10px; margin-top:25px;'>";
  $ret .= generateResourceList($buildingFileName);
  $ret .= "</div>";
  switch($buildingFileName){
    case "town_hall":
      $ret .= '<button id="crafttown_hall" onclick="craftBuilding(\'town_hall\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "brewery":
      $ret .= '<button id="craftbrewery" onclick="craftBuilding(\'brewery\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "butcher":
      $ret .= '<button id="craftbutcher" onclick="craftBuilding(\'butcher\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "tailor":
      $ret .= '<button id="crafttailor" onclick="craftBuilding(\'tailor\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "lumberMill":
      $ret .= '<button id="craftlumbermill" onclick="craftBuilding(\'lumberMill\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "blacksmith":
      $ret .= '<button id="craftblacksmith" onclick="craftBuilding(\'blacksmith\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "herbalist":
      $ret .= '<button id="craftherbalist" onclick="craftBuilding(\'herbalist\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "cemetery":
      $ret .= '<button id="craftcemetery" onclick="craftBuilding(\'cemetery\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "chapel":
      $ret .= '<button id="craftchapel" onclick="craftBuilding(\'chapel\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
    case "school":
      $ret .= '<button id="craftschool" onclick="craftBuilding(\'school\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
      break;
  }
  //$ret .= '<button id="crafttown_hall" onclick="craftBuilding(\'town_hall\')" style="margin-left:25px; margin-top:50px; height:50px;width:150px;">Craft</button>';
  $ret .= "</div>";

  return $ret;
}
function generatePit(){
  $ret = "<div id='arena' class='border border-dark' style='height: 1750px; width: 1750px;'>";
  $ret = "<div id='boxesFinal' class='border border-dark' style='height: 1750px; width: 1750px;'>";

  for($i = 0; $i < 50; $i++){
    for($j = 0; $j < 50; $j++){
      //coordinates of each block
      $xCoord = $i * 35;
      $yCoord = $j * 35;
      $xString = $xCoord."px";
      $yString = $yCoord."px";
      $resource = rand(0, 999);

      $resourceType = "";
      if($resource < 749){
        $resourceType = "dirt.png";
        $resourceName = "dirt";
      }
      else if($resource > 750 && $resource < 800){
        $resourceType = "wood.png";
        $resourceName = "wood";
      }
      else if($resource > 800 && $resource < 850){
        $resourceType="stone.png";
        $resourceName = "stone";
      }
      else if($resource > 850 && $resource < 870){
        $resourceType="iron.png";
        $resourceName = "iron";
      }
      else if($resource > 870 && $resource < 894){
        $resourceType="leather.png";
        $resourceName = "leather";
      }
      else if($resource == 895){
        $resourceType="gold.png";
        $resourceName = "gold";
      }
      else if($resource > 895 && $resource < 920){
        $resourceType="flint.png";
        $resourceName = "flint";
      }
      else if($resource > 920 && $resource < 930){
        $resourceType="alcohol.png";
        $resourceName = "alcohol";
      }
      else if($resource > 930 && $resource < 950){
        $resourceType="wool.png";
        $resourceName = "wool";
      }
      else if($resource > 950 && $resource < 970){
        $resourceType="herbs.png";
        $resourceName = "herbs";
      }
      else if($resource > 970 && $resource < 985){
        $resourceType="water.png";
        $resourceName = "water";
      }
      else if($resource > 985){
        $resourceType="coal.png";
        $resourceName = "coal";
      }

      if($resourceType == ""){
        $resourceType="dirt.png";
      }

      $ret .= "<div id='$xCoord $yCoord' class='border border-primary' style='z-index:-1; margin-left:$xString; margin-top:$yString;  height: 35px; width: 35px; position: absolute;'>";
      $ret .="<img src=/zoom/src/images/$resourceType name=$resourceName width='35' height='35'/>";
      $ret .= "</div>";
    }
  }
  $ret .= "</div>";
  $ret .= "</div>";
  echo $ret;
}


 ?>
