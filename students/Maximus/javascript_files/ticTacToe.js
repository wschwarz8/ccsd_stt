//tic tac toe v1.0
//February 8, 2016

function init(){
  console.log("test");
  //set some position variables
  width = 600;
  height = 500;
  xOffSet = screen.width/2 - 300;
  yOffSet = 20;
  
  //other variables
  crossframe = [];
  xText = [];
  oText = [];
  markLoc = [];
  winLine = [];
  
  
  //set up the canvas
  ticTacToeCanvas = document.getElementById('ticTacToeCanvas');
  canvas = ticTacToeCanvas.getContext('2d');
  
  //makes some event listeners
  ticTacToeCanvas.addEventListener("mouseup", onMouseUp);
  ticTacToeCanvas.addEventListener("mousemove", onMouseMove);
  
  //make the frame
  crossframe[0] = [190,0,20,500,"brown"];
  
  crossframe[1] = [390,0,20,500,"brown"];
  
  crossframe[2] = [0,156,600,20,"brown"];
  
  crossframe[3] = [0,323,600,20,"brown"];

  //click locations
  markLoc[0] = [0,0,190,156,"white","False"];
  
  markLoc[1] = [210,0,180,156,"white","False"];
  
  markLoc[2] = [410,0,190,156,"white","False"];
  
  markLoc[3] = [0,176,190,147,"white","False"];
  
  markLoc[4] = [210,176,180,147,"white","False"];
  
  markLoc[5] = [410,176,190,147,"white","False"];
  
  markLoc[6] = [0,343,190,157,"white","False"];
  
  markLoc[7] = [210,343,180,157,"white","False"];
  
  markLoc[8] = [410,343,190,157,"white","False"];
  
  //win lines
  winLine[0] = [0,68,600,20,"Orange"];
  
  winLine[1] = [0,244,600,20,"Orange"];
  
  winLine[2] = [0,410,600,20,"Orange"];
  
  winLine[3] = [88,0,20,600,"Orange"];
  
  winLine[4] = [294,0,20,600,"Orange"];
  
  winLine[5] = [495,0,20,600,"Orange"];
  
  
  for (i=0; i < 9;i++){
     xText[i] = [-100,0,"X","white","False"];
    }
  for (i=0; i < 9;i++){
     oText[i] = [-100,0,"O","white","False"];
    }
  
  draw();
}

function onMouseDown(e){
 //unnessary
}

function onMouseUp(e){
  //check click location
  console.log("here!")
  //mouse location
  x = e.clientX;
  y = e.clientY;
  
  for (i = 0; i < 9; i++){
    if (x > (markLoc[i][0] + xOffSet) && x < (markLoc[i][2] + markLoc[i][0] + xOffSet) && y > (markLoc[i][1] + yOffSet) && y < (markLoc[i][3] + markLoc[i][1]+yOffSet)){
      if(markLoc[i][5] == "False"){
        markLoc[i][5] = "True";
        if (playerTurn == "X"){
          xText[i] = [markLoc[i][0] + 60,markLoc[i][1]+115,"X","Black","True"];
          playerTurn = "O";
          document.getElementById("playerTurn").innerHTML = "Player Turn<br>>>>>";
        }else if(playerTurn == "O"){
          oText[i] = [markLoc[i][0] +55,markLoc[i][1]+115,"O","Black", "True"];
          playerTurn = "X";
          document.getElementById("playerTurn").innerHTML = "Player Turn<br><<<<";
        }
      checkWin();
      draw();
      break;
      }
    }
 }
  
}

function onMouseMove(e){
  
  //mouse location
  x = e.clientX;
  y = e.clientY;
  
  //check location and make a phantom shape appear when the mouse hovers over a location
  for (i = 0; i < 9; i++){
    if (x > (markLoc[i][0]+xOffSet) && x < (markLoc[i][2] + markLoc[i][0] +xOffSet) && y > (markLoc[i][1] + yOffSet) && y < (markLoc[i][3] + markLoc[i][1]+yOffSet)){
      markLoc[i][4] = "silver";
      draw();
      break;
    }
 }
}

  function draw(){
    
    //clear screen
    canvas.fillStyle = "white";
    canvas.fillRect(0,0,600,500);
    
    //print the frame
    for (i = 0; i < 4;i++){
      //draw a rectangle/square
      canvas.fillStyle = crossframe[i][4];
      canvas.fillRect(crossframe[i][0],crossframe[i][1],crossframe[i][2],crossframe[i][3]);
    }
    
   
    //print the click location frame
    for (i=0; i < 9;i++){
      canvas.fillStyle = markLoc[i][4];
      canvas.fillRect(markLoc[i][0],markLoc[i][1],markLoc[i][2],markLoc[i][3]);
      markLoc[i][4] = "White";
      
    }
    
    //x
    for (i=0; i < 9;i++){
      canvas.font = '100px Arial';
      canvas.fillStyle = xText[i][3];
      canvas.fillText(xText[i][2],xText[i][0],xText[i][1]);
    }
    
     //o
    for (i=0; i < 9;i++){
      canvas.font = '100px Arial';
      canvas.fillStyle = oText[i][3];
      canvas.fillText(oText[i][2],oText[i][0],oText[i][1]);
    }
    
   if (playerTurn != "X" && playerTurn != "O"){
     if (winDirection < 6){
      //draw a rectangle/square
      canvas.fillStyle = winLine[winDirection][4];
      canvas.fillRect(winLine[winDirection][0],winLine[winDirection][1],winLine[winDirection][2], winLine[winDirection][3]);
     }else if(winDirection == 6){
      canvas.save();
      canvas.translate(80,50);
      canvas.rotate(40*Math.PI/180); // rotate around the start point
      canvas.fillStyle = winLine[0][4];
      canvas.fillRect(0,0,winLine[0][2], winLine[0][3]);
      canvas.restore();
     }else if(winDirection == 7){
      canvas.save();
      canvas.translate(60,430);
      canvas.rotate(-40*Math.PI/180); // rotate around the start point
      canvas.fillStyle = winLine[2][4];
      canvas.fillRect(0,0,winLine[2][2], winLine[2][3]);
      canvas.restore();
     }
     
   }
    
  }

