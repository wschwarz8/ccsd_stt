<!doctype html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Canvas Drag and Drop Test</title>
</head>

<body>
  <section>

    <div>
      <canvas id="canvas" width="800" height="800">
        This text is displayed if your browser does not support HTML5 Canvas.
      </canvas>
    </div>

      <script type="text/javascript">
        var c=document.getElementById("canvas");
        var canvas= c.getContext("2d")
        canvas.rect(20,20,20,20);
        canvas.stroke();
        
        canvas.onmousemove = mousemoved;
        
        function mousemoved(e){
          x = e.pageX - canvas.offsetLeft;
          y = e.pageY - canvas.offsetRight;
          canvas.clear;
          canvas.rect(20,20,x,y);
          canvas.stroke();
        }
    </script>

  </section>
</body>

</html>