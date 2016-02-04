<html>
  <head>
    <title>Javascript Game</title>
    
    <style>
      *{
        margin:0;
        padding:0;
      }
      html{
        background:grey;
      }
    </style>
    
  </head>

  <div style='background:white;width:910px;border-radius:4px;margin:0 0 0 0;'>
    <canvas id='canvas' name='myCanvas' height='600px' width='900px'>If you see this you must still be in 2005!</canvas>
  </div>
  <div style='background:grey;'>
    <p>Combine the squares to create new random colored Squares!!! When you run out of squares click the add shape button.</p>
    <button onclick='addShape()'>Add Shape</button>
  </div>
 
<script>
  //canvas variables
  var myCanvas = document.getElementById('canvas');
  var canvas = myCanvas.getContext('2d');
  
  //shape or text arrays
  var shape = [];
  var text = [];
  
  //other variables
  var drag = "False";
  var shapeCount = 5;
  var newCount = 0;
  
  
  function drawSquare(xPos,yPos,width,height,color){
    //draw a rectangle/square
    canvas.fillStyle = color;
    canvas.fillRect(xPos,yPos,width,height);
    
  }
  
  function drawText(xPos,yPos,text,color){
    //draw text
    canvas.fillStyle = color;
    canvas.font = '40px Arial';
    canvas.fillText(text,xPos,yPos);
    
  }
  
  function onMouseMove(e){
    if (drag === "True"){
      canvas.fillStyle = "white";
      canvas.fillRect(0,0,1122,677);
      
      for (i=1;i < shapeCount+1;i++){
        
        if (clickedShapeNum === i){
          shape[i][0] = e.clientX - 50;
          shape[i][1] = e.clientY - 50;
        drawSquare(shape[i][0], shape[i][1], shape[i][2], shape[i][3], shape[i][4]);
          
        }else{
         drawSquare(shape[i][0], shape[i][1], shape[i][2], shape[i][3], shape[i][4]);
          
        }
      }
    }
  }
  
  function onMouseDown(e){
    
    //make some mouse position variables
    var x = e.clientX;
    var y = e.clientY;
    rect = myCanvas.getBoundingClientRect();
    console.log("left position: "+rect.left);
    console.log(x + ", " + y);
    
    //cycle through the shapes
    for (i=1;i < shapeCount+1;i++){
      console.log("testing shape: "+i);
      
      //check each shapes bounds if the mouse is within them
      if (x > shape[i][0] && x < (shape[i][2] + shape[i][0]) && y > shape[i][1] && y < (shape[i][3] + shape[i][1])){
        console.log("shape touched!!");
        drag = "True";
        clickedShapeNum = i;
        onMouseMove(e);
        
      }else{
        console.log("shape not touched!!");
      }
    }
  }
  
  function detectShape(e){
    
    //get mouse position
    var x = event.clientX;
    var y = event.clientY;
    
    //cycle through all shapes and check their positions
    for (i=1;i < shapeCount+1;i++){
      
      //check each shapes bounds if the mouse is within them
      if (x > shape[i][0] && x < (shape[i][2] + shape[i][0]) && y > shape[i][1] && y < (shape[i][3] + shape[i][1])){
        
        //check if the shape found is the shape being draged or not
        if (i != clickedShapeNum){
          
          ////////create new shape///////
          
          //increment shape count
          newCount = shapeCount + 1;
          
          //get color
          newcolor = getColor();
          
          
          //give new shape values
          shape[newCount] = [shape[i][0], shape[i][1], shape[i][2], shape[i][3],newcolor];
          
          //set the shapes to disapear
          shape[i] = [0,0,0,0,"white"];
          shape[clickedShapeNum] = [0,0,0,0,"white"];
          
          //clear screen
          canvas.fillStyle = "white";
          canvas.fillRect(0,0,1122,677);
          
          //reprint the shape each time
          for (c=1;c < shapeCount+2;c++){
            
            drawSquare(shape[c][0], shape[c][1], shape[c][2], shape[c][3], shape[c][4]);
            
          }
        }
      }
    }
    if (newCount > shapeCount){
      shapeCount = newCount;
      drawText(100,400,"Shape Combined!!", "blue");
    }
  }
  function addShape(){

  //increment shape count
  shapeCount++;

  //get color
  newcolor = getColor();

  shape[shapeCount] = [10,10,100,100,newcolor]

  //clear screen
  canvas.fillStyle = "white";
  canvas.fillRect(0,0,1122,677);

  //reprint the shape each time
  for (i=1;i < shapeCount+1;i++){

    drawSquare(shape[i][0], shape[i][1], shape[i][2], shape[i][3], shape[i][4]);

  }

  }
  function getColor(){
    
    colorArray = ['#FF0000'/*red*/,'#7D0552'/*red violet*/,'#8D38C9'/*violet*/,'#342D7E'/*blue violet*/,'#0020C2'/*blue*/,'#008080'/*blue green*/,'#00FF00'/*green*/,'#B1FB17'/*yellow green*/,'#FFFF00'/*yellow*/,'#E8A317'/*yellow orange*/,'#F87217'/*orange*/,'#FF7F50'/*red orange*/];
    randomNum = Math.floor((Math.random() * 12) + 1);
    
    return colorArray[randomNum];
  }
  
  function onMouseUp(e){
    detectShape();
    drag="false";
  }
  
  function init(){
    
    //draw initial shapes
    drawSquare(75,100,100,100,"yellow");
    //make a two dimentional array with info about the shape
    shape[1] = [75,100,100,100,"yellow"];
    //console.log(shape[0][0] + ", " + shape[0][1] + ", " + shape[0][2] + ", " + shape[0][3] + ", " + shape[0][4]);
    
    drawSquare(275,100,100,100,"red",2);
    shape[2] = [275,100,100,100,"red"];
    
    drawSquare(475,100,100,100,"blue",3);
    shape[3] = [475,100,100,100,"blue"];
  
     drawSquare(675,100,100,100,"orange",3);
    shape[4] = [675,100,100,100,"orange"];
    
     drawSquare(875,100,100,100,"purple",3);
    shape[5] = [875,100,100,100,"purple"];
    //draw starting text
    drawText(100,300,"Combine the Squares!!","orange",1);
    
    //makes some event listeners
    document.getElementById("canvas").addEventListener("mousedown", onMouseDown);
    document.getElementById("canvas").addEventListener("mouseup", onMouseUp);
    document.getElementById("canvas").addEventListener("mousemove", onMouseMove);

  }

 
  init();
  


</script>

</html>
  
