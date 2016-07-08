
<?php
/*require_once 'MyFunctions.php';
?>
<html>
	<header>
	    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="../Jon_style.css">
		<title>My Page</title>
	</header>
</html>
<center>
<div style="background:silver;color:black;width:50%;border-radius:8px;">
	<?php
	
	class me{

		public $FullName;
		public $FavoriteSong;
		public $Birthday;
		public $BestExtraCurricular;
		public $GraduationYear;
		public $favoriteClass;
		public $whatnow;
		
		
		
	
 private function Knowledge(){
    echo "Allons-y";
  }
  
 		function __construct($a,$b,$c,$d,$e,$f,$g){
			$this->FullName = $a;
			$this->Birthday = $b;
			$this->FavoriteSong = $c;
			$this->BestExtraCurricular = $d;
			$this->GraduationYear = $e;
			$this->favoriteClass = $f;
			$this->whatnow = $g;
		}
		
		
		
		function printall(){
			echo "<h2 style='padding:0;margin:0 0 10px 0;'>What do you want to know?</h2>";
			echo "My full name is " . $this->FullName . "<br>";
			echo "My birthday is on " . $this->Birthday . "<br>";
			echo "My favorite song is " . $this->FavoriteSong . "<br>";
			echo "My personal favorite extra-curricular is " . $this->BestExtraCurricular . "<br>";
			echo "I am in the class of " . $this->GraduationYear . "<br>";
			echo "My favorite class is " . $this->favoriteClass . "<br><br>";
		}
		
		

		

}
	
	class SomeStuff extends me{ // This is the new class extending the original class
		public $CoolBand; // new objects
		public $FOOD;
		public $TeamIronMan;
		public $Yes;
		
		function __construct($C, $F, $I, $Y){ // here I overwrite the old construct function
		$this->CoolBand = $C;
    $this->FOOD = $F;
    $this->TeamIronMan = $I;
    $this->Yes = $Y;
		}
		
		function printall(){ // here I overwrite but preserve the parent function
			parent:: printall();
			echo   $this->CoolBand . " is awesome<br>";
			echo "I need some " .  $this->FOOD . " right now<br>";
			echo "I am on " . $this->TeamIronMan . "<br>";
			echo "Did I practically copy Austin Hamilton's work? " . $this->Yes . "<br>";
		}
		
	}
	

	$coolStuff = new SomeStuff("MCR","good food", "Team Iron Man", "No");
	
  $coolStuff->printall();


	$reminder->printall();
	
	echo $coolStuff;
	
	$coolStuff = " ";
	
	echo $reminder;

	$reminder = "plant";
	
	
 */
?>
<?php 
//All lines through 58 are the lines used for the parent function
require_once 'MyFunctions.php';

//makeHeader("My Page", "What would you like to know?", 2, "NewPage");
?>
<html>
	<header>

	    <link rel="stylesheet" href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/bootstrap.css">
    <link rel="stylesheet" href="../Jon_style.css">
		<title>My Page</title>
	</header>
</html>
<center>
<div style="background:silver;color:black;width:50%;border-radius:8px;">

	<?php
	{
	class me{

		public $FullName;
		public $FavoriteSong;
		public $Birthday;
		public $BestExtraCurricular;
		public $GraduationYear;
		public $favoriteClass;
		static $whatnow;
  
 private function Yay(){ // Use a private function to prevent overwriting of this information
	 echo "Yay, we saved some stuff";
 }
 		function __construct($a,$b,$c,$d,$e,$f,$g){
			$this->FullName = $a;
			$this->Birthday = $b;
			$this->FavoriteSong = $c;
			$this->BestExtraCurricular = $d;
			$this->GraduationYear = $e;
			$this->favoriteClass = $f;
			$this->whatnow = $g;
		}
	function printall(){
			echo "<h2 style='padding:0;margin:0 0 10px 0;'>What do you want to know?</h2>";
			echo "My full name is " . $this->FullName . "<br>";
			echo "My birthday is on " . $this->Birthday . "<br>";
			echo "My favorite song is " . $this->FavoriteSong . "<br>";
			echo "My personal favorite extra-curricular is " . $this->BestExtraCurricular . "<br>";
			echo "I am in the class of " . $this->GraduationYear . "<br>";
			echo "My favorite class is " . $this->favoriteClass . "<br><br>";
		}	
		protected	function _toString(){ // protect this function to prevent the original function from being converted to a string.
		return "Can't work with me, can't work without me. DECIDE WHAT YOU WANT PHP!!!!!<br><br>";
	}
	}	
		
		
		
		
		
		

		
		
	class SomeStuff extends me{ // This is the new class extending the original class
		public $CoolBand; // new objects
		public $FOOD;
		public $TeamIronMan;
		public $Yes;
		
		function __construct($C, $F, $I, $Y){ // here I overwrite the old construct function
		$this->CoolBand = $C;
    $this->FOOD = $F;
    $this->TeamIronMan = $I;
    $this->Yes = $Y;
		}
		
		function printall(){ // here I overwrite but preserve the parent function
			parent:: printall();
			echo   $this->CoolBand . " is awesome<br>";
			echo "I need some " .  $this->FOOD . " right now<br>";
			echo "I am on " . $this->TeamIronMan . "<br>";
			echo "Did I practically copy Austin Hamilton's work? " . $this->Yes . "<br>";
		}

	}
	$reminder = new me("Jonathan Richard Zimmer","March 14","Fireflies by Owl City","First Tech Challenge",2018,"my computer class","My favorite song");
	$reminder->printall();
	echo $reminder;
	$reminder=" ";
	
	$coolStuff = new SomeStuff("MCR","good food", "Team Iron Man", "No");
  $coolStuff->printall();
	echo $coolStuff;
	$coolStuff=" ";
	}
	?>
</div>
</center>





