<?php
require_once 'config.php';
require_once 'functions.php';

promptLogin(1);


$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

mysql_select_db('stt', $g_link);

//check if any buttons were pressed
if (isset($_POST['jobsToList'])){
	//job is done
	if ($_POST['jobsToList'] == 2){
		$changeJobStatusQuery = "UPDATE `jobs` SET `status`=4 WHERE id=".$_POST['formIdentifier'];
		
		//commence query
		$result = mysql_query($changeJobStatusQuery);
		
	}
	//job is not done
	if($_POST['jobsToList'] == 1){
		
		$modifyPointsQuery = "DELETE FROM `points` WHERE job_id=".$_POST['formIdentifier'];
		//commence query
		mysql_query($modifyPointsQuery);
		
		$changeJobStatusQuery = "UPDATE `jobs` SET `status`=2 WHERE id=".$_POST['formIdentifier'];
		//commence query
		mysql_query($changeJobStatusQuery);
		
	}
}


//make query to 
//$query = "SELECT `jobs`.id, `jobs`.name as jobname, `description`, `status`, `points`, `claimedby`, `jobstatus`.id, `jobstatus`.name FROM `jobs`, `jobstatus` WHERE jobs.status=jobstatus.id and jobstatus.id=3";
$query ="SELECT * FROM `jobs` WHERE status=3;";

$result = mysql_query($query);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

echo "<table border=1>";

echo ("
	<tr>
		<td>Name</td>
		<td>Description</td>
		<td>Points</td>
		<td>Who thought they finished it</td>
		<td>What do you want to do?</td>
	</tr>
	");

while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
	
	echo ("
	<tr>
		<td>".$row['name']."</td>
		<td>".$row['description']."</td>
		<td>".$row['points']."</td>
		<td>".$row['claimedby']./*add a name query here*/"</td>
		<td>
			<form method='post' name='dostuffbutts'>
				<button type='submit' name='jobsToList' value='1'>Job isn't finished</button><br>
				<button type='submit' name='jobsToList' value='2'>They finished it</button>
				<input type='hidden' name='formIdentifier' value='".$row['id']."'>
			</form>
		</td>
	</tr>
	");
	
}
mysql_close($g_link);
?>