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
  pacCheck = "False";
  check = "False";
  score = 0;
  ghostX = gridSize * 19;
  ghostY = gridSize * 2;
  ghostsDirection = "up";
  maxScore = 11600;
  moveComplete = "True";
  ghostMoveComplete = "True";
  ghostSpeed = 6.25;//make this a multible of 50. like 2,5,10,25, and even 50 or if using a decimal make sure it adds up evenly to 50
  ghostLastTrueDirection = "up";
  debug = "False";
  flashCycle = 0;
  gradx1 = 0;
  gradx2 = 0;
  gradx3 = 1050;
  gradx4 = 0;

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
  
  flashCycle++;
  
  //gradx1 = gradx1 + 1;
  //gradx2 = gradx2 + 2;
  //gradx3 = gradx3 + 3;
  //gradx4 = gradx4 + 4;
  
  //draw background
  canvas.fillStyle = "#804000";
  canvas.fillRect(0, 0, 1050, 600);


  //draw textures
  x = 0;
  y = 0;

  for (i = 0; i < 12; i++) {

    x = 0;

    for (b = 0; b < 21; b++) {
      

      if (levelRow[i][b] == 1){
        
        var gradient = canvas.createLinearGradient(gradx1,gradx2,gradx3,gradx4);
        gradient.addColorStop("0","magenta");
        gradient.addColorStop("0.5","blue");
        gradient.addColorStop("1.0","red");

        // Fill with gradient
        canvas.fillStyle=gradient;
        
        canvas.fillRect(x,y,gridSize,gridSize);
        
      }else if (levelRow[i][b] == 0){
        
        canvas.fillStyle = "black";
        canvas.fillRect(x,y,gridSize,gridSize);
        
      }
      
      //draw any food or power up dots
      if (levelRowItem[i][b] == 3){
        
        canvas.beginPath();
        canvas.arc(x + (gridSize/2),y + (gridSize/2),3,0,2 * Math.PI);
        canvas.fillStyle = "tan";
        canvas.fill();
        
      } else if (levelRowItem[i][b] == 4){
        
        canvas.beginPath();
        canvas.arc(x + (gridSize/2),y + (gridSize/2),7,0,2 * Math.PI);
        
        if (flashCycle < 4){
          canvas.fillStyle = "tan";
          canvas.fill();
        }
        
        
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
canvas.fillStyle = "black";
canvas.fill()
if (play == "True" && pacCheck == "True"){
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
  //canvas.drawImage(texture[5], ghostX - 40, ghostY - 30, gridSize + 70, gridSize + 70);
  
  canvas.fillStyle = "red";
  //main body
  canvas.fillRect(ghostX + 8,ghostY + 14,gridSize-16,gridSize-26);
  canvas.beginPath();
  //head
  canvas.arc(ghostX + (gridSize/2),ghostY + ((gridSize/2) - 6),17,0,2 * Math.PI);
  canvas.fill();
  //tenticals
  if (flashCycle < 4){
    canvas.save();
    
    canvas.translate(ghostX,ghostY);
    canvas.rotate(45 * Math.PI/180);
    
    //tenticals
    canvas.fillRect(33,13,8,8);
    
    canvas.fillRect(41,5,8,8);
    
    canvas.fillRect(49,-3,8,8);
    
    canvas.restore();
  }else{
    
    canvas.save();
    
    canvas.translate(ghostX,ghostY);
    canvas.rotate(45 * Math.PI/180);
    
    //tenticals
    canvas.fillRect(29,17,8,8);
    
    canvas.fillRect(37,9,8,8);
    
    canvas.fillRect(45,1,8,8);
    
    canvas.fillRect(53,-7,8,8);
    
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillStyle = "black";
    
    canvas.fillRect(29,-8,20,8);
    
    canvas.fillRect(29,-49,20,7);
    
    canvas.restore();
    
  }
  
  canvas.fillStyle = "White";
  canvas.beginPath();
  canvas.arc(ghostX + 18,ghostY + 15,5,0,2*Math.PI);
  canvas.fill();
  
   canvas.beginPath();
  canvas.arc(ghostX + 31,ghostY + 15,5,0,2*Math.PI);
  canvas.fill();
  
  if (ghostsDirection == "up"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX + 18,ghostY + 13,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX + 31,ghostY + 13,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection == "down"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX + 18,ghostY + 17,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX + 31,ghostY + 17,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection == "left"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX + 16,ghostY + 15,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX + 29,ghostY + 15,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection == "right"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX + 20,ghostY + 15,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX + 33,ghostY + 15,3,0,2*Math.PI);
    canvas.fill();
    
  }
  
  
if (debug == "True" && play == "True"){
  
  //leftBox  
  if (leftBox == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection1 == "left"){
    colorCycle = 2;
  }

  canvas.fillStyle = color[colorCycle];
  canvas.fillRect((ghostxGridPos - 1) * gridSize,ghostyGridPos * gridSize,gridSize,gridSize);
  
  //rightBox
  if (rightBox == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection1 == "right"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect((ghostxGridPos + 1) * gridSize,ghostyGridPos * gridSize,gridSize,gridSize);
  
  //topBox
  if (topBox == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection2 == "up"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect(ghostxGridPos * gridSize,(ghostyGridPos - 1) * gridSize,gridSize,gridSize);
  
  //bottomBox
  if (bottomBox == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection2 == "down"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect(ghostxGridPos * gridSize,(ghostyGridPos + 1) * gridSize,gridSize,gridSize);
  
  
}
  
  
 if (flashCycle == 6){
   flashCycle = 0;
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

          if (pacCheck == "False"){
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

          if (pacCheck == "False"){
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

          if (pacCheck == "False"){
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
          
          if (pacCheck == "False"){
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
                pacCheck = "False";
           }else{
             pacCheck = "True";
           }
      
          break;
        case "down":

          if (levelRow[yGridPos + 1][xGridPos] == 1){
                pacCheck = "False";
           }else{
             pacCheck = "True";
           }
      
          break;
        case "left":

          if (levelRow[yGridPos][xGridPos - 1] == 1){
                pacCheck = "False";
           }else{
             pacCheck = "True";
           }

          break;
        case "right":
      
          
          if (levelRow[yGridPos][xGridPos + 1] == 1){
               pacCheck = "False";
           }else{
             pacCheck = "True";
           }
          
        default:
          //this shouldnt happen
      }
  
  
  //check food/powerup
  if (levelRowItem[yGridPos][xGridPos] == 3 || levelRowItem[yGridPos][xGridPos] == 4){
      levelRowItem[yGridPos][xGridPos] = 0;
    score = score + 100;
    document.getElementById('score').innerHTML = "Score: " + score;
    
  }else if(ghostX == pacManx && ghostY == pacMany){
    play = "Winner";
    console.log("The Ghost win");
    
  }
  
  if(score == maxScore){
    play = "Winner";
    console.log("The pacman wins");
    
  }

}



function moveGhost(){//messy and probaly could be done very differenty and maybe efficently
  
  
  //to fix ai i need to find all possible ways the ghost could move and eliminate the options that walls are in the way.
  //then i need to choose the path that will let the ghosts move without turning backwards and get it closer if possible but
  //if i cant it takes a longer path to get closer
  
  if (play == "True"){
    // locate the ghost and pacman

    if (ghostMoveComplete == "True"){
      
      
      pacxGridPos = (pacManx/gridSize);
      pacyGridPos = (pacMany/gridSize);

      ghostxGridPos = (ghostX/gridSize);
      ghostyGridPos = (ghostY/gridSize);
      
      //assign some varibles
      leftBox = levelRow[ghostyGridPos][ghostxGridPos - 1];
      rightBox = levelRow[ghostyGridPos][ghostxGridPos + 1];
      topBox = levelRow[ghostyGridPos - 1][ghostxGridPos];
      bottomBox = levelRow[ghostyGridPos + 1][ghostxGridPos];
      
      //find the perfered direction///
      
      //deterimine if its left or right
      if (ghostxGridPos > pacxGridPos){

        ghostTurnDirection1 = "left";

      }else if(ghostxGridPos < pacxGridPos){

        ghostTurnDirection1 = "right";

      }else{
        ghostTurnDirection1 = "niether";
      }

      //determine if its up or down
      if (ghostyGridPos > pacyGridPos){

        ghostTurnDirection2 = "up";

      }else if(ghostyGridPos < pacyGridPos){

        ghostTurnDirection2 = "down";

      }else{
        ghostTurnDirection2 = "niether";
      }
      
      
      
      //decide the direction
      switch(ghostLastTrueDirection){
        case "up"://ghost is currently going up so it can turn either left, right or stay the same
          
          //check what direction is perfered ---- their will be two
          if (ghostTurnDirection1 == "left"){
            
            if (leftBox == 1){//check if the direction is eliggible
              
              if (topBox == 1){
                ghostsDirection = "right";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "left";
            }
            
          }else if(ghostTurnDirection1 == "right"){
            
            if (rightBox == 1){//check if the direction is eliggible
              
              if (topBox == 1){
                ghostsDirection = "left";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "right";
            }
            
          }else if(ghostTurnDirection1 == "niether"){
            //check if the next direction is valid
            if (topBox == 1){
              
             
                if (rightBox == 1){
                  ghostsDirection = "left";
                }else if (leftBox == 1){
                  ghostsDirection = "right";
                }
                
  
            }//end of continue check
            
            break;//dont change the direction
          }
          
          break;
        case "down":

          
          //check what direction is perfered ---- their will be two
          if (ghostTurnDirection1 == "left"){
            
            if (leftBox == 1){//check if the direction is eliggible
              
              if (bottomBox == 1){
                ghostsDirection = "right";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "left";
            }
            
          }else if(ghostTurnDirection1 == "right"){
            
            if (rightBox == 1){//check if the direction is eliggible
              
              if (bottomBox == 1){
                ghostsDirection = "left";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "right";
            }
            
          }else if(ghostTurnDirection1 == "niether"){
            
            //check if the next direction is valid
            if (bottomBox == 1){
              
                if (rightBox == 1){
                  ghostsDirection = "left";
                }else if (leftBox == 1){
                  ghostsDirection = "right";
                }
                

            }//end of continue check
            
            break;//dont change the direction
          }
          
          
          break;
        case "left":
          
          
          //check what direction is perfered ---- their will be two
          if (ghostTurnDirection2 == "up"){
            
            if (topBox == 1){//check if the direction is eliggible
              
              if (leftBox == 1){
                ghostsDirection = "down";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "up";
            }
            
          }else if(ghostTurnDirection2 == "down"){
            
            if (bottomBox == 1){//check if the direction is eligible
              
              if (leftBox == 1){
                ghostsDirection = "right";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "down";
            }
            
          }if(ghostTurnDirection2 == "niether"){
            
            //check if the next direction is valid
            if (leftBox == 1){
              

                if (topBox == 1){
                  ghostsDirection = "down";
                }else if (bottomBox == 1){
                  ghostsDirection = "up";
                }
                
 
            }//end of continue check
            
            break;//dont change the direction
          }
          
          
          break;
        case "right":
          
          //check what direction is perfered ---- their will be two
          if (ghostTurnDirection2 == "up"){
            
            if (topBox == 1){//check if the direction is eligible
              
              if (rightBox == 1){
                ghostsDirection = "down";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "up";
            }
            
          }else if(ghostTurnDirection2 == "down"){
            
            if (bottomBox == 1){//check if the direction is eliggible
              
              if (rightBox == 1){
                ghostsDirection = "right";
              }
              
              break;//stop checks if you get in here
              
            }else{//no obsticle then turn
              
              ghostsDirection = "down";
            }
            
          }if(ghostTurnDirection2 == "niether"){
            
            //check if the next direction is valid
            if (rightBox == 1){
              
  
                if (topBox == 1){
                  ghostsDirection = "down";
                }else if (bottomBox == 1){
                  ghostsDirection = "up";
                }
                

            }//end of continue check
            
            break;//dont change the direction
          }
          
          break;
   
      }
      
    }
    
    
    
    
    //move the ghost

    if (ghostMoveComplete == "True"){
    
    //determine the current directine
      switch(ghostsDirection){
          case "up":


            //calculate new pack man position
            newGhosty = ghostY - gridSize;
            newGhostx = ghostX;

            ghostY = ghostY - ghostSpeed;

            ghostLastTrueDirection = "up";

            ghostMoveComplete = "False";

            break;
        case "down":


            //calculate new pack man position
            newGhosty = ghostY + gridSize;
            newGhostx = ghostX;

            ghostY = ghostY + ghostSpeed;

            ghostLastTrueDirection = "down";

            ghostMoveComplete = "False";
          
            break;
        case "left":


            //calculate new pack man position
            newGhostx = ghostX - gridSize;
            newGhosty = ghostY;

            ghostX = ghostX - ghostSpeed;

            ghostLastTrueDirection = "left";

            ghostMoveComplete = "False";
          
            break;
          case "right":

            //calculate new pack man position
            newGhostx = ghostX + gridSize;
            newGhosty = ghostY;

            ghostX = ghostX + ghostSpeed;

            ghostLastTrueDirection = "right";

            ghostMoveComplete = "False";
          
            break;
        default:

      }
      
    }else if(ghostMoveComplete == "False"){
      
      if (ghostX == newGhostx && ghostY == newGhosty){
        
         
        
        ghostMoveComplete = "True";
        moveGhost();
        
      }else{
        
        switch (ghostLastTrueDirection) {
        case "up":

          ghostY = ghostY - ghostSpeed;
       
          break;
        case "down":

          ghostY = ghostY + ghostSpeed;
          break;
        case "left":

          ghostX = ghostX - ghostSpeed;

          break;
        case "right":

          ghostX = ghostX + ghostSpeed;

          
        default:
          //this shouldnt happen
        }//end of switch
        
      }//endif
      
    }//endif
  
  }//endif for play
  
}//end of function
