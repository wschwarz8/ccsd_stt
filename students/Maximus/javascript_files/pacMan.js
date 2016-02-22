function init() {

  getTexture();
  lvl1();

  //frame variables
  width = 1050;
  height = 600;

  //game variables
  play = "False";
  direction = "none";
  gridSize = 50;
  pacManx = gridSize;
  pacMany = gridSize;
  
  moveComplete = "True";

  //color variables
  color = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple"];
  colorCycle = 0;
  currentColor = color[colorCycle];

  //set up the canvas
  pacManCanvas = document.getElementById('pacManCanvas');
  canvas = pacManCanvas.getContext('2d');

  //create any eventlisteners
  window.addEventListener("keydown", keydownfunc);

  //start the gameloop
  startStuff();
}

function startStuff() {
  timer = setInterval(gameLoop, 70);
}


function gameLoop() {

  //move pacman
  move();
  
  //draw
  draw();
}



function draw(){
  
  //draw background
  canvas.fillStyle = "#804000";
  canvas.fillRect(0, 0, 1050, 600);


  //draw textures
  x = 0;
  y = 0;

  for (i = 0; i < 12; i++) {

    x = 0;

    for (b = 0; b < 21; b++) {

      canvas.drawImage(texture[levelRow[i][b]], x, y,gridSize,gridSize);

      x = x + gridSize;

    }

    y = y + gridSize;

  }


  //draw pacman
  canvas.drawImage(texture[2], pacManx, pacMany,gridSize,gridSize);

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
      if (play == "True") {
        
        direction = "up";

      }
      break;
    case 87: //w key
      console.log("up");
      if (play == "True") {
        
        direction = "up";

      }
      break;
    case 40: //down arrow
      console.log("down");
      if (play == "True") {
        
        direction = "down";

      }
      break;
    case 83: //s key
      console.log("down");
      if (play == "True") {
        
        direction = "down";

      }
      break;
    case 39: //right arrow
      console.log("right");
      if (play == "True") {
        
        direction = "right";

      }
      break;
    case 68: //d key
      console.log("right");
      if (play == "True") {
        
        direction = "right";

      }
      break;
    case 37: //left arrow
      console.log("left");
      if (play == "True") {
        
        direction = "left";

      }
      break;
    case 65: //a key
      console.log("left");
      if (play == "True") {
        
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



function move() {
  
  if (play == "True") {
    
    
    if (moveComplete == "True"){
      switch (direction) {
        case "up":

          checkMove();

          if (check == "False"){
            break;
          }
          
          //calculate new pack man position
          newPacMany = pacMany - gridSize;
          newPacManx = pacManx;
          
          pacMany = pacMany - 10;
          lastTrueDirection = "up";
          
          moveComplete = "False";

          break;
        case "down":

          checkMove();

          if (check == "False"){
            break;
          }
          
          //calculate new pack man position
          newPacMany = pacMany + gridSize;
          newPacManx = pacManx;
          
          pacMany = pacMany + 10;
          lastTrueDirection = "down";
          
          moveComplete = "False";

          break;
        case "left":

          checkMove();

          if (check == "False"){
            break;
          }
          
          //calculate new pack man position
          newPacManx = pacManx - gridSize;
          newPacMany = pacMany;
          
          pacManx = pacManx - 10;
          lastTrueDirection = "left";
          
          moveComplete = "False";

          break;
        case "right":

          checkMove();
          
          if (check == "False"){
            break;
          }

          //calculate new pack man position
          newPacManx = pacManx + gridSize;
          newPacMany = pacMany;
          
          pacManx = pacManx + 10;
          lastTrueDirection = "right";
          
          moveComplete = "False";

          break;
        default:
          //this shouldnt happen
      }
    }else if(moveComplete == "False"){
      console.log("hi");
      if (pacManx == newPacManx && pacMany == newPacMany){
        moveComplete ="True";
      }else{
        switch (lastTrueDirection) {
        case "up":

          pacMany = pacMany - 10;
       
          break;
        case "down":

          pacMany = pacMany + 10;
          break;
        case "left":

          pacManx = pacManx - 10;

          break;
        case "right":

          pacManx = pacManx + 10;

          
        default:
          //this shouldnt happen
      }
      }
    }
    
    
  }
}

function checkMove(){
  
  //find coordinate position
  xGridPos = (pacManx/gridSize);
  yGridPos = (pacMany/gridSize);
  
  
  switch (direction) {
        case "up":

          if (levelRow[yGridPos - 1][xGridPos] == 1){
                check = "False";
           }else{
             check = "True";
           }
      
          break;
        case "down":

          if (levelRow[yGridPos + 1][xGridPos] == 1){
                check = "False";
           }else{
             check = "True";
           }
      
          break;
        case "left":

          if (levelRow[yGridPos][xGridPos - 1] == 1){
                check = "False";
           }else{
             check = "True";
           }

          break;
        case "right":
      
          
          if (levelRow[yGridPos][xGridPos + 1] == 1){
               check = "False";
           }else{
             check = "True";
           }
          
        default:
          //this shouldnt happen
      }
  
  
  
}


