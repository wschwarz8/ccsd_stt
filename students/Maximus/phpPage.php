<?php  
require_once 'experimentalFunctions.php';

makeHeader("PHP Object-oriented Programing Practice", "PHP Object-oriented Programing Practice", 2, "phpPage.php");
?>


		<div class= "bodyarea" id="theme1">
			<div class="phpbox" id="theme2">
				<h1>
					PHP OOP Practice 1
				</h1>
				<div class="phpcodebox" id="theme1">
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
							echo "Testing 1.2.3.4... can you hear me????<br><br>";
						}
						
						function __construct($f,$l,$p,$n,$g,$c,$fc){
							$this->firstName = $f;
							$this->lastName = $l;
							$this->phoneNumber = $p;
							$this->lockerNumber = $n;
							$this->grade = $g;
							$this->classs = $c;
							$this->favoriteClass = $fc;
						}
						
						function printall(){
							echo "Student Data<br><br>";
							echo "Firstname: " . $this->firstName . "<br>";
							echo "Lastname: " . $this->lastName . "<br>";
							echo "Phone Number:  " . $this->phoneNumber . "<br>";
							echo "Locker Number: " . $this->lockerNumber . "<br>";
							echo "Grade: " . $this->grade . "<br>";
							echo "Class: " . $this->classs . "<br>";
							echo "Favorite Class: " . $this->favoriteClass . "<br><br>";
						}
						
						function __destruct(){
							$this->firstName;
							$this->lastName;
							$this->phoneNumber;
							$this->lockerNumber;
							$this->grade;
							$this->classs;
							$this->favoriteClass;
						}
							
					}
					
					
					$cat = new student("Max","DeVos","867-5306",348,11,2017,"Chemistry");
					$cat->test();
					$cat->printall();
					
					$dog = new student("Mad","Max","5306 - 867",384,11,1720,"Study hall");
					$dog->printall();
					
					
					
					?>
				</div>
			</div>	
		</div>


<?php
makeFooter("Programing is Fun",0,"True");
?>
