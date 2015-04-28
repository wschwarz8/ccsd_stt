<?php
if($POST)
{
	$g_link = mysql_connect('localhost', 'techmod', 'QbKrlIpdB');
	
	mysql_select_db('stt', $g_link);
	
	INSERT INTO `stt`.`skills` (`id`, `skillName`, `skillcatid`) VALUES (NULL, 'Computer database design', '1');	
	
	mysql_close($g_link);
}
else
{
		
}