function checkWin(){
  
  //x
 if (xText[0][4] == "True" && xText[1][4] == "True" && xText[2][4] == "True"){//top row x
   console.log("X Wins top row");
   playerTurn = "xWin";
   winDirection = 0;
 }else if (xText[3][4] == "True" && xText[4][4] == "True" && xText[5][4] == "True"){//middle row x
   console.log("X Wins middle row");
   playerTurn = "xWin";
   winDirection = 1;
 }else if (xText[6][4] == "True" && xText[7][4] == "True" && xText[8][4] == "True"){//bottom row x
   console.log("X Wins bottom row");
   playerTurn = "xWin";
   winDirection = 2;
 }else if (xText[0][4] == "True" && xText[3][4] == "True" && xText[6][4] == "True"){//left column x
   console.log("X Wins left column");
   playerTurn = "xWin";
   winDirection = 3;
 }else if (xText[1][4] == "True" && xText[4][4] == "True" && xText[7][4] == "True"){//middle column x
   console.log("X Wins middle column");
   playerTurn = "xWin";
   winDirection = 4;
 }else if (xText[2][4] == "True" && xText[5][4] == "True" && xText[8][4] == "True"){//right column x
   console.log("X Wins right column");
   playerTurn = "xWin";
   winDirection = 5;
 }else if (xText[0][4] == "True" && xText[4][4] == "True" && xText[8][4] == "True"){//negative diagonal x
   console.log("X Wins negative diagonal");
   playerTurn = "xWin";
   winDirection = 6;
 }else if (xText[2][4] == "True" && xText[4][4] == "True" && xText[6][4] == "True"){//positive diagonal x
   console.log("X Wins positive diagonal");
   playerTurn = "xWin";
   winDirection = 7;
 }
  
 //o 
  if (oText[0][4] == "True" && oText[1][4] == "True" && oText[2][4] == "True"){//top row x
   console.log("X Wins top row");
   playerTurn = "oWin";
    winDirection = 0;
 }else if (oText[3][4] == "True" && oText[4][4] == "True" && oText[5][4] == "True"){//middle row o
   console.log("o Wins middle row");
   playerTurn = "oWin";
   winDirection = 1;
 }else if (oText[6][4] == "True" && oText[7][4] == "True" && oText[8][4] == "True"){//bottom row o
   console.log("o Wins bottom row");
   playerTurn = "oWin";
   winDirection = 2;
 }else if (oText[0][4] == "True" && oText[3][4] == "True" && oText[6][4] == "True"){//left column o
   console.log("o Wins left column");
   playerTurn = "oWin";
   winDirection = 3;
 }else if (oText[1][4] == "True" && oText[4][4] == "True" && oText[7][4] == "True"){//middle column o
   console.log("o Wins middle column");
   playerTurn = "oWin";
   winDirection = 4;
 }else if (oText[2][4] == "True" && oText[4][4] == "True" && oText[8][4] == "True"){//right column o
   console.log("o Wins right column");
   playerTurn = "oWin";
   winDirection = 5;
 }else if (oText[0][4] == "True" && oText[4][4] == "True" && oText[8][4] == "True"){//negative diagonal o
   console.log("o Wins negative diagonal");
   playerTurn = "oWin";
   winDirection = 6;
 }else if (oText[2][4] == "True" && oText[4][4] == "True" && oText[6][4] == "True"){//positive diagonal o
   console.log("o Wins positive diagonal");
   playerTurn = "oWin";
   winDirection = 7;
 }
  
}

function resetGame(){
  //change screen score
  if (playerTurn == "xWin"){
    score1 = score1 + 1;
    document.getElementById("player1Score").innerHTML = score1+" Win";
    document.getElementById("playerTurn").innerHTML = "Player Turn<br><<<<";
    playerTurn = "X";
    init();
  }else if (playerTurn == "oWin"){
    score2 = score2 + 1;
    document.getElementById("player2Score").innerHTML = score2+" Win";
    document.getElementById("playerTurn").innerHTML = "Player Turn<br>>>>>";
    playerTurn = "O";
    init();
  }
  
}
function requireOnce(){
  score1 = 0;
  score2 = 0;
  playerTurn = "X";
}
