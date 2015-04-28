<?php
if($_POST['skillName'])
{
	$g_link = mysql_connect('localhost', 'techmod', 'QbKrlIpdB');
	
	mysql_select_db('stt', $g_link);
	
	INSERT INTO `stt`.`skills` (`id`, `skillName`, `skillcatid`) VALUES (NULL, 'Computer database design', '1');	
	
	mysql_close($g_link);
}
else {
?>
Enter a new skill<BR><BR>
<table>
<form name='theForm' method='POST'>
<tr><td>Skill name</td><td><input type='text' name='skillName'></td></tr>
<tr><td colspan=2><input type='submit'></td></tr>
</tr>
</form>
</table>
<?php
}
?>
