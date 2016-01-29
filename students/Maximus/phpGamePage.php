<html>
  <head>
    <title>Javascript Game</title>
    
    <style>
      *{
        margin:0;
        padding:0;
      }
    </style>
    
  </head>
  
  <div style='background:white;width:75%;border-radius:8px;margin:15px 0 0 0;'>
    <canvas id='canvas'name='myCanvas' height='677px' width='1122px'>If you see this you must still be in 2005!</canvas>
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
      
      
      //drawSquare(100,100,100,100,"green");
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
  
  function onMouseUp(e){
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
  