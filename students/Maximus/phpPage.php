<?php  
require_once '../../functions.php';
require_once '../../config.php';

makeHeader("PHP Object-oriented Programing Practice", "PHP Object-oriented Programing Practice", 2, "phpPage.php");
?>

<center>
<h1>
	PHP OOP Homework 2
</h1>

<div style="background:silver;color:black;width:50%;border-radius:8px;">
	<?php
	
	//animal class
	class animal{
		
		//initialize some properties universal to an animal
		public $animalGender;
		public $animalGroup;
		public $animalName;
		public $animalScientificName;

		//function to test if the object is functioning properly
		protected function test(){//protected function
			echo "Testing 1.2.3.4... can you read me????<br><br>";
		}

		//construct the inputs of the class into meaningful variables specific to the class
		function __construct($input_1,$input_2,$input_3,$input_4){
			
			$this->animalGender = $input_1;
			$this->animalGroup = $input_2;
			$this->animalName = $input_3;
			$this->animalScientificName = $input_4;
			echo "<h3>Animal object Created</h3><br>";
			
		}
		
		//print all the desired info about the class
		function printall(){
			echo ("
			<fieldset>
				<legend> <h3>Animal object printall Func</h3> </legend>
				
				<p>
				Animal Name: ". $this->animalName ."<br>
				Scientific Name: ". $this->animalScientificName ."<br>
				Animal Group: ". $this->animalGroup ."<br>
				Animal Gender: ". $this->animalGender ."<br>
				</p>
				
			</fieldset>
			<br>
			");
		}

		public function doStuff(){
			$this->test();
		}
		
		//do anything when object is shutdown/deleted or when code reaches end of execution
		function __destruct(){
			//echo "animal object has been obliterated<br><br>";
		}

		//this is a fail safe to prevent a error if it is printed
		function __toString(){
			return"This is the animal object not some text to be just printed<br><br>";
		}
				
	}
	
	class dog extends animal{
		
		private $dogInfo;//privite property
		static $dogCount;//static property
		
		function __construct($input_1,$input_2,$input_3,$input_4,$input_5){//overwrite the animal constructor
			
			$this->animalGender = $input_1;
			$this->animalGroup = $input_2;
			$this->animalName = $input_3;
			$this->animalScientificName = $input_4;
			$this->dogInfo = $input_5;
			$this->dogCount = "1 Dog";
			echo "<h3>Dog object Created from extended animal class</h3><br>";
			
		}
		
		function printall(){
			
			parent::printall();
			echo ("
			<fieldset>
				<legend> <h3>Dog Object printall Func</h3> </legend>
				<p>".$this->dogInfo."</p>
				
			</fieldset>
			<br>
			");
		}
		
		public function dogInfo(){
			echo "Dogs are mans best friend.";
		}
		
	}

	//print some stuff to display that it works
	
	//question 1
	echo "<h1>1. Init two objects from the same class.</h1>";
	
	//init a cat
	$cat = new animal("Male", "Mammal", "Cat", "Felis catus");
	//init a dog
	$dog = new animal("Female", "Mammal", "dog", "Canis lupus familiaris");
	
	//question 2
	echo "<h1>2. Use class inheritance to extend a class.</h1>";
	
	$newDog = new dog("Female", "Mammal", "dog", "Canis lupus familiaris","dogs are mans best friend.");
	
	//question 3
	echo "<h1>3. In the extended class overwrite properties and methods</h1>";//already did that
	
	echo "<p>construct method is overwritten.</p>";
	
	//question 4
	echo "<h1>4. overwrite a method but preserve the original method</h1>";
	
	$newDog->printall();
	
	//question 5
	echo "<h1>5. Correctly declare and access at least one of each type: public, private, protected, and static.</h1>";
	
	echo "(a) Public Property: ";
	echo $newDog->animalName."<br>";
	
	echo "(b) Private Property: ";
	echo $newDog->dogInfo."<br>";
	
	echo "(c) Protected Method: ";
	echo $dog->doStuff()."<br>";
	
	echo "(d) static Property: ";
	echo $newDog->dogCount."<br>";
	?>
</div>
</center>

<?php
makeFooter("Programing is Fun",0,"True");
?>
