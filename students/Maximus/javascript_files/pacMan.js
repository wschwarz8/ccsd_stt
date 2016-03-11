function init() {

  //grid size of the game
  gridSize = 30;

  lvl1();

  //frame variables
  width = 1050;
  height = 600;

  //-------game variables--------
  //game mode
  play = "False";

  //pacman mouth angles for start
  topMouthAngle = 0;
  bottomMouthAngle = 0;

  //pacman eye heigth
  eyePosition = 12;

  //needed to prevent errors in movement
  pacCheck = "False";
  check = "False";
  moveComplete = "True";
  movementMemory = 0;
  mode = "normal";


  //debug variables
  debug = "False"; //make this true for trouble shooting

  //timing variables
  flashCycle = 0;
  frameCount = 0;
  seconds = 0;

  //background gradient variables
  gradx1 = 0;
  gradx2 = 0;
  gradx3 = 1050;
  gradx4 = 0;

  //color pallet for easy changing
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
if (play == "True"){
  
  frameCount++;
  
  if (frameCount == 15){
      frameCount = 0;
      seconds = seconds + 1;
  }
  
  //move pacman
  movePacman();

  //move ghost
  moveGhost();
}
  //draw
  draw();

}


//process key events
function keydownfunc() {

  //get key code
  var x = event.keyCode;

  switch (x) {
    case 38: //up arrow

      if (play == "True") {

        direction = "up";

      }
      break;
    case 87: //w key

      if (play == "True") {

        direction = "up";

      }
      break;
    case 40: //down arrow

      if (play == "True") {

        direction = "down";

      }
      break;
    case 83: //s key

      if (play == "True") {

        direction = "down";

      }
      break;
    case 39: //right arrow

      if (play == "True") {

        direction = "right";

      }
      break;
    case 68: //d key

      if (play == "True") {

        direction = "right";

      }
      break;
    case 37: //left arrow

      if (play == "True") {

        direction = "left";

      }
      break;
    case 65: //a key

      if (play == "True") {

        direction = "left";

      }
      break;
    case 13: //enter key

      if (play == "True") {
        play = "False";
      } else if (play == "False") {
        play = "True";
      }

      break;
    default:
      //do nothing
  }
}


