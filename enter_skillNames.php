<?php
if($_POST['skillName'])
{
		
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
