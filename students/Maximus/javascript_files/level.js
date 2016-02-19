

function lvl1(){
  
  //level data
  levelRow = [];
  
  levelRow[0] = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
  
  levelRow[1] = [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1];
  
  levelRow[2] = [1,0,1,1,0,1,0,1,1,1,1,0,1,1,1,0,1,0,1,0,1];
  
  levelRow[3] = [1,0,0,0,0,1,0,0,0,0,0,0,1,0,1,0,1,0,1,0,1];
  
  levelRow[4] = [1,0,1,1,1,1,0,1,1,1,1,0,1,0,0,0,0,0,1,0,1];
  
  levelRow[5] = [1,0,1,0,0,0,0,1,0,0,0,0,1,0,0,1,1,1,1,0,1];
  
  levelRow[6] = [1,0,1,0,1,1,0,1,0,1,1,1,1,1,0,1,0,0,0,0,1];
  
  levelRow[7] = [1,0,1,0,0,0,0,1,0,0,0,0,0,0,0,1,0,1,1,1,1];
  
  levelRow[8] = [1,0,1,0,1,1,1,1,0,1,1,1,0,1,0,0,0,0,0,0,1];
  
  levelRow[9] = [1,0,1,0,1,0,0,0,0,0,1,1,0,1,1,1,1,1,1,0,1];
  
  levelRow[10] = [1,0,0,0,1,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,1];
  
  levelRow[11] = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
  
  
}

function lvl2(){
  
}

function getTexture(){
  
  //load the images into a usable form
  
  source = [];
  
  //turn textures
  // texture source   image number 0
  source[0] = "/students/Maximus/Textures/PacManTextures/groundtile.png";
  
  // texture source      image number 1
  source[1] = "/students/Maximus/Textures/PacManTextures/walltile.png";
  
  //pacman
  // texture source      image number11
  source[2] = "/students/Maximus/Textures/PacManTextures/pacMan.png";
  
  
  //save the image data into a variable
  texture = [];
  
  for (i = 0; i < 3; i++){
    texture[i] = new Image();
    
    texture[i].src = document.location.origin + source[i];
  }
  
}

