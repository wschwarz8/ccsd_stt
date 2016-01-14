<?php
require_once "functions.php";
require_once 'config.php';
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$rewardsquery = "SELECT `id`, `title`, `category`, `points`, `description` FROM `Rewards` WHERE 1";
mysql_select_db('stt', $g_link);
$result = mysql_query($rewardsquery);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
makeHeader("STT HOME","Broken Chromebooks",2,"DisplayBroken.php","<style>td{color:white;}</style>");
// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Reward</td><td>Description</td><td>Category of Reward</td><td>Points</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
//	print_r($row);die;
    echo "<tr><td>".$row['title'].
			"</td><td>".$row['description'].
			"</td><td>".$row['category'].
			"</td><td>".$row['points']."</td></tr>";
}
echo "</table>";
mysql_close($g_link);
?>