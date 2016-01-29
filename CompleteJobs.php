<?php
require_once 'config.php';
require_once 'functions.php';
require_once "Classes/jobsClass.php";


promptLogin(1);
	makeHeader("Complete Jobs","Complete Jobs",2,"CompleteJobs.php",'<link href="/css_files/create_jobs.css" rel="stylesheet">');
?>
<div style="background:black;color:black;width:50%;border-radius:8px;">
<?php
$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
mysql_select_db('stt', $g_link);
//	$query="SELECT `jobs`.id, `jobs`.name as jobname, `description`, `status`, `points`, `claimedby`, `jobstatus`.id, `jobstatus`.name FROM `jobs`, `jobstatus` WHERE jobs.status=jobstatus.id and jobstatus.id=3";
$query="SELECT `id`, `name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`, `bypassLimit`  FROM `jobs` WHERE status=3";
$result = mysql_query($query);
	
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

echo "<table border=1>";
	echo"<tr><td>Name</td><td>Description</td><td>Points</td><td>Who thought they finished it</td><td>What do you want to do?</td></tr>";
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>"
			.$row['name']."</td><td>"
			.$row['description']."</td><td>"
			.$row['points']."</td><td>"
			.$row['claimedby']."</td><td>
		<button class='unclaimedButt' type='submit' name='jobsToList' value='2'>Job isn't finished</button><br>
		<button class='unclaimedButt' type='submit' name='jobsToList' value='2'>They finished it</button>
</td></tr>";
}
mysql_close($g_link);
?>