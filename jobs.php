<?php
require_once 'config.php';
require_once 'functions.php';

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

mysql_select_db('stt', $g_link);

$query = "SELECT name, id FROM students WHERE active=1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$studentarray[$row['id']]=$row['name'];
}	
if(isset($_GET["Student"])){
	$query = "UPDATE  `jobs` SET  `claimedby` =".$_GET["Student"]." WHERE id =".$_GET["Jobid"];
	$result = mysql_query($query);
	if($result) echo "McKayla should put a message here.<BR>";
	else echo "ERROR: McKayla should put a message here.<BR>";
}

function printjobs($result, $claimable) {
  while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    if($row['priority']>7)
	echo "<tr bgcolor='red'>";
    else if($row['priority']>3)
	echo "<tr bgcolor='orange'>";
    else
	echo "<tr>";
    echo "<td>".$row['sname']."</td><td>".$row['description']."</td><td>".$row['points']."</td><td>".$row['category']."</td><td>";
    if($row['name'] != 'Steavie'){
         echo $row['name']."</td></tr>";
    }
    else if($row['repeatable']){
	echo "all</td></tr>";
    }
    else if($claimable){
	echo 
		"<button type='button' id='button' onclick='claimjobfunction(".$row['id'].")'>
		Claim Job
	</button>
	</td></tr>";
    }
  } // End While
}
	

$script = "
		<script>
	function claimjobfunction(jobid) {
		student=document.UncleGreg.ClaimedBy.value
		if (student==0){
			alert('You need to select your name below to claim a job.')
		}
		else {
			document.getElementById('button').innerHTML=student;
			document.Theform.Jobid.value=jobid
			document.Theform.Student.value=student
			document.getElementById('Theform').submit();

		}
	}	
	</script>
	<style>
	td{
		color:white;
	}
	a{color:white;}
	</style>";
makeHeader("Job List","Job List",2,$script);
?>
	<body>
		<form name="Theform" id="Theform">
			<input type="hidden" name="Jobid">
			<input type="hidden" name="Student">
		</form>
<?php

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
mysql_select_db('stt', $g_link);

	$query = "SELECT a.name as sname, a.description, b.category, a.points, c.name, a.priority, a.repeatable, a.id
	FROM jobs a, skillcategories b, students c
	WHERE status<4 AND a.skillcatid=b.id AND a.status=1 AND (a.claimedby=c.id OR (a.claimedby=0 AND c.id=9))";
if ($_GET['sortby']=='category') {///order by category 
	$query = $query ." ORDER BY category";
}
else if ($_GET['sortby']=='points') {
	$query= $query ."order by points";
}	
else {  /// order by default 
	$query = $query . " ORDER BY priority DESC, points";
}	
	
if ($_GET['order']=='DESC'){ 
	$query= $query ." DESC";		 
}

	
	
print_r($_GET);	
		echo $_GET['sortby'];
print_r($_GET);
	echo $_GET['order'];
	
	
	
	
$query2 = "SELECT owner as sname, problem as description, 'Computer Hardware' as category, point_value as points, b.name, 1 as priority, 0 as repeatable, a.id 
FROM devices a, students b 
WHERE status_id < 6 AND (a.assignedto_id = b.id OR (a.assignedto_id=0 AND b.id=9))
ORDER BY status_id";
	


$result = mysql_query($query);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
echo "<table border=1>";
if ($_GET['order']=='ASC') {
echo "<tr><td>Job</td><td>Description</td><td>
<a  href='jobs.php?sortby=points&order=DESC'>Points</a> v</td><td>
<a href='jobs.php?sortby=category'>Category</a></td><td>Claimed By</td></tr>";
}
		
else if ($_GET['order']=='DESC') {
echo "<tr><td>Job</td><td>Description</td><td>
<a  href='jobs.php?sortby=points&order=ASC'>Points</a> ^</td><td>
<a href='jobs.php?sortby=category'>Category</a></td><td>Claimed By</td></tr>";
}	
		else {
			echo "<tr><td>Job</td><td>Description</td><td>
<a  href='jobs.php?sortby=points&order=ASC'>Points</a></td><td>
<a href='jobs.php?sortby=category'>Category</a></td><td>Claimed By</td></tr>";
}	
		
		
///printjobs($result2, false);

///echo "<tr><td>Job</td><td>Description</td><td>Points</td><td>Category</td><td>Claimed By</td></tr>";

printjobs($result, true);
	
echo "</table>";


mysql_close($g_link);

?>

		<form name="UncleGreg">
		<?php
			echo "<select name='ClaimedBy' id='ClamiedBy'>";
			echo "<option value=0>------</option>";
			foreach($studentarray as $id=>$name){
				echo "<option value=$id>$name</option>";
			}
			echo "</select>";
?>
		</form>
<?php
makefooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a><a href='create_jobs.php'>Create Job</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>
