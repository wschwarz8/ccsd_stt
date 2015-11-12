<?php
require_once "functions.php";
require_once 'config.php';
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$rewardquery = "SELECT `id`, `title`, `category`, `points`, `description` FROM `Rewards`";
mysql_select_db('stt', $g_link);

//$categoryquery = "SELECT name, id FROM devicecategories";

//$result2 = mysql_query($categoryquery);
//while ($row = mysql_fetch_assoc($result2)) {
//	$devicearray[$row['id']]=$row['name'];
//}	
//$namequery = "SELECT name, id FROM students";

//$result3 = mysql_query($namequery);
//while ($row = mysql_fetch_assoc($result3)) {
//	$namearray[$row['id']]=$row['name'];
//}


$result = mysql_query($rewardquery);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Reward</td><td>Description</td><td>Points</td><td>Category</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
//	print_r($row);die;
    echo "<tr><td>".$row['title'].
			"</td><td>".$row['description'].
			"</td><td>".$row['points'].
			"</td><td>".$row['category']."</td></tr>";
}
echo "</table>";
mysql_close($g_link);
?>