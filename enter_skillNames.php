<?php
require_once 'config.php';
require_once "functions.php";

promptLogin();

if($_POST)
{
	$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
	
	mysql_select_db('stt', $g_link);
	
	$query = "INSERT INTO `stt`.`skills` (`id`, `skillName`, `skillcatid`) VALUES (NULL, 'Computer database design', '1')";
	
	mysql_close($g_link);
}
else
{
?>
<DOCTYPE
Enter a skill here.<BR>
<form method=post name=theform>
<table>
<tr><td>Skill Name:</td><td><input type=text name=skillName></td></tr>
<tr><td colspan=2><input type="submit"></td></tr>
</table>
</form>
<?php
}
?>
