<?php  
require_once 'MyFunctions.php';

makeHeader("My PHP Page!!", "My PHP Page!!", 2, "NewPage.php");
?>

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

		public function test(){
			echo "<h1>My page that has some info on me</h1><br><br>";
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

		function __destruct(){
			echo $this->whatnow ." has been changed to another song<br><br>";
		}

		//this is a fail safe to prevent a error if it is printed i think
		function __toString(){
			return"This is the class object, not some text to be just printed, so it IS important<br><br>";
		}
	}

	$reminder = new me("Jonathan Richard Zimmer","March 14","Fireflies by Owl City","First Tech Challenge",2018,"my computer class","My favorite song");

	$reminder->test();

	$reminder->printall();

	echo $reminder;

	$reminder = "plant"



	?>
</div>
</center>

