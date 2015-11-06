<?php
require_once 'config.php';
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
$query = "SELECT `id`, `owner`, `assignedto_id`, `received`, `problem`, `resolution`, `notes`, `repaired`, `returned`, `last_update`, `receivedby_id`, `serial`, `point_value`, `status_id` FROM `devices`";
mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Id</td><td>Owner</td><td>Assigned To</td><td>Received</td><td>Problem</td><td>Resolution</td><td>Notes</td><td>Repaired</td><td>Returned</td><td>Last Update</td><td>Received By</td><td>Serial Number</td>
<td>Point Value</td><td>Status</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['id']."</td><td>".$row['owner']."</td><td>".$row['assignedto_id']."</td><td>".$row['recieved']."</td><td>".$row['problem']."</td><td>".$row['resolution']."</td><td>".$row['notes']."</td>
	<td>".$row['repaired']."</td><td>".$row['returned']."</td><td>".$row['last_update']."</td><td>".$row['receivedby_id']."</td><td>".$row['serial']."</td><td>".$row['point_value']."</td><td>".$row['status_id']."</td>
	</tr>";
}
echo "</table>";
mysql_close($g_link);
?>