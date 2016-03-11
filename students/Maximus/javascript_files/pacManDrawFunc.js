
function draw(){
  
  flashCycle++;
  
  //gradx1 = gradx1 + 1;
  //gradx2 = gradx2 + 2;
  //gradx3 = gradx3 + 3;
  //gradx4 = gradx4 + 4;
  
  //draw background
  canvas.fillStyle = "silver";
  canvas.fillRect(0, 0, 1050, 600);


  //draw textures
  x = 0;
  y = 0;

  //loop through each row
  for (i = 0; i < 20; i++) {

    x = 0;
    //loop through each coulumn
    for (b = 0; b < 35; b++) {
      
       //print walls
      if (levelRow[i][b] == 1){
        
        var gradient = canvas.createLinearGradient(gradx1,gradx2,gradx3,gradx4);
        gradient.addColorStop("0","magenta");
        gradient.addColorStop("0.5","blue");
        gradient.addColorStop("1.0","red");

        // Fill with gradient
        canvas.fillStyle=gradient;
        
        canvas.fillRect(x,y,gridSize,gridSize);
        
       //print non walled areas
      }else if (levelRow[i][b] == 0 || levelRow[i][b] == 2 ||levelRow[i][b] == 3 || levelRow[i][b] == 10){
        
        canvas.fillStyle = "black";
        canvas.fillRect(x,y,gridSize,gridSize);
        
      }
      
      //draw any pellets
      if (levelRow[i][b] == 0){
        
        canvas.beginPath();
        canvas.arc(x + (gridSize/2),y + (gridSize/2),3,0,2 * Math.PI);
        canvas.fillStyle = "tan";
        canvas.fill();
        
        //draw super pellets
      } else if (levelRow[i][b] == 3){
        
        canvas.beginPath();
        canvas.arc(x + (gridSize/2),y + (gridSize/2),7,0,2 * Math.PI);
        
        if (flashCycle < 4){
          canvas.fillStyle = "tan";
          canvas.fill();
        }
        
        
      }
      
      //increment coulumn to be printed
      x = x + gridSize;

    }

    //incremnt row to be printed
    y = y + gridSize;

  }

  //title and score
  canvas.font = gridSize + "px Georgia";
  canvas.fillStyle = "Yellow";
  canvas.fillText("PacMan!", (gridSize * 16) - (gridSize/2),(gridSize*1) - (gridSize/4));
  
  //print different status messages
  if (play == "False" ){//press enter to play
    
    canvas.font = gridSize + "px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("Press Enter to Play!", gridSize * 13,(gridSize * 9) - (gridSize/4));
    
  }else if(play == "pac"){//win message
    
    canvas.font = "30px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("You Win!!", gridSize * 13,(gridSize * 9) - (gridSize/4));
    
  }else if(play == "ghost"){//ghost win message
    
    canvas.font = gridSize + "px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("The Ghosts Win :(", gridSize * 13,(gridSize * 9) - (gridSize/4));
  }
  
//save canvas due to rotations that may happen
  canvas.save();
  
  //determine which orientation pacman should be printed in
  switch (lastTrueDirection) {
  case "up":
      canvas.translate(pacManx,pacMany + gridSize);
      
      canvas.rotate(-Math.PI / 2);

    break;
  case "down":
      canvas.translate(pacManx + gridSize,pacMany);
      
      canvas.rotate(Math.PI / 2);

    break;
  case "left":
      canvas.translate(pacManx + gridSize,pacMany + gridSize);
      
      canvas.rotate(-Math.PI);
      
    break;
  case "right":
      canvas.translate(pacManx,pacMany);
    break;
  default:
    //shouldnt happen
}



//draw pacman
  
canvas.beginPath();//top
canvas.arc((gridSize/2),(gridSize/2), (gridSize/2) - (gridSize * (1/10)), topMouthAngle, Math.PI * 1.07);
canvas.fillStyle = "Yellow";
canvas.fill();
  
canvas.beginPath();//bottom
canvas.arc((gridSize/2),(gridSize/2), (gridSize/2) - (gridSize * (1/10)), -Math.PI * 1.07,-bottomMouthAngle);
canvas.fillStyle = "Yellow";
canvas.fill();


//decide the mouth angle
if (play == "True" && pacCheck == "True"){
switch (topMouthAngle) {
  case 0:
    topMouthAngle = Math.PI/6;
    bottomMouthAngle = Math.PI/6;
    break;
  case Math.PI/6:
    topMouthAngle = 0;
    bottomMouthAngle = 0;
    break;

}
  
}

  //restore the canvas to original state
canvas.restore();

  //draw the ghost

  for (i = 0; i < ghostCount; i++){
    
    if (mode == "frightened"){
      if (endMode - seconds < 5){
        if (flashCycle < 4){
          canvas.fillStyle = "Blue";
        }else{
          canvas.fillStyle = "Grey";
        }
      }else{
      canvas.fillStyle = "Blue";
      }
    }else{
        canvas.fillStyle = ghostColor[i];
    }
    

    
  //main body 
  canvas.fillRect(ghostX[i] + (gridSize * (1.5/10)),ghostY[i] + (gridSize * (3/10)),gridSize - (gridSize * (3/10)),gridSize - (gridSize * (5/10)));
  canvas.beginPath();
  //head
  canvas.arc(ghostX[i] + (gridSize/2),ghostY[i] + ((gridSize/2) - (gridSize * (1/10))),gridSize/2 - (gridSize * (1.5/10)),0,2 * Math.PI);
  canvas.fill();
  //tenticals
  if (flashCycle < 4){
    canvas.save();
    
    canvas.translate(ghostX[i] + (gridSize * (1/20)),ghostY[i]);
    canvas.rotate(45 * Math.PI/180);
    
    //tenticals
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
    
    canvas.rotate(-45 * Math.PI/180);
    canvas.translate(-((gridSize/3) - (gridSize/10)),0);
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
   
    canvas.rotate(-45 * Math.PI/180);
    canvas.translate(-((gridSize/3) - (gridSize/10)),0);
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
  
    canvas.restore();
  }else{
    
    canvas.save();
    
    canvas.translate(ghostX[i] + (gridSize * (3/20)),ghostY[i]);
    canvas.rotate(45 * Math.PI/180);
    
    //tenticals
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
    
    canvas.rotate(-45 * Math.PI/180);
    canvas.translate(-((gridSize/3) - (gridSize/10)),0);
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
   
    canvas.rotate(-45 * Math.PI/180);
    canvas.translate(-((gridSize/3) - (gridSize/10)),0);
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
  
    canvas.rotate(-45 * Math.PI/180);
    canvas.translate(-((gridSize/3) - (gridSize/10)),0);
    canvas.rotate(45 * Math.PI/180);
    
    canvas.fillRect(gridSize - (gridSize/gridSize),0,(gridSize/4) - (gridSize/10),(gridSize/4) - (gridSize/10));
  
    
    canvas.restore();
    canvas.save();
    

    canvas.translate(ghostX[i] + (gridSize * (1/20)),ghostY[i]);

    canvas.fillStyle = "black";
    
    canvas.fillRect(0 - (gridSize/20),gridSize - (gridSize/3),(gridSize/4) - (gridSize/10),(gridSize/4));
    
    canvas.fillRect((gridSize * (1/10)) + gridSize - (gridSize * (3/10)),gridSize - (gridSize/3),(gridSize/4) - (gridSize/10),(gridSize/4));
    
    canvas.restore();
    
  }
  
  canvas.fillStyle = "White";
  canvas.beginPath();
  canvas.arc(ghostX[i] + (gridSize * (1/3)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/8)),0,2*Math.PI);
  canvas.fill();
  
   canvas.beginPath();
  canvas.arc(ghostX[i] + (gridSize * (2/3)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/8)),0,2*Math.PI);
  canvas.fill();
  
  if (ghostsDirection[i] == "up"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + (gridSize * (1/3)),ghostY[i] + (gridSize * (1/3)) - (gridSize * (1/20)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + (gridSize * (2/3)),ghostY[i] + (gridSize * (1/3)) - (gridSize * (1/20)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "down"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + (gridSize * (1/3)),ghostY[i] + (gridSize * (1/3)) + (gridSize * (1/20)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + (gridSize * (2/3)),ghostY[i] + (gridSize * (1/3)) + (gridSize * (1/20)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "left"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + (gridSize * (1/3)) - (gridSize * (1/20)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + (gridSize * (2/3)) - (gridSize * (1/20)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "right"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + (gridSize * (1/3)) + (gridSize * (1/20)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + (gridSize * (2/3)) + (gridSize * (1/20)),ghostY[i] + (gridSize * (1/3)),(gridSize * (1/15)),0,2*Math.PI);
    canvas.fill();
    
  
}
 
  
  
  //needs fixed 
if (debug == "True" && play == "True"){

  //leftBox  
  if (leftBox[i] == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection1[i] == "left"){
    colorCycle = 2;
  }

  canvas.fillStyle = color[colorCycle];
  canvas.fillRect((ghostxGridPos[i] - 1) * gridSize,ghostyGridPos[i] * gridSize,gridSize,gridSize);
  
  //rightBox
  if (rightBox[i] == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection1[i] == "right"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect((ghostxGridPos[i] + 1) * gridSize,ghostyGridPos[i] * gridSize,gridSize,gridSize);
  
  //topBox
  if (topBox[i] == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection2[i] == "up"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect(ghostxGridPos[i] * gridSize,(ghostyGridPos[i] - 1) * gridSize,gridSize,gridSize);
  
  //bottomBox
  if (bottomBox[i] == 1){
    colorCycle = 0;
  }else{
    colorCycle = 3;
  }
  if (ghostTurnDirection2[i] == "down"){
    colorCycle = 2;
  }
  
  canvas.fillStyle = color[colorCycle];
  canvas.fillRect(ghostxGridPos[i] * gridSize,(ghostyGridPos[i] + 1) * gridSize,gridSize,gridSize);
  
  
}
  
  //score
  canvas.font = "30px Arial";
  canvas.fillStyle = "white";
  canvas.fillText("Score: "+ score,(gridSize * 15) + (gridSize/2),(gridSize * 20) - (gridSize/4));
    
 //time
 canvas.fillText("Time: "+ seconds,(gridSize * 5) + (gridSize/2),(gridSize * 20) - (gridSize/4));
  
 if (flashCycle == 6){
   flashCycle = 0;
 } 
}
}