<?php
require_once 'config.php';
require_once "functions.php";
promptLogin();
makeHeader("Student Jobs", "Student Jobs",2,"studentJobs.php",'<meta http-equiv="refresh" content="60"><style>td{color:white;}</style>');
if(isset($_GET['id'])){
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$stid=$_GET['id'];
$query = "SELECT a.name studentname, b.timestamp, b.points, d.name as jobname
FROM students a, points b, jobs d
WHERE a.id=$stid AND a.id=b.student_id AND d.id=b.job_id
ORDER BY timestamp DESC";
mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
	
	$nameQuery = "SELECT * FROM `students` WHERE id=". $_GET['id'];
	$results = mysql_query($nameQuery);
	while ($info= mysql_fetch_assoc($results)) { // TODO format to look better
			$namePart = $info['name'];
    }
	
echo "<h3>Recent jobs for ". $namePart ."</h3>";
echo "<table border=1>";
echo "<tr><td>Student</td><td>Date</td><td>Job</td><td>Points</td>";
// prints one row at a time, the results from the database.
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['studentname']."</td><td>".$row['timestamp']."</td><td>".$row['jobname']."</td><td>".$row['points']."</td>";
}
mysql_close($g_link);
echo "</table>";
echo "</body></html>";
}
else{
   echo "You forgot to tell me which student to show.<BR><BR><img src='http://storage.googleapis.com/chromeos-mgmt/0gjdgxs0jovce3/ChromeOsWallpaper/f5aac6c6-025d-4cc9-b8f5-da49114ca310'>";
}
makefooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>
