<?php
  echo "HELLO WORLD using php";
    
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stt";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO jobs(name, skillcatid , status )
		VALUES ('xavier', '4', '3')";

if ($conn->query($sql) === TRUE) {
    echo "You did something right for once";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


    <style>
	

		html { 
  background: url(http://dreamatico.com/data_images/ocean/ocean-5.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	</style>
	
		</html>