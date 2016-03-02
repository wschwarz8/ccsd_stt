
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

  //loop through each row
  for (i = 0; i < 12; i++) {

    x = 0;
    //loop through each coulumn
    for (b = 0; b < 21; b++) {
      
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
  canvas.font = "50px Georgia";
  canvas.fillStyle = "Yellow";
  canvas.fillText("PacMan!", 425,45);
  
  //print different status messages
  if (play == "False" ){//press enter to play
    
    canvas.font = "30px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("Press Enter to Play!", 395,185);
    
  }else if(play == "pac"){//win message
    
    canvas.font = "30px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("You Win!!", 455,185);
    
  }else if(play == "ghost"){//ghost win message
    
    canvas.font = "30px Georgia";
    canvas.fillStyle = "red";
    canvas.fillText("The Ghost Win :(", 410,185);
  }
  
//save canvas due to rotations that may happen
  canvas.save();
  
  //determine which orientation pacman should be printed in
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

//decide the mouth angle
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

  //restore the canvas to original state
canvas.restore();

  //draw the ghost

  for (i = 0; i < ghostCount; i++){
  canvas.fillStyle = ghostColor[i];
  //main body
  canvas.fillRect(ghostX[i] + 8,ghostY[i] + 14,gridSize-16,gridSize-26);
  canvas.beginPath();
  //head
  canvas.arc(ghostX[i] + (gridSize/2),ghostY[i] + ((gridSize/2) - 6),17,0,2 * Math.PI);
  canvas.fill();
  //tenticals
  if (flashCycle < 4){
    canvas.save();
    
    canvas.translate(ghostX[i],ghostY[i]);
    canvas.rotate(45 * Math.PI/180);
    
    //tenticals
    canvas.fillRect(33,13,8,8);
    
    canvas.fillRect(41,5,8,8);
    
    canvas.fillRect(49,-3,8,8);
    
    canvas.restore();
  }else{
    
    canvas.save();
    
    canvas.translate(ghostX[i],ghostY[i]);
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
  canvas.arc(ghostX[i] + 18,ghostY[i] + 15,5,0,2*Math.PI);
  canvas.fill();
  
   canvas.beginPath();
  canvas.arc(ghostX[i] + 31,ghostY[i] + 15,5,0,2*Math.PI);
  canvas.fill();
  
  if (ghostsDirection[i] == "up"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + 18,ghostY[i] + 13,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + 31,ghostY[i] + 13,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "down"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + 18,ghostY[i] + 17,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + 31,ghostY[i] + 17,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "left"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + 16,ghostY[i] + 15,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + 29,ghostY[i] + 15,3,0,2*Math.PI);
    canvas.fill();
    
  }else if (ghostsDirection[i] == "right"){
    
    canvas.fillStyle = "Blue";
    canvas.beginPath();
    //pupils
    canvas.arc(ghostX[i] + 20,ghostY[i] + 15,3,0,2*Math.PI);
    canvas.fill();
    canvas.arc(ghostX[i] + 33,ghostY[i] + 15,3,0,2*Math.PI);
    canvas.fill();
    
  }
}
 
  
  
  //needs fixed 
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