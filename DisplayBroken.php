<?php
require_once 'config.php';
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$query = "SELECT 'file name(s)'";
mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Job</td><td>Description</td><td>Points</td><td>Category</td><td>Claimed By</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['']."</td><td>".$row['']."</td><td>".$row['']."</td><td>".$row['']."</td><td>".$row['']."</td></tr>";
}
echo "</table>";
mysql_close($g_link);
?>