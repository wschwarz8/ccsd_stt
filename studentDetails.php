<?php
require_once 'config.php';
require_once "functions.php";
//promptLogin();
?>
<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
<body>
<?php
if(isset($_GET['id'])){
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$stid=$_GET['id'];
$query = "SELECT students.*
FROM students
WHERE id=$stid AND active=1";
	$query2="SELECT points FROM points";
	
if(isset($stid)) {
	mysql_select_db('stt', $g_link);
	$result = mysql_query($query);
	if (!$result) {
    die('Invalid query: ' . mysql_error());
	}

	$row = mysql_fetch_assoc($result);
	echo "<h3>Details for ".$row['name']."</h3>";
	echo "<table>";
	echo "<tr><td>Class of ".$row['class']."</td>";
	echo "<tr><td>Points that ".$row['name'] . " has: ";

	}
			mysql_select_db('stt', $g_link);
	$result2 = mysql_query($query2);
	if (!$result2) {
    die('Invalid query: ' . mysql_error());
$row2=mysql_fetch_assoc($result2);	
echo	$row2.['points']. "</td>";
	}
	mysql_close($g_link);
	echo "</tr>";
	echo "</table>";
	echo "</body></html>";
}
else{
   echo "You forgot to tell me which student to show.<BR><BR><img src='http://storage.googleapis.com/chromeos-mgmt/0gjdgxs0jovce3/ChromeOsWallpaper/f5aac6c6-025d-4cc9-b8f5-da49114ca310'>";
}
?>