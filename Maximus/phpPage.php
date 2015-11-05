<?php  
require_once '../config.php';
require_once '../functions.php';

makeHeader("PHP Page", "My PHP Page", 0 , '<link href="css_files/commonCSS.css" rel="stylesheet">
	<link href="css_files/phpPage.css" rel="stylesheet">');
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
//makefooter("");
?>
