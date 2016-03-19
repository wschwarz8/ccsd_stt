<?php
require_once 'config.php';
require_once "functions.php";
promptLogin();

makeHeader("Student Profile", "Student Profile", 2, "studentDetails.php");

if(isset($_GET['id'])){
	
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$stid=$_GET['id'];
$query = "SELECT students . * , points.*
FROM students, points
WHERE students.id =$stid
AND active =1
AND students.id=points.student_id";	
if(isset($stid)) {
	mysql_select_db('stt', $g_link);
	$result = mysql_query($query);
	if (!$result) {
    die('Invalid query: ' . mysql_error());
	}
	$row = mysql_fetch_assoc($result);
	echo "<h3>Details for ".$row['name']."</h3>";
	echo "<table  style='color:white;'>";
	echo "<tr><td>Class of ".$row['class']."</td>";
	echo "<tr><td>Points that ".$row['name'] . " has: ";
	$points=$row['points'];
	while ($row = mysql_fetch_assoc($result)){
		$points= $row['points']+$points;
	}
echo $points. "</td>";
	echo "</table>";
	}
	
	
	}
else{
   echo "You forgot to tell me which student to show.<BR><BR><img src='http://storage.googleapis.com/chromeos-mgmt/0gjdgxs0jovce3/ChromeOsWallpaper/f5aac6c6-025d-4cc9-b8f5-da49114ca310'>";
}
	mysql_close($g_link);
	
makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page <a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black;} #footer p{color:black; text-decoration:underlined;}</style>",0,"true");

?>
