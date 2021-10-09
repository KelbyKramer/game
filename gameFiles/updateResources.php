<?php
include("dbDefine.php");

$conn = dbConnect();



if(isset($_POST['craft'])){
  if($_POST['craft'] == "townHall"){
    $sql = "SELECT wood, stone, iron FROM resources WHERE player_id=1";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $wood = $row['wood'];
        $stone = $row['stone'];
        $iron = $row['iron'];
      }
    }
    if($wood < 100 || $stone < 50 || $iron < 50){
      echo "Insufficient resources";
      //TODO: Make this exit with return of 0 or 1
    }
    else{
      $wood -= 100;
      $stone -= 50;
      $iron -= 50;

      $sql = "UPDATE resources SET wood=$wood, stone=$stone, iron=$iron WHERE player_id=1";
      $conn->query($sql);

      //TODO: Update town hall level query
      $conn->close();
      echo "Town hall has beenc crafted!!!";
    }
  }
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
        $player_id = $row['player_id'];

      }
    }
    $resourceArray = array("wood" => $wood, "stone" => $stone, "iron" => $iron, "leather" => $leather, "alcohol" => $alcohol);
    echo json_encode($resourceArray);
  }

  //TODO: Refactor this to be function calls for each resource

  if($_POST['func'] == "wood"){
    $sql = "SELECT wood FROM resources WHERE player_id = $player_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $wood = $row['wood'];
      }
    }

    $wood++;

    $sql = "UPDATE resources SET wood=$wood WHERE player_id=$player_id";
    $result = $conn->query($sql);
  }
  else if($_POST['func'] == "stone"){
    //$player_id = $POST['player_id'];
    $sql = "SELECT stone FROM resources WHERE player_id =". $player_id;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $stone = $row['stone'];
      }
    }

    $stone++;

    $sql = "UPDATE resources SET stone=$stone WHERE player_id=$player_id";
    $result = $conn->query($sql);
  }
  else if($_POST['func'] == "leather"){
    $sql = "SELECT leather FROM resources WHERE player_id = $player_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $leather = $row['leather'];
      }
    }

    $leather++;

    $sql = "UPDATE resources SET leather=$leather WHERE player_id=$player_id";
    $result = $conn->query($sql);
  }
  else if($_POST['func'] == "iron"){
    $sql = "SELECT iron FROM resources WHERE player_id = $player_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $iron = $row['iron'];
      }
    }

    $iron++;

    $sql = "UPDATE resources SET iron=$iron WHERE player_id=$player_id";
    $result = $conn->query($sql);
  }
  else if($_POST['func'] == "alcohol"){
    //$player_id = $POST['player_id'];
    $sql = "SELECT alcohol FROM resources WHERE player_id = $player_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $alcohol = $row['alcohol'];
      }
    }

    $alcohol++;

    $sql = "UPDATE resources SET alcohol=$alcohol WHERE player_id=$player_id";
    $result = $conn->query($sql);
  }
}

 ?>
