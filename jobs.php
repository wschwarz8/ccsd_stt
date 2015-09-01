<?php
require_once 'config.php';

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

$query = "SELECT a.name as sname, a.description, b.category, a.points, c.name
FROM jobs a, skillcategories b, students c
WHERE a.skillcatid=b.id AND a.status=1 AND (a.claimedby=c.id OR (a.claimedby=0 AND c.id=9))";

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Job</td><td>Description</td><td>Points</td><td>Category</td><td>Claimed By</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['sname']."</td><td>".$row['description']."</td><td>".$row['points']."</td><td>".$row['category']."</td><td>";
    if($row['name'] != 'Steavie'){
         echo $row['name']."</td></tr>";
    }
    echo "-</td></tr>";
}
echo "</table>";


mysql_close($g_link);

?>
