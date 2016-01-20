<?php  
require_once 'experimentalFunctions.php';

makeHeader("PHP Object-oriented Programing Practice", "PHP Object-oriented Programing Practice", 2, "phpPage.php");
?>

<center>
<h1>
	PHP OOP Homework 1
</h1>

<div style="background:silver;color:black;width:50%;border-radius:8px;">
	<?php
	class student{

		public $firstName;
		public $lastName;
		public $phoneNumber;
		public $lockerNumber;
		public $grade;
		public $classs;
		public $favoriteClass;

		public function test(){
			echo "Testing 1.2.3.4... can you read me????<br><br>";
		}

		function __construct($f,$l,$p,$n,$g,$c,$fc){
			$this->firstName = $f;
			$this->lastName = $l;
			$this->phoneNumber = $p;
			$this->lockerNumber = $n;
			$this->grade = $g;
			$this->classs = $c;
			$this->favoriteClass = $fc;
			echo"Student Created";
		}

		function printall(){
			echo "<h4 style='padding:0;margin:0 0 10px 0;'>Student Data</h4>";
			echo "Firstname: " . $this->firstName . "<br>";
			echo "Lastname: " . $this->lastName . "<br>";
			echo "Phone Number:  " . $this->phoneNumber . "<br>";
			echo "Locker Number: " . $this->lockerNumber . "<br>";
			echo "Grade: " . $this->grade . "<br>";
			echo "Class: " . $this->classs . "<br>";
			echo "Favorite Class: " . $this->favoriteClass . "<br><br>";
		}

		//do anything when object is shutdown/deleted
		function __destruct(){
			echo $this->firstName ." has been obliterated<br><br>";
		}

		//this is a fail safe to prevent a error if it is printed i think
		function __toString(){
			return"This is the student object not some text to be just printed<br><br>";
		}
	}

	echo "<h2>Create a new object from the student class</h2><br>";
	$cat = new student("Max","DeVos","867-5309",348,11,2017,"Chemistry");

	echo "<h2>Run a test method</h2><br>";
	$cat->test();

	echo "<h2>Run a printall method for a student</h2><br>";
	$cat->printall();

	echo "<h2>Try to print the student object as text</h2><br>";
	echo $cat;

	echo "<h2>Activate the destruct function by giving the object the text value of 'dog'</h2><br>";
	$cat = "dog"



	?>
</div>
</center>

<?php
makeFooter("Programing is Fun",0,"True");
?>
