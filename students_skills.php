
<?php
require_once 'config.php';
require_once "functions.php";
    $g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT a.name , c.skillName
FROM students a, studentsxskills b, skills c
WHERE a.active =1
AND a.id = b.stid
AND c.id = b.skid";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		mysql_select_db('stt', $g_link);
		$blank="  ";

	echo "<table border=0>";
while($row = mysql_fetch_assoc($result))
        {	
	if($last != $row['name']){
		echo "<tr><td>&nbsp;</td></tr>";
		echo "<tr><td colspan=2>".$row['name']."</td></tr>";
	}
	echo "<tr><td>&nbsp;</td>";
	echo "<td>".$row['skillName']."</td></tr>";
	$last = $row['name'];
		}


if (!$result) {
    die('Invalid query: ' . mysql_error());
}
mysql_close($g_link);
?>
