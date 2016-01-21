<?php
require_once 'config.php';
require_once 'functions.php';
promptLogin(1);
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
mysql_select_db('stt', $g_link);

mysql_close($g_link);
?>