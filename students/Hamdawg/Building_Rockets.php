<?php 
//All lines through 58 are the lines used for the parent function
require_once 'PersonalUseFunctions.php';
makeHeader("OOP Programming", "OOP Programming", 2, "Building_Rockets");
?>
<center>
<h1>
	Programming II Homework 1: Introduction to Object Oriented Programming
</h1>

<div style="background:Silver;color:Black;width:50%;border-radius:8px;">
	<?php
class RocketShip
{

  public $command_module;
  public $fuel_tankA;
  public $fuel_tankB;
  public $payload;
  public $engines;
  static $spacestation;
  
 private function ToMars() // Use a private function to prevent overwriting of this ship
  {
    echo "Alright Men it's time we prepare ourselves for a mission to Mars, first we need to CONSTRUCT a rocket to launch into low earth orbit and DESTRUCT an old Space Station for parts!<pr></pr> Then When you get back, dont get TOSTRING-y with me, you need to then record all of your results.";
  }
  
  function __construct($c,$A,$B,$p,$e,$s)
  {
    $this->command_module = $c;
    $this->fuel_tankA = $A;
    $this->fuel_tankB = $B;
    $this->payload = $p;
    $this->engines = $e;
		$this->spacestation = $s;
    echo "<h4 style='padding:0;margin:0 0 10px 0;'>Alright Commander, time to start your mission, head to objective briefing and listen in!</h4>";
  }
  
  function printall()
  {
			echo "<h4 style='padding:0;margin:0 0 10px 0;'>Build Process</h4>";
			echo "Part 1:  " . $this->command_module . "<br>";
			echo "Part 2: " .  $this->fuel_tankA . "<br>";
			echo "Part 3: " . $this->fuel_tankB  . "<br>";
			echo "Part 4: " . $this->payload . "<br>";
			echo "Part 5: " . $this->engines . "<br><br>";
	}
	
	function __destruct()
	{
		echo $this->spacestation . " Has been Completely Destroyed!";
	}
	
protected	function __toString() // protect this function to prevent the original function from being converted to a string.
	{
		return"Commander! You Can't print a rocketship, try again!<br><br>";
	}
}
	
	class SpaceBalls extends Rocketship // Thia is the new class extending the original class
	{
		public $RaspberryJam; // new objects
		public $DarkHelmet;
		public $StarDestroyer;
		public $TheSchwartz;
		
		function __construct($R, $D, $S, $T) // here I overwrite the old construct function
		{
		$this->RaspberryJam = $R;
    $this->DarkHelmet = $D;
    $this->StarDestroyer = $S;
    $this->TheSchwartz = $T;
    
		echo "This vessel has been jammed by Lone Star!";
		}
		
		function printall() // here I overwrite but preserve the parent function
		{
			parent:: printall();
			echo "Part 1:  " . $this->RaspberryJam . "<br>";
			echo "Part 2: " .  $this->DarkHelmet . "<br>";
			echo "Part 3: " . $this->StarDestroyer . "<br>";
			echo "Part 4: " . $this->TheSchwartz . "<br>";
			echo "Don't worry captain this is okay!";
		}
		
	}
	

	$build = new SpaceBalls("Raspberry","Ludicrous Speed", "stuff", "Totally not a reference");
	echo "<h2> Mission Objective!</h2><br>";
	
  echo "<h2>Lets See what we have to work with on parts here then!</h2><br>";
  $build->printall();
		

	
	echo "<h2>Now lets try to take a shortcut on the paperwork and print the Object!</h2><br>";
	echo $build;
	echo "<h4 style='padding:0;margin:0 0 10px 0;'>Woops! I guess there is no shortcut...</h4>";
	
	echo "<h2>We need to destroy that Russian Space Station for Parts, launch the payload!</h2><br>";
	$build = " ";
	

	
	echo "<h2> Congratulations Commander, you have officially completed your first space mission with OOP in PHP</h2><br>";
	
	echo "Heavy Appreciation to Max DeVos to helping me figure this out, as well as giving me the outline for the page design used in this site! If you want a guideline on how to do the homework, check his site out, or read this code as it derives pretty similarly from his. Thank you!";
  	?>
</div>
</center>

