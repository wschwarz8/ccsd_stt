<?php
mysql_connect('localhost', 'techmod', 'QbKrlIpdB');

$query = "SELECT `skills`.*, `students`.*, `studentsxskills`.`stid`
FROM `studentsxskills`, `skills`, `students`
WHERE ((`studentsxskills`.`stid` = students.id) AND (`studentsxskills`.`skid` = skills.id))";

$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row[name];
    echo $row[gradclass];
    echo $row[skillName];
    
}
?>
