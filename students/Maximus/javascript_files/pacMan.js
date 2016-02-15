
function init(){
  //frame variables
  width = 1080;
  height = 560;
  
  //game variables
  play = "False";
  direction = "none";
  gridSize = 40;
  
  //color variables
  color = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple"];
  colorCycle = 0;
  currentColor = color[colorCycle];
  
  //set up the canvas
  pacManCanvas = document.getElementById('pacManCanvas');
  canvas = pacManCanvas.getContext('2d');
  
  //create any eventlisteners
  window.addEventListener("keydown",keydownfunc);
  
  //start the gameloop
  startStuff();
}

function startStuff() {
  timer = setInterval(gameLoop, 100);
}


function gameLoop(){
  
  //draw probably
  draw();
}



function draw(){
  
  //draw background
  canvas.fillStyle = "pink";
  canvas.fillRect(0,0,1080,560);
  
  x = 0;
  y = 0;
  
  for (i = 0; i < 14; i++){
    
    x = 0;
    
    for (b = 0; b < 27; b ++){
      colorCycle = Math.floor(Math.random() * 6);
      canvas.fillStyle = color[colorCycle];
      canvas.fillRect(x ,y , gridSize, gridSize);
      
      x = x + gridSize;
      
    }
    
    y = y + gridSize;
    
  }
  
}


//process key events
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