<?php
require_once "../functions.php";
require_once "../config.php";
makeHeader("Color Mixer", "Color Mixer", 0,'<link href="css_files/phpGamePage.css" rel="stylesheet"><link href="css_files/commonCSS.css" rel="stylesheet"><link href="css_files/phpPage.css" rel="stylesheet"><script language="javascript" type="text/javascript" src="javascript_files/phpGamePage.js"></script>');

?>

<style>
  div{
    text-align:center;
  }

</style>

  <div class="gameframe" style="background:black;opacity:0.9;margin:10px 1% 10px 1%">
    
    <div class="colorBox" style="background:white;height:175px;">
      
      <h1 id="colorBoxText" style="text-align:center; color:Black;">Color Choices</h1>
      
      <div class="colorChoice" style="background:black;height:105px;margin:5px 1% 5px 1%;padding-top:5px;">
        <div class="red" draggable="true">
          Red
        </div>
        <div class="Orange" draggable="true">
          Orange
        </div>
        
        <div class="Yellow" draggable="true">
          Yellow
        </div>
        
        <div class="Green" draggable="true">
          Green
        </div>
        
        <div class="Blue" draggable="true">
          Blue
        </div>
        
        <div class="Purple" draggable="true">
          Purple
        </div>
      </div>
    </div>
  </div>

  <?php

makeFooter("",0,"false");
?>