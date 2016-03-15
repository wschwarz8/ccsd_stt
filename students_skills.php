<?php
require_once 'config.php';
require_once "functions.php";

    $g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT * FROM `students` WHERE `active` = 1";
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
					$userrow[$myid] = $myname;
					$activerow[$myid] = $active;
        }

	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

				echo "<table border=1>";
				echo"<td></td>";
		foreach($idrow as $myid){
				echo "<td>$namerow[$myid]</td>";
		}

    

mysql_close($g_link);
?>
