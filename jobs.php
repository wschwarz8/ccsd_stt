<?php
$g_link = mysql_connect('localhost', 'root', ''); //TODO use a persistant database connection

$query = "SELECT a.name, a.description, b.category, a.points, c.name
FROM jobs a, skillcategories b, students c
WHERE a.skillcatid=b.id AND a.status=1 and a.claimedby=c.id";

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Job</td><td>Description</td><td>Points</td><td>Category</td><td>Claimed By</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['points']."</td><td>".$row['category']."</td><td>".$row['name']."</td></tr>";
}
echo "</table>";


mysql_close($g_link);

?>