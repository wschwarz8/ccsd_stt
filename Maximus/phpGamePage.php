<?php
require_once "../functions.php";
require_once "../config.php";
makeHeader("Color Mixer", "Color Mixer", 0,'<link href="css_files/phpGamePage.css" rel="stylesheet"><link href="css_files/commonCSS.css" rel="stylesheet"><link href="css_files/phpPage.css" rel="stylesheet"><script src="javascript_files/phpGamePage.js"></script>');
?>

  <div class="gameframe" style="background:black;opacity:0.9;margin:5px 1% 5px 1%;padding:5px;">

    <div class="colorBox" style="background:white;height:175px;">

      <h1 id="colorBoxText" style="text-align:center; color:Black;">Color Choices</h1>

      <div class="colorChoice" style="background:black;height:105px;margin:5px 1% 5px 1%;padding-top:5px;">

        <div class="CircleColor" id="redDiv" draggable="true">
          <p>
            Red
          </p>
        </div>

        <div class="CircleColor" id="orange" draggable="true">
          <p>
            Orange
          </p>
        </div>

        <div class="CircleColor" id="yellow" draggable="true">
          <p>
            Yellow
          </p>
        </div>

        <div class="CircleColor" id="green" draggable="true">
          <p>
            Green
          </p>
        </div>

        <div class="CircleColor" id="blue" draggable="true">
          <p>
            Blue
          </p>
        </div>

        <div class="CircleColor" id="purple" draggable="true">
          <p>
            Purple
          </p>
        </div>

      </div>
    </div>
    <div class="playArea">
      <div class="canvas" id="drawingSpace">
        test
        </div
    </div>
  </div>



  <?php

makeFooter("",0,"false");
?>