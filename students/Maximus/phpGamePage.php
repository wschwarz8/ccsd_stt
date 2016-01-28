<?php
require_once"../../functions.php";
require_once"../../config.php";
promptlogin();

makeHeader("Game","Game",2,"maxsGame.php",'<link href="../../css_files/create_jobs.css" rel="stylesheet">');
?>

<center>
  <div style='background:white;width:75%;border-radius:8px;margin:15px 0 0 0;'>
    <canvas id='canvas'name='myCanvas' height='500px' width='600px'>If you see this you must still be in 2005!</canvas>
  </div>
</center>

<script>
  //canvas variables
  var myCanvas = document.getElementById('canvas');
  var canvas = myCanvas.getContext('2d');
  
  //shape or text arrays
  var shape = [];
  var text = [];
  
  //other variables
  var drag = "False";
  var shapeCount = 3;
  
  
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
  function onClicks(e){
    
    //make some mouse position variables
    var x = e.clientX;
    var y = e.clientY;
    
    //cycle through the shapes
    for (i=1;i < shapeCount+1;i++){
      console.log("testing shape: "+i);
      
      //check each shapes bounds if the mouse is within them
      if (x > shape[i][0] && x < shape[i][2] + shape[i][0] && y > shape[i][1] && shape[i][3] + shape[i][1]){
        console.log("shape touched!!");
      }else{
        console.log("shape not touched!!");
      }
    }
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
  
    //draw starting text
    drawText(100,300,"Combine the Squares!!","orange",1);
    
    //makes some event listeners
    document.getElementById("canvas").addEventListener("click", onClicks);
    //document.getElementById("canvas").addEventListener("click", onClicks);

  }

 
  init();
  
  document.getElementById("canvas").addEventListener("click", onClicks);

  
</script>

<?php
makeFooter("blah blah blah","True");
?>