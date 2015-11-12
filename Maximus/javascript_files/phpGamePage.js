function doFirst() {
  debug = document.getElementById("colorBoxText");
  debug.innerHTML = "Debug: Function - doFirst()";

  redDiv = document.getElementById("redDiv");
  redDiv.addEventListener("dragstart", startDrag, false);

  canvas = document.getElementById("drawingSpace");
  canvas.addEventListener("dragenter", function(e) {
    e.preventDefault();
  }, false);
  canvas.addEventListener("dragover", dragOver, false);
  canvas.addEventListener("dragleave", dragLeave, false);
  canvas.addEventListener("drop", dropped, false);
}

function startDrag(e) {
  debug.innerHTML = "Debug: Function - startDrag()";
  cx = e.clientX;
  cy = e.clientY;
  var code = '<div id="redDiv1" draggable="true"></div>';
  e.dataTransfer.setData('Text', code);
}

function dropped(e) {

  e.preventDefault();
  var x = e.clientX;
  var y = e.clientY;
  canvas.innerHTML = e.dataTransfer.getData('Text');
  newDiv = document.getElementById("redDiv1");
  newDiv.style.top = y - 50;
  newDiv.style.left = x - 50;
  
  canvas.style.background = "White";
    debug.innerHTML = "Debug: function - dropped(), X = "+ x +"px, Y = "+ y+"px";
  
}

function dragOver(e) {
  e.preventDefault();
  debug.innerHTML = "Debug: Function - dragOver()";
  canvas.style.background = "Blue";
}

function dragLeave(e) {
  e.preventDefault();
  debug.innerHTML = "Debug: Function - dragLeave()";
  canvas.style.background = "white";
}
window.addEventListener("load", doFirst, false)