//calculate the move for pacman
function movePacman() {

  if (play == "True") {
  
    
    
    //move the pacman
    if (moveComplete == "True") {
      
      if (pacManx == 0 && direction != "right"){
        pacManx = 1050;
      }else if(pacManx == 1050){
       pacManx = -gridSize;
      }
      
      switch (direction) {
        case "up":

          checkMove();

          if (pacCheck == "False") {
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

          if (pacCheck == "False") {
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

          if (pacCheck == "False") {
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

          if (pacCheck == "False") {
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
    } else if (moveComplete == "False") {

      if (pacManx == newPacManx && pacMany == newPacMany) {
        moveComplete = "True";
        movePacman();
      } else {
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

//make sure the move pacman is going to do is valid.
function checkMove() {

  //find coordinate position
  xGridPos = (pacManx / gridSize);
  yGridPos = (pacMany / gridSize);

  //check collision
  switch (direction) {
    case "up":

      if (levelRow[yGridPos - 1][xGridPos] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "down":

      if (levelRow[yGridPos + 1][xGridPos] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "left":

      if (levelRow[yGridPos][xGridPos - 1] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

      break;
    case "right":


      if (levelRow[yGridPos][xGridPos + 1] == 1) {
        pacCheck = "False";
      } else {
        pacCheck = "True";
      }

    default:
      //this shouldnt happen
  }


  //check food/powerup
  if (levelRow[yGridPos][xGridPos] == 0) {//normal dots 
    levelRow[yGridPos][xGridPos] = 2;
    score = score + 10;

  }
  if (levelRow[yGridPos][xGridPos] == 3){//power pellets
    levelRow[yGridPos][xGridPos] = 2;
    score = score + 100;
    mode = "frightened";
    endMode = seconds + 10;
    reverseGhost();
    //ghostSpeed = [10,10,10,10];//this causes problems currently :(
  }

  if (score == maxScore) {
    play = "pac";
    console.log("The pacman wins");

  }
  
  for (i = 0; i < ghostCount; i++){
    
    if (Math.abs(ghostX[i] - pacManx) < (gridSize/1.5) && Math.abs(ghostY[i] - pacMany) < (gridSize/1.5)){
      
      if (mode == "normal" || mode == "scatter"){
      
      play = "ghost";
      
      }else if (mode == "frightened"){
        ghostX[i] = ghostHouse[0];
        ghostY[i] = ghostHouse[1];
        ghostMoveComplete[i] = "True";
        ghostsDirection[i] = "up";
        
      }
    }
  }

}



function moveGhost() { //AI M3

  if (play == "True") {
    // locate the ghost and pacman

    if (endMode == seconds){
      mode = "normal";
      ghostSpeed = [5,5,5,5];
      reverseGhost();
    }
    
    for (i = 0; i < ghostCount; i++) {
      
      if (movementMemory != 0){
        i = movementMemory;
        movementMemory = 0;
      }
      
      if (mode == "normal" || mode == "scatter"){
        if (seconds == 0){//start scatter
          mode = "normal";
          reverseGhost();
        }else if (seconds == 7){//end scatter
          mode = "scatter";
          reverseGhost();
        }else if (seconds == 27){//start scatter
          mode = "normal";
          reverseGhost();
        }else if (seconds == 34){//end scatter
          mode = "scatter";
          reverseGhost();
        }else if (seconds == 54){//start scatter
          mode = "normal";
          reverseGhost();
        }else if (seconds == 59){//end scatter
          mode = "scatter";
          reverseGhost();
        }else if (seconds == 79){//start scatter
          mode = "normal";
          reverseGhost();
        }else if (seconds == 84){//end scatter
          mode = "scatter";
          reverseGhost();
        }else if (seconds == 85){//end scatter
          mode = "normal";
          reverseGhost();
        }
      }
      if (mode == "scatter"){
        switch (i){
          case 0:
            pacxGridPos = -1;
            pacyGridPos = -1;
            break;
          case 1:
            pacxGridPos = 35;
            pacyGridPos = -1;
            break;
          case 2:
            pacxGridPos = -1;
            pacyGridPos = 20;
            break;
          case 3:
            pacxGridPos = 36;
            pacyGridPos = 22;
            break;
        }
      }
      
      if (ghostMoveComplete[i] == "True" && seconds >= ghostTimer[i]) {

        ghostxGridPos = [];
        ghostyGridPos = [];

        ghostxGridPos[i] = (ghostX[i] / gridSize);
        ghostyGridPos[i] = (ghostY[i] / gridSize);
        

        if (ghost[i] == 0 && mode == "normal") { //targets directly

          pacxGridPos = (pacManx / gridSize);
          pacyGridPos = (pacMany / gridSize);

        } else if (ghost[i] == 1 && mode == "normal") { //pinkys targeting 4 ahead of pacman
          switch (direction) {
            case "up":
              pacxGridPos = (pacManx / gridSize);
              pacyGridPos = (pacMany / gridSize) - 4;
              break;
            case "down":
              pacxGridPos = (pacManx / gridSize);
              pacyGridPos = (pacMany / gridSize) + 4;
              break;
            case "left":
              pacxGridPos = (pacManx / gridSize) - 4;
              pacyGridPos = (pacMany / gridSize);
              break;
            case "right":
              pacxGridPos = (pacManx / gridSize) + 4;
              pacyGridPos = (pacMany / gridSize);
              break;
            default:
              //shouldnt happen
          }//end switch
        } else if (ghost[i] == 2 && mode == "normal") {

          //calculate distance
          x2 = pacManx;
          y2 = pacMany;

          x1 = ghostX[i];
          y1 = ghostY[i];

          subX = x2 - x1;
          subY = y2 - y1;

          xPow = Math.pow(subX, 2);

          yPow = Math.pow(subY, 2);

          squareRoot = xPow + yPow;

          result = Math.sqrt(squareRoot);

          distance = Math.floor(result);

          if (distance > (10 * gridSize)) {
            pacxGridPos = (pacManx / gridSize);
            pacyGridPos = (pacMany / gridSize);
          } else {
            pacxGridPos = -2;
            pacyGridPos = 22;
          }

         }
      


        //assign some varibles
        leftBox = [];
        rightBox = [];
        topBox = [];
        bottomBox = [];

        leftBox[i] = levelRow[ghostyGridPos[i]][ghostxGridPos[i] - 1];
        rightBox[i] = levelRow[ghostyGridPos[i]][ghostxGridPos[i] + 1];
        topBox[i] = levelRow[ghostyGridPos[i] - 1][ghostxGridPos[i]];
        bottomBox[i] = levelRow[ghostyGridPos[i] + 1][ghostxGridPos[i]];

        
        checkDistance = [];
        
        if (mode != "frightened"){
        //determine direction
        if (leftBox[i] != 1 && ghostLastTrueDirection[i] != "right"){
          checkDistance[0] = distanceCalc(pacxGridPos*gridSize,pacyGridPos*gridSize,ghostX[i] - gridSize,ghostY[i]);
        }else{
          checkDistance[0] = 10000;
        }
        
        if (rightBox[i] != 1 && ghostLastTrueDirection[i] != "left"){
          checkDistance[1] = distanceCalc(pacxGridPos*gridSize,pacyGridPos*gridSize,ghostX[i] + gridSize,ghostY[i]);
        }else{
          checkDistance[1] = 10000;
        }
        
        if (topBox[i] != 1 && ghostLastTrueDirection[i] != "down"){
          checkDistance[2] = distanceCalc(pacxGridPos*gridSize,pacyGridPos*gridSize,ghostX[i],ghostY[i] - gridSize);
        }else{
          checkDistance[2] = 10000;
        }
        
        if (bottomBox[i] != 1 && ghostLastTrueDirection[i] != "up"){
          checkDistance[3] = distanceCalc(pacxGridPos*gridSize,pacyGridPos*gridSize,ghostX[i],ghostY[i] + gridSize);
        }else{
          checkDistance[3] = 10000;
        }
        
        maxDistance = 10000;
        
        if (checkDistance[0] < maxDistance){
          
          maxDistance = checkDistance[0];
          ghostsDirection[i] = "left";
          
        }
        
        if (checkDistance[1] < maxDistance){
          
          maxDistance = checkDistance[1];
          ghostsDirection[i] = "right";
          
        }
        
        if (checkDistance[2] < maxDistance){
          
          maxDistance = checkDistance[2];
          ghostsDirection[i] = "up";
          
        }
        
        if (checkDistance[3] < maxDistance){
          
          maxDistance = checkDistance[3];
          ghostsDirection[i] = "down";
          
        }
        }else if (mode == "frightened"){
          if (leftBox[i] != 1 && ghostLastTrueDirection[i] != "right"){
          checkDistance[0] = Math.floor((Math.random() * 1000) + 1);
        }else{
          checkDistance[0] = 10000;
        }
        
        if (rightBox[i] != 1 && ghostLastTrueDirection[i] != "left"){
          checkDistance[1] = Math.floor((Math.random() * 1000) + 1);
        }else{
          checkDistance[1] = 10000;
        }
        
        if (topBox[i] != 1 && ghostLastTrueDirection[i] != "down"){
          checkDistance[2] = Math.floor((Math.random() * 1000) + 1);
        }else{
          checkDistance[2] = 10000;
        }
        
        if (bottomBox[i] != 1 && ghostLastTrueDirection[i] != "up"){
          checkDistance[3] = Math.floor((Math.random() * 1000) + 1);
        }else{
          checkDistance[3] = 10000;
        }
        
        maxDistance = 10000;
        
        if (checkDistance[0] < maxDistance){
          
          maxDistance = checkDistance[0];
          ghostsDirection[i] = "left";
          
        }
        
        if (checkDistance[1] < maxDistance){
          
          maxDistance = checkDistance[1];
          ghostsDirection[i] = "right";
          
        }
        
        if (checkDistance[2] < maxDistance){
          
          maxDistance = checkDistance[2];
          ghostsDirection[i] = "up";
          
        }
        
        if (checkDistance[3] < maxDistance){
          
          maxDistance = checkDistance[3];
          ghostsDirection[i] = "down";
          
        }
        }
       
      }
      
      
      
    if (ghostMoveComplete[i] == "True" && seconds >= ghostTimer[i]) {

      if (ghostX[i] == 0 && direction != "right"){
        ghostX[i] = 1050;
      }else if(ghostX[i] == 1050){
       ghostX[i] = -gridSize;
      }
      
      //determine the current directine
      switch (ghostsDirection[i]) {
        case "up":


          //calculate new pack man position
          newGhosty[i] = ghostY[i] - gridSize;
          newGhostx[i] = ghostX[i];

          ghostY[i] = ghostY[i] - ghostSpeed[i];

          ghostLastTrueDirection[i] = "up";

          ghostMoveComplete[i] = "False";

          break;
        case "down":


          //calculate new pack man position
          newGhosty[i] = ghostY[i] + gridSize;
          newGhostx[i] = ghostX[i];

          ghostY[i] = ghostY[i] + ghostSpeed[i];

          ghostLastTrueDirection[i] = "down";

          ghostMoveComplete[i] = "False";

          break;
        case "left":


          //calculate new pack man position
          newGhostx[i] = ghostX[i] - gridSize;
          newGhosty[i] = ghostY[i];

          ghostX[i] = ghostX[i] - ghostSpeed[i];

          ghostLastTrueDirection[i] = "left";

          ghostMoveComplete[i] = "False";

          break;
        case "right":

          //calculate new pack man position
          newGhostx[i] = ghostX[i] + gridSize;
          newGhosty[i] = ghostY[i];

          ghostX[i] = ghostX[i] + ghostSpeed[i];

          ghostLastTrueDirection[i] = "right";

          ghostMoveComplete[i] = "False";

          break;
        default:

      }

    } else if (ghostMoveComplete[i] == "False" && seconds >= ghostTimer[i]) {

      if (ghostX[i] == newGhostx[i] && ghostY[i] == newGhosty[i]) {



        ghostMoveComplete[i] = "True";
        
        movementMemory = i;
        moveGhost();

      } else {

        switch (ghostLastTrueDirection[i]) {
          case "up":

            ghostY[i] = ghostY[i] - ghostSpeed[i];

            break;
          case "down":

            ghostY[i] = ghostY[i] + ghostSpeed[i];
            break;
          case "left":

            ghostX[i] = ghostX[i] - ghostSpeed[i];

            break;
          case "right":

            ghostX[i] = ghostX[i] + ghostSpeed[i];


          default:
            //this shouldnt happen
        } //end of switch

      }
    
    }//endif

    }//end of for
    
  } //endif for play

} //end of function

function distanceCalc(x1,y1,x2,y2){

  subX = x2 - x1;
  subY = y2 - y1;

  xPow = Math.pow(subX,2);

  yPow = Math.pow(subY,2);

  squareRoot = xPow + yPow;

  result = Math.sqrt(squareRoot);

  return Math.floor(result);
  
}

function reverseGhost(){
  
  for (i = 0; i < ghostCount; i++) {
    
    if (ghostsDirection[i] == "up"){
      ghostsDirection[i] = "down";
    }else if (ghostsDirection[i] == "down"){
      ghostsDirection[i] = "up";
    }else if (ghostsDirection[i] == "left"){
      ghostsDirection[i] = "right";
    }else if (ghostsDirection[i] == "right"){
      ghostsDirection[i] = "left";
    }
    
  }
  
}