//february 13,2016
//snake game v1.1


function init() {

  //set up the canvas
  snakeCanvas = document.getElementById('snakeCanvas');
  canvas = snakeCanvas.getContext('2d');

  //add event listener
  window.addEventListener("keydown", keydownfunc);

  //frame variables
  frameWidth = 587;
  frameHeight = 482;

  //some colors
  color = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple"];
  colorCycle = 0;
  currentColor = color[colorCycle];

  //snake variables for start
  segmentCount = 1;
  headLoc = 1
  tailLoc = 0

  //make segments and store their positions
  segment = [];
  segment[0] = [0, 0];
  segment[1] = [0, 1];

  //other stuff
  play = "False";
  direction = "down";
  score = 0;
  
  //make background
  canvas.fillStyle = "grey";
  canvas.fillRect(0, 0, 600, 500);
  
    //first dot location
  dot = [(Math.floor(Math.random() * 28)) , (Math.floor(Math.random() * 23)) ];
  canvas.fillStyle = "red";
  canvas.fillRect((dot[0] * 21), (dot[1] * 21), 20, 20);

  //print first 2 segments
  canvas.fillStyle = "blue";
  canvas.fillRect((segment[0][0] * 21), (segment[0][1] * 21), 20, 20);
  canvas.fillRect((segment[1][0] * 21), (segment[1][1] * 21), 20, 20);

  
  startStuff();
}

function keydownfunc() {

  //get key code
  var x = event.keyCode;

  //print keycode
  console.log("keydown: " + x);

  switch (x) {
    case 38: //up arrow
      console.log("up");
      if (play == "True" && direction != "down") {
        direction = "up";
      }
      break;
    case 87: //w key
      console.log("up");
      if (play == "True" && direction != "down") {
        direction = "up";
      }
      break;
    case 40: //down arrow
      console.log("down");
      if (play == "True" && direction != "up") {
        direction = "down";
      }
      break;
    case 83: //s key
      console.log("down");
      if (play == "True" && direction != "up") {
        direction = "down";
      }
      break;
    case 39: //right arrow
      console.log("right");
      if (play == "True" && direction != "left") {
        direction = "right";
      }
      break;
    case 68: //d key
      console.log("right");
      if (play == "True" && direction != "left") {
        direction = "right";
      }
      break;
    case 37: //left arrow
      console.log("left");
      if (play == "True" && direction != "right") {
        direction = "left";
      }
      break;
    case 65: //a key
      console.log("left");
      if (play == "True" && direction != "right") {
        direction = "left";
      }
      break;
    case 13: //enter key
      console.log("enter");
      if (play == "True") {
        play = "False";
      } else {
        play = "True";
      }

      break;
    default:
      //do nothing
  }

}


function startStuff() {
  timer = setInterval(gameLoop, 100);
}

function gameLoop() {
  
  //check if game has been started yet
  if (play == "True") {
    
   //delete the tail
    canvas.fillStyle = "grey";
    canvas.fillRect((segment[tailLoc][0] * 21), (segment[tailLoc][1] * 21), 20, 20);
    
    switch (direction) {
      case "up":
       
        //calculate the new position
        segment[tailLoc][1] = segment[headLoc][1] - 1;
        segment[tailLoc][0] = segment[headLoc][0];
        //check to see if it hit the edge, itself, or ate a dot
        check();
        
        break;
      case "down":
        
        //calculate the new position
        segment[tailLoc][1] = segment[headLoc][1] + 1;
        segment[tailLoc][0] = segment[headLoc][0];
        //check to see if it hit the edge, itself, or ate a dot
        check();
        
        break;
      case "right":

        //calculate the new position
        segment[tailLoc][0] = segment[headLoc][0] + 1;
        segment[tailLoc][1] = segment[headLoc][1];
        //check to see if it hit the edge, itself, or ate a dot
        check();
        
        break;
      case "left":
        
        //calculate the new position
        segment[tailLoc][0] = segment[headLoc][0] - 1;
        segment[tailLoc][1] = segment[headLoc][1];
        //check to see if it hit the edge, itself, or ate a dot
        check();
        
        break;
      default:
        //this shouldnt hapen
    }
    
    
    //change the headlocation
    headLoc = tailLoc;

    //print the new head
    canvas.fillStyle = "blue";
    canvas.fillRect((segment[headLoc][0] * 21), (segment[headLoc][1] * 21), 20, 20);


    //give the tail location
    if (tailLoc == segmentCount) {
      tailLoc = 0;
    } else {
      tailLoc++;
    }
    
  }
}


function check(){
  if ((segment[tailLoc][0]*21) < 0 || (segment[tailLoc][0]*21) > frameWidth || (segment[tailLoc][1]*21) < 0 || (segment[tailLoc][1]*21) > frameHeight){
    play = "False";
    direction = "null"
    document.getElementById("status").innerHTML = "Status: Hit a Wall";
    
  }else if(segment[tailLoc][0] == dot[0] && segment[tailLoc][1] == dot[1]){
    document.getElementById("status").innerHTML = "Status: ate a dot";
    score = score + 100;
    document.getElementById("score").innerHTML = "Score: "+ score;
    //add new links
    for (i = 1; i < 4; i++){
      segmentCount++;
      segment[segmentCount] = [segment[tailLoc][0], segment[tailLoc][0]];
    }
    
    newDot = "False";
    
    //create a new dot that is not on the snake
    while (newDot == "False"){
      for ( i = 0; i < segmentCount; i++){
        
        //give the dot a new random position
        dot = [(Math.floor(Math.random() * 28)) , (Math.floor(Math.random() * 23)) ];
        
        //check if it was placed on the snake
        if (dot[0] !=  segment[i][0] && dot[1] != segment[i][1]){
          //no
          console.log("dot true");
          newDot = "True";
        }else{
          //yes then break and repeat the whole check until every segment says false
          console.log("dot false");
          newDot = "False";
          break;
        }
      }
      
    }
    
    canvas.fillStyle = "red";
    canvas.fillRect((dot[0] * 21), (dot[1] * 21), 20, 20);
    
  }
}

