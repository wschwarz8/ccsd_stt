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
  var myCanvas = document.getElementById('canvas');
  var canvas = myCanvas.getContext('2d');
  
  canvas.fillStyle = 'red';
  
  canvas.rect(100,100,100,100);
  canvas.rect(300,100,100,100);
  canvas.arc(250, 350, 70, 0, Math.PI * 2);
  canvas.fill();
  canvas.stroke();
  
</script>

<?php
makeFooter("blah blah blah","True");
?>