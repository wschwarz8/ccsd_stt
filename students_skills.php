
<?php
require_once 'config.php';
require_once "functions.php";
    $g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT a . * , b . * , c . * 
FROM students a, studentsxskills b, skills c
WHERE a.active =1
AND a.id = b.stid
AND c.id = b.skid";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		mysql_select_db('stt', $g_link);
	$blank="  ";

while($row = mysql_fetch_assoc($result))
        {	
					$myid = $row['id'];
					$myname = $row['username'];
					$name = $row['name'];
					$active = $row['active'];		
					$idrow[$myid] = $myid;
					$namerow[$myid] = $name;
				print var_dump($namerow[$myid]);
					$userrow[$myid] = $myname;
					$activerow[$myid] = $active;
        
	
$result = mysql_query($query);

				echo "<table border=1>";
				echo"<td></td>";
				echo "<td>$namerow[$myid]</td>";
	echo ("
		<tr><td>Computer Software</td></tr>
		<tr><td>Computer Hardware</td></tr>
		<tr><td>Programming</td></tr>
		<tr><td>Training/Documentation</td></tr>
");
		}


if (!$result) {
    die('Invalid query: ' . mysql_error());
}
mysql_close($g_link);
?>
