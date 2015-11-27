<?php
require_once 'config.php';

if($_POST)
{
	$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
	mysql_select_db('stt', $g_link);
	$query = "INSERT INTO `devices`(`id`, `owner`, `assignedto_id`, `received`, `problem`, `resolution`, `notes`, `repaired`, `returned`, `last_update`, `receivedby_id`, `serial`, `point_value`, `status_id`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])";
mysql_close($g_link);
}
else
{
?>
<DOCTYPE
Fill out the form.<BR>
<form method=post name=theform>
<table>
<tr><td>Owner:</td><td><input type=text name=owner></td></tr>
<tr><td>Recieved by:</td><td><input type=text name=receivedby_id></td></tr>
<tr><td>Recieved:</td><td><input type=date name=receivedr></td></tr>
<tr><td>Problem:</td><td><input type=text name=problem></td></tr>
<tr><td>Notes:</td><td><input type=text name=notes></td></tr>
<tr><td>Serial Number:</td><td><input type=text name=serial></td></tr>
<tr><td colspan=2><input type="submit"></td></tr>
</table>
</form>
<?php
}
?>
