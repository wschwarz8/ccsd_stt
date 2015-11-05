<?php  require_once '../config.php';  ?>

<!DOCTYPE html>
<html class="mainelement">

<header>
	<title>PHP Fun</title>
	<link href="css_files/commonCSS.css" rel="stylesheet">
	<link href="css_files/phpPage.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="javascript_files/commonJS.js"></script>
</header>

<body>
	<div class="back" onload="onpageloads()">
		<div class="header">
			<h1 id="title">
				<?php echo"My PHP Page"; ?>
			</h1>
		</div>
		<div class= "bodyarea" id="theme1">
			<div class="phpbox" id="theme2">
				<h1>
					<?php echo"PHP Query Test 1"; ?>
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
			
			<!--add more stuff here that is not php -->
			
			
		</div>
	</div>
</body>

</html>