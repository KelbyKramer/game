<?php
include("dbDefine.php");


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
    //login credentials were not successful
    //header("location: restrict.php");
    echo "Credentials were not successful";
    echo $password;
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
    $sql = "INSERT INTO resources(player_id) VALUES($player_id)";

    $result = $conn->query($sql);

    header("Location: dashboard.php?player_id=".$player_id);
  }
  else{
    echo "Passwords did not match up";
  }

  $_POST = array();

}


 ?>
