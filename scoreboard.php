<?php
$g_link = mysql_connect('localhost', 'root', ''); //TODO use a persistant database connection

$query = "SELECT a.name, b.points, c.category
FROM students a, points b, skillcategories c
WHERE a.id=b.student_id AND b.category_id=c.id";

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
$scoreboard=array();
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
	if(isset($scoreboard[$row['name']]))
		$scoreboard[$row['name']] = $scoreboard[$row['name']] + $row['points'];
	else
		$scoreboard[$row['name']] = $row['points'];
}

mysql_close($g_link);

arsort($scoreboard);

echo "<table><tr><td>";
echo "<tr><td>Student</td><td>Score</td>";
foreach ($scoreboard as $key => $value) {
    echo "<tr><td>$key</td><td>$value</td></tr>";
}
echo "</table>";

?>
