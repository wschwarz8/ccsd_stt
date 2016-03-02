

function lvl1(){
  
  //level background data placement
  //0 = no wall with pellet
  //1 = wall
  //2 = no wall with no pellet
  //3 = power pellet
  
  levelRow = [];
  
  levelRow[0] = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
  
  levelRow[1] = [1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,1];
  
  levelRow[2] = [1,3,1,1,0,1,0,1,1,1,0,1,1,1,0,1,0,1,1,3,1];
  
  levelRow[3] = [1,0,0,0,0,1,0,1,0,0,0,0,0,1,0,1,0,0,0,0,1];
  
  levelRow[4] = [1,1,0,1,0,0,0,0,0,1,2,1,0,0,0,0,0,1,0,1,1];
  
  levelRow[5] = [1,1,0,1,1,1,1,0,1,2,2,2,1,0,1,1,1,1,0,1,1];
  
  levelRow[6] = [1,0,0,1,0,0,0,0,1,1,1,1,1,0,0,0,0,1,0,0,1];
  
  levelRow[7] = [1,0,1,1,0,1,1,0,0,0,2,0,0,0,1,1,0,1,1,0,1];
  
  levelRow[8] = [1,0,0,0,0,1,0,0,1,1,1,1,1,0,0,1,0,0,0,0,1];
  
  levelRow[9] = [1,3,1,1,0,0,0,1,1,0,0,0,1,1,0,0,0,1,1,3,1];
  
  levelRow[10] = [1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1,0,0,0,0,1];
  
  levelRow[11] = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
 
  
  //other level variables
  
  //pacman position
  pacManx = gridSize * 10;
  pacMany = gridSize * 7;
  
  //starting pacman direction
  direction = "right";
  lastTrueDirection = "right";//this needs set to prevent errors. make sure it is valid
  
  //score variables
  score = 0;
  maxScore = 11600;//total amount of pellets times 100
  
  //starting ghost varibles 
  ghostCount = 4;
  ghostId = [];
  ghostX = [];
  ghostY = [];
  ghostsDirection = [];
  ghostLastTrueDirection = [];
  ghostSpeed = [];
  ghost = [0,1,2,3];//this determines different AI Pattern
  ghostX = [(gridSize * 10), (gridSize * 10), (gridSize * 11), (gridSize * 9)];
  ghostY = [(gridSize * 4), (gridSize * 5), (gridSize * 5), (gridSize * 5)];
  ghostsDirection = ["up","up","left","right"];
  ghostLastTrueDirection = ["up","up","left","right"];
  ghostSpeed = [6.25,6.25,6.25,6.25];//make this a multible of 50. like 2,5,10,25, and even 50 or if using a decimal make sure it adds up evenly to 50
  ghostColor = [];
  ghostColor = ["red","lightblue","green","yellow"];
  ghostMoveComplete = [];
  ghostMoveComplete = ["True","True","True","True"];
  newGhostx = [];
  newGhosty = [];
  
}

function lvl2(){
  
}

