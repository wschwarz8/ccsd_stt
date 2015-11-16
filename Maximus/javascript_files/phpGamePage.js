function doFirst() {
  //give some debug info
  debug = document.getElementById("colorBoxText");
  debug.innerHTML = "Debug: Function - doFirst()";

  //give red circle a listener and save it to a variable
  redDiv = document.getElementById("red");
  redDiv.addEventListener("dragstart", startDrag, false);
  /*
  //give orange circle a listener
  orangeDiv = document.getElementById("orangeDiv");
  orangeDiv.addEventListener("dragstart", startDrag, false);
  //give yellow circle a listener
  yellowDiv = document.getElementById("yellowDiv");
  yellowDiv.addEventListener("dragstart", startDrag, false);
  //give green circle a listener
  greenDiv = document.getElementById("greenDiv");
  greenDiv.addEventListener("dragstart", startDrag, false);
  */

  //add all listeners here for the canvas area
  canvas = document.getElementById("drawingSpace");
  canvas.addEventListener("dragenter", function(e) {e.preventDefault();}, false);
  canvas.addEventListener("dragover", dragOver, false);
  canvas.addEventListener("dragleave", dragLeave, false);
  canvas.addEventListener("drop", dropped, false);
  
}

function startDrag(e) {
  //save some code of what the new div should be
  var code = '<div id="redDiv1" draggable="true"></div>';
  e.dataTransfer.setData('Text', code);

  //get some info to calculate the offset
  var px = e.clientX;
  var py = e.clientY;  
  
  var Dpos = redDiv.top;

  //give some debug info
  debug.innerHTML = "Debug: Function - startDrag()" + Dpos + px;
}

function dropped(e) {
  //prevent any browser from doing something funky
  e.preventDefault();
  
  //get the location of the mouse when you drop it so it knows where to position the circle
  var x = e.clientX;
  var y = e.clientY;
  
  //replace the html inside the div #canvas with the div. Need to change this to append later for it to make more sense
  canvas.innerHTML = e.dataTransfer.getData('Text');
  
  //set new div to a variable for manipulation
  newDiv = document.getElementById("redDiv1");
  
  //position the new div to where the mouse dropped it with a 50px static offset for now
  newDiv.style.top = y;
  newDiv.style.left = x;

  //change the background back to white because you dropped it and dont need to keep it blue
  canvas.style.background = "White";
  
  //output any commonly used variables here for debugging
  debug.innerHTML = "Debug: function - dropped(), X = " + x + "px, Y = " + y + "px";
}

function dragOver(e) {
  //prevent browser from being stupid
  e.preventDefault();
 
  //change canvas color to blue when draggig something over it
  canvas.style.background = "Blue";
  
  //do some debug
  debug.innerHTML = "Debug: Function - dragOver()";
}

function dragLeave(e) {
  //dont let the browser be stupid
  e.preventDefault();
  
  //change the background to white if you change your mind about dragging an element into the canvas
  canvas.style.background = "white";
  
  //debug again
  debug.innerHTML = "Debug: Function - dragLeave()";
}

//call this to initate all the listeners and stuff. must be called after all used functions i think
window.addEventListener("load", doFirst, false)