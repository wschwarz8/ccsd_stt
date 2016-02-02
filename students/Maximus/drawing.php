<!-- web paint v1.1 -->
<!-- February 2, 2016 -->
<!DOCTYPE html>
<html>

<head>
  <title>Paint</title>
  <link href="css_files/drawing.css" rel="stylesheet">
  <script language="javascript" type="text/javascript" src="javascript_files/drawing.js"></script>
</head>

<body>

  <center>

    <div class="canvasPositioningFrame">
      <canvas id='drawingCanvas' height='500px' width='600px'>If you see this you must still be in 2005!</canvas>
    </div>

    <div class="controlFrame">

      <div class="colorFrame">
        <button class="colorButts" onclick="changeColor('red')" style="background:red;">Red</button>
        <button class="colorButts" onclick="changeColor('orange')" style="background:orange;">Orange</button>
        <br>
        <button class="colorButts" onclick="changeColor('yellow')" style="background:yellow;">Yellow</button>
        <button class="colorButts" onclick="changeColor('green')" style="background:green;">Green</button>
        <br>
        <button class="colorButts" onclick="changeColor('blue')" style="background:blue;">Blue</button>
        <button class="colorButts" onclick="changeColor('purple')" style="background:purple;">Purple</button>
      </div>

      <div class="eraserFrame">
        <button class="eraserButt" onclick="changeColor('white')" style="background:white;">Eraser</button>
      </div>

      <div class='tipFrame'>
        <center>
          <p id='tipInfo'>Tip Size: 10px</p>
          <button onclick='changeTipSize(tipSize - 1)'><<<</button>
          <button onclick='changeTipSize(tipSize + 1)'>>>></button>
          <p>Tip Type</p>
          <button onclick='changeTipType("square")'>Square</button>
          <button onclick='changeTipType("circle")'>Circle</button>
        </center>
      </div>

      <div class="instructionFrame">
        <center>
          <p>
            Draw what you feel like. Hint drawing
            <br>slower works better and you should 
            <br>have your browser full screen. More 
            <br>features will come later! To save a picture,
            <br>right click and select save image as.
          </p>
        </center>
      </div>
    </div>
      
  </center>
    
</body>
<script>
  init()
</script>

</html>