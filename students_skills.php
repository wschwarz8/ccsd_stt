<?php
$g_link = mysql_connect('localhost', 'root', ''); //TODO use a persistant database connection

$query = "SELECT `skills`.*, `students`.*, `studentsxskills`.`stid`
FROM `studentsxskills`, `skills`, `students`
WHERE ((`studentsxskills`.`stid` = students.id) AND (`studentsxskills`.`skid` = skills.id))";

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo $row["name"];
    echo $row["class"];
    echo $row["skillName"];
    
}

mysql_close($g_link);
?>
