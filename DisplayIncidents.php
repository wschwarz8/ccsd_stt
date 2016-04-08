<?php
require_once 'config.php';
require_once "functions.php";

promptLogin();
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$devicequery = "SELECT * FROM `incidents`";
mysql_select_db('stt', $g_link);

$categoryquery = "SELECT name, id FROM devicecatagories ";

$result2 = mysql_query($categoryquery);
while ($row = mysql_fetch_assoc($result2)) {
	$devicearray[$row['id']]=$row['name'];
}	
$namequery = "SELECT name, id FROM students";

$result3 = mysql_query($namequery);
while ($row = mysql_fetch_assoc($result3)) {
	$namearray[$row['id']]=$row['name'];
}


$result = mysql_query($devicequery);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
makeHeader("STT HOME","Incident Listing",2,"DisplayIncidents.php","<style>td{color:white;}</style>");
// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>date</td><td>owner</td><td>status</td><td>laptopserial</td><td>chargerserial</td><td>laptoptaken</td><td>chargertaken</td><td>newlaptop</td><td>newlaptopserial</td><td>Recevied By</td><td>newchargerserial</td><td>explanation</td>
</tr>";
while ($row = mysql_fetch_assoc($result))  // TODO format to look better
//	print_r($row);die;
{
    echo "<tr><td>".$row['date'].
			"</td><td>".$row['owner'].
			"</td><td>".$row['status'].
			"</td><td>".$row['laptopserial'].
			"</td><td>".$row['chargerserial'];
		if($row['laptoptaken'] ==1){
				echo "</td><td>yes";
				}
				if($row['laptoptaken'] ==0){
				echo "</td><td>no";
				}
		if($row['chargertaken'] ==1){
				echo "</td><td>yes";
				}
				if($row['chargertaken'] ==0){
				echo "</td><td>no";
				}
		if($row['newlaptop'] ==1){
				echo "</td><td>no";
				}
				if($row['newlaptop'] ==2){
				echo "</td><td>yes";
				} 
			echo"</td><td>".$row['newlaptopserial'].
			"</td><td>".$namearray[$row['receviedby']].
			"</td><td>".$row['newchargerserial'].
			"</td><td>".$row['explanation'];
			
}
echo "</table>";
mysql_close($g_link);
makefooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>
