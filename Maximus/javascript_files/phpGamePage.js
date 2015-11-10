
function doFirst(){
  debug = document.getElementById("colorBoxText");
  debug.innerHTML = "at doFirst()";
  
  redDiv = document.getElementById("redDiv");
  redDiv.addEventListener("dragstart", startDrag, false);
  
  canvas = document.getElementById("drawingSpace");
  canvas.addEventListener("dragenter", function(e){e.preventDefault();}, false);
  canvas.addEventListener("dragover", dragOver, false);
  canvas.addEventListener("dragleave", dragLeave, false);
  canvas.addEventListener("drop", dropped, false);
}

function startDrag(e){
  debug.innerHTML = "at startDrag()";
  var code = '<div class="CircleColor" id="redDiv" draggable="true"></div>';
  e.dataTransfer.setData('Text', code);
}

function dropped(e){
  debug.innerHTML = "at dropped()";
  e.preventDefault();
  canvas.innerHTML = e.dataTransfer.getData('Text');
  canvas.style.background = "White";
}
function dragOver(e){
  e.preventDefault();
  debug.innerHTML = "at dragOver()";
  canvas.style.background = "Blue";
}
function dragLeave(e){
  e.preventDefault();
  debug.innerHTML = "at dragLeave()";
  canvas.style.background = "white";
}
window.addEventListener("load", doFirst, false)