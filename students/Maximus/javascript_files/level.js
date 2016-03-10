//todo feature list

//unique ghost AI per ghost
//fix ghost going through walls  <-- probably should be done first
//make power pellets work... add in proper AI first
//level system
//strawberrys/cherrys???
//teleporting side paths
//proper ghost realease
//bigger map 
//pacman and ghost dynamicaly change size with the gridSize <--- finished
//reset button
//stats area
//make a display screen like in the arcade where it introduces the ghost and pac man
//after bigger map make dynamic walls
//fix ghost movement bug    <--- finsihed
//

function lvl1(){
  
  //level background data placement
  //0 = no wall with pellet
  //1 = wall
  //2 = no wall with no pellet
  //3 = power pellet
  
  levelRow = [];
  
  levelRow[0] = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
  levelRow[1] = [1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,1];
  levelRow[2] = [1,3,1,1,1,1,0,1,0,1,1,1,1,1,1,1,0,1,0,1,1,1,1,1,1,1,0,1,0,1,1,1,1,3,1];
  levelRow[3] = [1,0,1,0,0,0,0,0,0,1,1,1,1,1,1,1,0,1,0,1,1,1,1,1,1,1,0,0,0,0,0,0,1,0,1];
  levelRow[4] = [1,0,1,0,1,1,0,1,0,0,0,0,0,0,1,1,0,0,0,1,1,0,0,0,0,0,0,1,0,1,1,0,1,0,1];
  levelRow[5] = [1,0,0,0,1,1,0,1,0,1,1,1,1,0,0,0,0,1,0,0,0,0,1,1,1,1,0,1,0,1,1,0,0,0,1];
  levelRow[6] = [1,0,1,0,0,0,0,1,0,0,0,0,1,0,1,1,0,1,0,1,1,0,1,0,0,0,0,1,0,0,0,0,1,0,1];
  levelRow[7] = [1,0,1,1,1,1,0,0,0,1,1,0,1,0,1,1,0,1,0,1,1,0,1,0,1,1,0,0,0,1,1,1,1,0,1];
  levelRow[8] = [1,0,0,0,0,1,0,1,0,1,1,0,0,0,2,2,2,2,2,2,2,0,0,0,1,1,0,1,0,1,0,0,0,0,1];
  levelRow[9] = [1,1,1,1,0,0,0,1,0,1,1,0,1,1,2,1,1,2,1,1,2,1,1,0,1,1,0,1,0,0,0,1,1,1,1];
  levelRow[10] =[0,0,0,0,0,1,1,1,0,1,1,0,1,1,2,1,2,2,2,1,2,1,1,0,1,1,0,1,1,1,0,0,0,0,0];
  levelRow[11] =[1,1,1,1,0,0,0,0,0,1,1,0,1,1,2,1,1,1,1,1,2,1,1,0,1,1,0,0,0,0,0,1,1,1,1];
  levelRow[12] =[1,0,0,0,0,1,1,1,0,0,0,0,0,0,2,2,2,2,2,2,2,0,0,0,0,0,0,1,1,1,0,0,0,0,1];
  levelRow[13] =[1,0,1,1,0,0,0,1,0,1,1,1,0,1,1,1,1,1,1,1,1,1,0,1,1,1,0,1,0,0,0,1,1,0,1];
  levelRow[14] =[1,0,1,1,1,1,0,1,0,1,1,1,0,1,0,0,0,0,0,0,0,1,0,1,1,1,0,1,0,1,1,1,1,0,1];
  levelRow[15] =[1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1];
  levelRow[16] =[1,0,1,1,1,1,1,0,1,0,1,1,1,1,0,1,0,1,0,1,0,1,1,1,1,0,1,0,1,1,1,1,1,0,1];
  levelRow[17] =[1,3,1,1,1,1,1,0,1,0,1,1,1,1,0,1,0,1,0,1,0,1,1,1,1,0,1,0,1,1,1,1,1,3,1];
  levelRow[18] =[1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1];
  levelRow[19] =[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
 
  
  //other level variables
  
  //pacman position
  pacManx = gridSize * 17;
  pacMany = gridSize * 12;
  
  //starting pacman direction
  direction = "right";
  lastTrueDirection = "right";//this needs set to prevent errors. make sure it is valid
  
  //score variables
  score = 0;
  maxScore = 116000;//total amount of pellets times 100
  
  //starting ghost varibles 
  ghostCount = 4;
  ghostId = [];
  ghostX = [];
  ghostY = [];
  ghostsDirection = [];
  ghostLastTrueDirection = [];
  ghostSpeed = [];
  ghostTimer = [];
  ghostTimer = [0,0,15,15];
  ghost = [0,1,2,1];//this determines different AI Pattern
  ghostX = [(gridSize * 17), (gridSize * 17), (gridSize * 18), (gridSize * 16)];
  ghostY = [(gridSize * 9), (gridSize * 10), (gridSize * 10), (gridSize * 10)];
  ghostsDirection = ["up","up","left","right"];
  ghostLastTrueDirection = ["up","up","left","right"];
  ghostSpeed = [5,5,5,5];//make this a multible of whatever the gridSize is. like 2,5,10,25, and even 50 or if using a decimal make sure it adds up evenly to 50
  ghostColor = [];
  ghostColor = ["red","hotpink","skyblue","orange"];
  ghostMoveComplete = [];
  ghostMoveComplete = ["True","True","True","True"];
  newGhostx = [];
  newGhosty = [];
  
}

function lvl2(){
  
}


