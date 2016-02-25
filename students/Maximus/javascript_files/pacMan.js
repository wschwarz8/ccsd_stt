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
  topMouthAngle = 1.7;
  bottomMouthAngle = 2.0;
  lastTrueDirection = "right";
  eyePosition = 12;
  check = "False";
  score = 0;
  ghostX = gridSize * 11;
  ghostY = gridSize * 5;
  ghostsDirection = "up";
  
  moveComplete = "True";
  ghostMoveComplete = "True";

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
  movePacman();
  
  //move ghost
  moveGhost();
  
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
      
      //draw background images
      canvas.drawImage(texture[levelRow[i][b]], x, y,gridSize,gridSize);

      //draw any food or power up dots
      if (levelRowItem[i][b] == 3 || levelRowItem[i][b] == 4){
        canvas.drawImage(texture[levelRowItem[i][b]], x, y,gridSize,gridSize);
      }
      
      
      x = x + gridSize;

    }

    y = y + gridSize;

  }


  canvas.save();
  
  switch (lastTrueDirection) {
  case "up":
      canvas.translate(pacManx,pacMany);
      eyePosition=12;
      canvas.rotate(-Math.PI / 2);
      canvas.translate(-pacManx-50,-pacMany);
    break;
  case "down":
      canvas.translate(pacManx,pacMany);
      eyePosition=12;
      canvas.rotate(Math.PI / 2);
      canvas.translate(-pacManx,-pacMany-50);
    break;
  case "left":
      canvas.translate(pacManx,pacMany);
      eyePosition=39;
      canvas.rotate(-Math.PI);
      canvas.translate(-pacManx-50,-pacMany-50);
    break;
  case "right":
      eyePosition=12;
    break;
  default:
    //shouldnt happen
}



//draw pacman
canvas.beginPath();
canvas.lineWidth = 19;
canvas.arc(pacManx + 25, pacMany + 25, 9, Math.PI * bottomMouthAngle, Math.PI * topMouthAngle, false);
canvas.strokeStyle = "Yellow";
canvas.stroke();
canvas.beginPath();
canvas.arc(pacManx + 25, pacMany + eyePosition, 3, 0, 2 * Math.PI, false);
canvas.fillStyle = "rgb(0, 0, 0)";
canvas.fill()
if (play == "True" && check == "True"){
switch (topMouthAngle) {
  case 1.7:
    topMouthAngle = 1.9;
    bottomMouthAngle = 2;
    break;
  case 1.9:
    topMouthAngle = 2;
    bottomMouthAngle = 2.1;
    break;
  case 2:
    topMouthAngle = 1.7;
    bottomMouthAngle = 2.2;
    break;
}
}

canvas.restore();

  //draw the ghost
  canvas.drawImage(texture[5], ghostX, ghostY, gridSize, gridSize);
  
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


//move everything
function movePacman() {
  
  if (play == "True") {
    
    //move the pacman
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
      console.log("at pac move");
      if (pacManx == newPacManx && pacMany == newPacMany){
        moveComplete ="True";
        movePacman();
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
  
  //check collision
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
  
  
  //check food/powerup
  if (levelRowItem[yGridPos][xGridPos] == 3 || levelRowItem[yGridPos][xGridPos] == 4){
      levelRowItem[yGridPos][xGridPos] = 0;
    score = score + 100;
    document.getElementById('score').innerHTML = "Score: " + score;
  }

}



function moveGhost(){
  
  
  if (play == "True"){
    // locate the ghost and pacman

    pacxGridPos = (pacManx/gridSize);
    pacyGridPos = (pacMany/gridSize);

    ghostxGridPos = (ghostX/gridSize);
    ghostyGridPos = (ghostY/gridSize);

    //find the ghost location compared to the pacman ----- >       up - down        right - left

    //deterimine if its left or right
    if (ghostxGridPos > pacxGridPos){

      ghostTurnDirection1 = "left";

    }else if(ghostxGridPos < pacxGridPos){

      ghostTurnDirection1 = "right";

    }else{
      ghostTurnDirection1 = "neither";
    }

    //determine if its up or down
    if (ghostyGridPos > pacyGridPos){

      ghostTurnDirection2 = "down";

    }else if(ghostyGridPos < pacyGridPos){

      ghostTurnDirection2 = "up";

    }else{
      ghostTurnDirection2 = "neither";
    }
    
    
   switch(ghostsDirection){
       case "up":
       
          if (ghostTurnDirection1 == "left"){
            ghostsDirection = "left";
          }else if (ghostTurnDirection1 == "right"){
            ghostsDirection = "right";
          }
       
       break;
     case "down":

          if (ghostTurnDirection1 == "left"){
            ghostsDirection = "left";
          }else if (ghostTurnDirection1 == "right"){
            ghostsDirection = "right";
          }
       
       break;
     case "left":
       
          if (ghostTurnDirection2 == "down"){
            ghostsDirection = "down";
          }else if (ghostTurnDirection2 == "up"){
            ghostsDirection = "up";
          }
       
       break;
     case "right":
       
       if (ghostTurnDirection2 == "up"){
            ghostsDirection = "up";
          }else if (ghostTurnDirection2 == "down"){
            ghostsDirection = "down";
          }
       
       break;
     default:
       
   }


    //determine what direction he should turn
    //stuff
    
    
    //move

    if (ghostMoveComplete == "True"){
    
    //determine the current directine
      switch(ghostsDirection){
          case "up":

             checkGhostMove();

             if (check == "False"){
               break;
             }


            //calculate new pack man position
            newGhosty = ghostY - gridSize;
            newGhostx = ghostX;

            ghostY = ghostY - 10;

            ghostLastTrueDirection = "up";

            ghostMoveComplete = "False";

            break;
          case "down":

             checkGhostMove();

             if (check == "False"){
               break;
             }


            //calculate new pack man position
            newGhosty = ghostY + gridSize;
            newGhostx = ghostX;

            ghostY = ghostY + 10;

            ghostLastTrueDirection = "down";

            ghostMoveComplete = "False";
          
            break;
          case "left":
          
             checkGhostMove();

             if (check == "False"){
               break;
             }


            //calculate new pack man position
            newGhostx = ghostX - gridSize;
            newGhosty = ghostY;

            ghostX = ghostX - 10;

            ghostLastTrueDirection = "left";

            ghostMoveComplete = "False";
          
            break;
          case "right":
          
             checkGhostMove();

             if (check == "False"){
               break;
             }


            //calculate new pack man position
            newGhostx = ghostX + gridSize;
            newGhosty = ghostY;

            ghostX = ghostX + 10;

            ghostLastTrueDirection = "right";

            ghostMoveComplete = "False";
          
            break;
        default:

      }
      
    }else if(ghostMoveComplete == "False"){
      
      if (ghostX == newGhostx && ghostY == newGhosty){
        
          console.log("in test");
        
        ghostMoveComplete = "True";
        moveGhost();
        
      }else{
        
        switch (ghostLastTrueDirection) {
        case "up":

          ghostY = ghostY - 10;
       
          break;
        case "down":

          ghostY = ghostY + 10;
          break;
        case "left":

          ghostX = ghostX - 10;

          break;
        case "right":

          ghostX = ghostX + 10;

          
        default:
          //this shouldnt happen
        }//end of switch
        
      }//endif
      
    }//endif
  
  }//endif for play
  
}//end of function

function checkGhostMove() {
  
  
  //find coordinate position
  xGridPos = (ghostX/gridSize);
  yGridPos = (ghostY/gridSize);
  
  //check collision
  switch (ghostsDirection) {
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
