<?php
  require_once "../../functions.php";
  require_once "../../config.php";

  makeHeader("Dice Roller", "Dice Roller", 2, "dice.php");

?>

<style>
  button{
    background:white;
    color:black;
  }
  h3{
    color:white;
  }
</style>

<h1>
  Roll a Dice!
</h1>

<p>
  
  <button onclick="rollADice('r1')">
    Dice 1 
  </button>
  <h3 id="r1">
   
  </h3>

  <br>
  
  <button onclick="rollADice('r2')">
    Dice 2
  </button>
  <h3 id="r2">
   
  </h3>
  <br>
  
  <button onclick="rollADice('r3')">
    Dice 3
  </button>
  <h3 id="r3">
   
  </h3>
  <br>
  
  <button onclick="rollADice('r4')">
    Dice 4
  </button>
  <h3 id="r4">
   
  </h3>
  <br>
  
</p>

<script>

  function rollADice(diceNumber){
    randomNumber = Math.floor((Math.random() * 6) + 1);
    document.getElementById(diceNumber).innerHTML = "<div style='border-radius:5px;background:red;margin:0;padding-top:3px;padding-left:3px;height:50px;width:50px;'><img height='47px' width='47px'  style='margin:0;padding:0;' src='./Textures/diceImages/" + randomNumber + "Side.png'></div>";
    calculateStuff();
  }

</script>


<?php

makeFooter("Programing is Fun",0,"True");

?>