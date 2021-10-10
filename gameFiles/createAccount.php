<?php

include("src/functions.php");

if(isset($_POST) && count($_POST) > 0){
  $errorCount = 0;
  if($_POST['userName'] == "" || !(isset($_POST['userName']))){
    echo "Username cannot be blank";
    $errorCount++;
  }

  if($_POST['email'] == "" || !(isset($_POST['email']))){
    echo "Email cannot be blank";
    $errorCount++;
  }

  //passwords dont match
  if($_POST['password'] != $_POST['re-password']){
    echo "Passwords don't match";
    $errorCount++;
  }
  //passwords arent sufficient length
  if(strlen($_POST['password']) < 6 && strlen($_POST['re-password']) < 6){
    echo "Password must be at least 6 characters long";
    $errorCount++;
  }

  $conn = dbConnect();
  $username = $_POST['userName'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  $sql = "SELECT * FROM persons WHERE Username='$username'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    //username is taken
    echo "Username is alreay taken";
    $errorCount++;
  }
  //At this point, the user has created a valid Account
  if($errorCount == 0){
    registerUser($username, $password, $email);
  }

}




 ?>

<center>
 <form method='post' action=''>

  <div class='d-flex justify-content-center'>
     <input id="field" name='userName' type="text" style='width: 400px; height: 50px; font-size:20px;' placeholder='Username' autocomplete='off'/>
   </div>
   <div class='d-flex justify-content-center' id="email">
     <input id="email" name='email' type="text" style='width: 400px; height: 50px; font-size:20px;' placeholder='E-mail' autocomplete='off'/>
   </div>
 <div class='d-flex justify-content-center' id="password">
   <input id="password" name='password' type="password" style='width: 400px; height: 50px; font-size:20px;' placeholder='Password' autocomplete='off'/>
 </div>
 <div class='d-flex justify-content-center' id="re-password">
   <input id="re-password" name='re-password' type="password" style='width: 400px; height: 50px; font-size:20px;' placeholder='Password' autocomplete='off'/>
 </div>
 <div class='d-flex justify-content-center'>
   <input type='submit' class='d-flex justify-content-center' style='width: 400px; height: 50px;' />
 </div>

 </form>
</center>
