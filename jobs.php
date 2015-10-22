<?php
require_once 'config.php';

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

mysql_select_db('stt', $g_link);

$query = "SELECT name, id FROM students WHERE active=1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$studentarray[$row['id']]=$row['name'];
}	



?>
<html>
	<head>
		<script>
	function claimjobfunction(jobid, student) {
		student=prompt('What is your name?')
		//alert(jobid+student)
		alert(document.Theform.Jobid)
		document.Theform.Jobid.value=jobid
		alert(document.Theform.Student)
		document.Theform.Student.value=student
		document.getElementById("Theform").submit();
		document.getElementById("button").innerHTML = student
		}
	</script>
	</head>
	<body>
		<form name="Theform" id="Theform">
			<input type="text" name="Jobid">
			<input type="text" name="Student">
		</form>
<?php

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

$query = "SELECT a.name as sname, a.description, b.category, a.points, c.name, a.priority, a.repeatable, a.id
FROM jobs a, skillcategories b, students c
WHERE status<4 AND a.skillcatid=b.id AND a.status=1 AND (a.claimedby=c.id OR (a.claimedby=0 AND c.id=9))
ORDER BY priority DESC, category";

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
echo "<table border=1>";
echo "<tr><td>Job</td><td>Description</td><td>Points</td><td>Category</td><td>Claimed By</td></tr>";
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
    echo 
		"<button type='button' id='button' onclick='claimjobfunction(".$row['id'].")'>
		Claim Job
	</button>
	
	</td></tr>";
	
} // end while

	
echo "</table>";


mysql_close($g_link);

?>

	<dev id=dev>
		<select name="Jobs" id="Jobs">
				<option value="hardware">"Computer Hardware"</option>
				<option value="software">Computer Software</option>
				<option value="programming">Programming</option>
				<option value="unclassified">Unclassified</option>
				<option value="documentation">Training/Documentation</option>
		</select>
		

		<?php
			echo "<select name='Claimed By' id='ClamiedBy'>";
			
			foreach($studentarray as $id=>$name){
				//print_r($names);
				echo "<option>$name</option>";
			}
			echo "</select>";
?>
		<select name="Claimed By" id="ClamiedBy">
				<option>"Austin Hamilton"</option>
				<option>"Britton Ankrum"</option>
				<option>"Crystal Guthridge"</option>
				<option>"D.J. Phillips"</option>
				<option>"Ethan George"</option>
				<option>"Jaydon Lane"</option>
				<option>"Jonathan Zimmer"</option>
				<option>"Mason 'gee' Hill"</option>
				<option>"Max DeVoss"</option>
				<option>"McKayla Benson"</option>
				<option>"Steavie"</option>
		</select>
		</dev>
	</body>
</html>

