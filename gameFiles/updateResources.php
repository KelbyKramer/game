<?php
include("dbDefine.php");

$conn = dbConnect();

if($_POST['func'] == "updateResources"){
  $player_id = "1";
  $sql = "SELECT * FROM resources WHERE player_id =1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
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

if(isset($_POST['func'])){
  $player_id = "1";
  if($_POST['func'] == "wood"){
    //$player_id = $POST['player_id'];
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
    $player_id = "1";
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
    //$player_id = $POST['player_id'];
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
    //$player_id = $POST['player_id'];
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
