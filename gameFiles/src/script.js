

function craftBuilding(building){
  console.log(building);

  $.ajax({
    type: "POST",
    url: "updateResources.php",
    data: {
      craft: building,
      player_id: get_player_id//TODO: make this not hardcoded
    },
    success: function(result) {
        console.log(result);
        $('#confirmMessage').html(result);
    }
  });
}

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

function moveHandler(keyCode){

  switch (keyCode) {
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
}

function resourceUpdateAJAX(resource, child){
  if(resource == "dirt"){
    console.log("it's dirt");
    return;
  }

  child.setAttribute("name", "dirt");
  child.setAttribute("src", "./src/images/dirt.png");

  $.ajax({
    type: "POST",
    url: "updateResources.php",
    data: {
      func: resource,
      player_id: get_player_id //TODO: make this not hardcoded
    },
    success: function(result) {
        console.log(result);
    }
  });
}
