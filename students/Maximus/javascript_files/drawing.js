//web paint v1.0
//February 2, 2016

function init(){
  
  //set some position variables
  width = 600;
  height = 500;
  xOffSet = 20;
  yOffSet = 20;
  
  //set some drawing variables
  draw = "False";
  tipSize = 10;
  color = "Blue"
  
  //set up the canvas
  drawingCanvas = document.getElementById('drawingCanvas');
  canvas = drawingCanvas.getContext('2d');
  
  //makes some event listeners
  drawingCanvas.addEventListener("mousedown", onMouseDown);
  drawingCanvas.addEventListener("mouseup", onMouseUp);
  drawingCanvas.addEventListener("mousemove", onMouseMove);
}

//function triggered when mouse is pressed down
function onMouseDown(){
  
  //debug
  console.log("Mouse Down!");
  
  //change draw status
  draw = "True";
  drawFunc();
  
}

//function triggered when mouse is released
function onMouseUp(){
  
  //debug
  console.log("Mouse Up!");
  
  //change draw status
  draw = "False";
  
}

//function triggered when mouse is moved
function onMouseMove(){
  
  //debug
  console.log("Mouse Moved!");
  
  //draw
  drawFunc();
  
}

function drawFunc(){
  if (draw == "True"){
    //tell where to draw
    x = event.clientX;
    y = event.clientY;

    //give the drawing color
    canvas.fillStyle = color;
    canvas.fillRect(x - (tipSize/2 + xOffSet),y - (tipSize/2 + yOffSet),tipSize,tipSize);
  }
}

function changeColor(colorChange){
  color = colorChange;
}
