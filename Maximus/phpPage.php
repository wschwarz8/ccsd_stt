<?php  
require_once '../config.php';
require_once '../functions.php';
echo $_SERVER('PHP_SELF');

makeHeader("PHP Page", "My PHP Page", 2);
?>


		<div class= "bodyarea" id="theme1">
			<div class="phpbox" id="theme2">
				<h1>
					PHP Query Test 1
				</h1>
				<div class="phpcodebox" id="theme1">
					<?php
						echo "test 1.2.3.4...";
					
						// Create connection
						$conn = new mysqli("localhost", $g_username, $g_password);
						
						// Check connection
						if ($conn->connect_error) {
 						   die("Connection failed: " . $conn->connect_error);
						} 
						echo "Connected successfully";
					
						
					

						$conn->close();
					?>
				</div>
			</div>	
		</div>


<?php
makeFooter("",0,"false");
?>
