 <!-- web paint v1.0 -->
<!-- February 2, 2016 -->
<!DOCTYPE html>
<html>
  <head>
    <title>Paint</title>
    <link href="css_files/drawing.css" rel="stylesheet">
    <script language="javascript" type="text/javascript" src="javascript_files/drawing.js"></script>
  </head>
  <body>
    
    <div class="canvasPositioningFrame">
      <canvas id='drawingCanvas' height='500px' width='600px'>If you see this you must still be in 2005!</canvas>
    </div>
    
    <div class="controlFrame">
      
      <button onclick="changeColor('red')">Red</button>
      <button onclick="changeColor('orange')">Orange</button>
      <button onclick="changeColor('yellow')">Yellow</button>
      <button onclick="changeColor('green')">Green</button>
      <button onclick="changeColor('blue')">Blue</button>
      <button onclick="changeColor('purple')">Purple</button>
      
    </div>
    
  </body>
  <script>
  init()
  </script>
</html>
 