<?php
require_once 'config.php';
require_once 'functions.php';

promptLogin(1);

makeHeader("Award points", "Award Points", 2,"awardpoints.php", '<link href="/css_files/create_jobs.css" rel="stylesheet">');

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

mysql_select_db('stt', $g_link);

?>
<HTML>
	<center>
	<HEAD>
		<SCRIPT type="text/javascript">
		function jobchange(id){
			document.getElementById("points").value = points[id];
			document.getElementById("category_id").value = category[id];
			document.getElementById("job_id").value = id;
		}
		</SCRIPT>
	</HEAD>
	<BODY>
		
<?php
$studentarray = array();
$query = "SELECT name, id FROM students WHERE active=1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$studentarray[$row['id']]=$row['name'];
}	

if($_POST)
{
	$jobid=$_POST['job_id'];
	if(isset($_POST['resolve'])){
		$query = "UPDATE jobs SET status=4 WHERE id=".$jobid;
   		$result = mysql_query($query);
		if($result) {echo "resovled job ".$jobid.".<BR>";}
		else {echo mysql_error($g_link);}
	}
	$query = "INSERT INTO `stt`.`points` (`job_id`, `student_id`, `points`, `category_id`) VALUES ('".$jobid."', '".$_POST['student_id']."', '".$_POST['points']."', '".$_POST['category_id']."')";
    $result = mysql_query($query);
	if($result) {echo $_POST['points']." points added for student ".$studentarray[$_POST['student_id']].".<BR>";}
	else {echo mysql_error($g_link);}
}
else
{
    echo "Enter points here.<BR>";
}
?>
<form method=post name=theform>
<table>
<tr><td>Student</td><td>
   <select name=student_id>
	   <option value=''>---</option>
<?php
foreach ($studentarray as $key=>$value){
	echo "<option value=".$key.">".$value."</option>";
}	
?>
   </select>
</td></tr>
<tr><td>Job</td><td>
   Incomplete Jobs:<select name=firstjob onchange="jobchange(this.value)">
	   <option value=''>---</option>
<?php
$query = "SELECT name, id, points, skillcatid FROM jobs WHERE status=1";
$result = mysql_query($query);
$pointarray = "var points = [];";
$categoryarray = "var category = [];";
while ($row = mysql_fetch_assoc($result)) {
	$pointarray.="points[".$row['id']."]=".$row['points'].";";
	$categoryarray.="category[".$row['id']."]=".$row['skillcatid'].";";
	echo "<option value=".$row['id'].">".$row['name']."</option>";
}	
?>
</select>
	<BR>
Complete Jobs:<select name=secondjob onchange="jobchange(this.value)">
	   <option value=''>---</option>
<?php
$query = "SELECT name, id, points, skillcatid FROM jobs WHERE status=3";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$pointarray.="points[".$row['id']."]=".$row['points'].";";
	$categoryarray.="category[".$row['id']."]=".$row['skillcatid'].";";
	echo "<option value=".$row['id'].">".$row['name']."</option>";
}	
?>
</select>
	<BR>
Repeatable Jobs:<select name=thirdjob onchange="jobchange(this.value)">
	   <option value=''>---</option>
<?php
$query = "SELECT name, id, points, skillcatid FROM jobs WHERE status<4 AND repeatable=1";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$pointarray.="points[".$row['id']."]=".$row['points'].";";
	$categoryarray.="category[".$row['id']."]=".$row['skillcatid'].";";
	echo "<option value=".$row['id'].">".$row['name']."</option>";
}	
echo"</select>
<script>";
echo $pointarray;
echo $categoryarray;
echo "
</script><BR>";
?>
<input type="text" name="job_id" id="job_id"></td></tr>
<tr><td><input type=checkbox name="resolve" id="resolve" value="resolve">Resolve job?</td></tr>
<tr><td>Points</td><td><input type="text" name="points" id="points"></td></tr>
<tr><td>Point Category</td><td><input type="text" name="category_id" id="category_id" value="1"></td></tr>
<tr><td colspan=2><input type="submit"></td></tr>
</table>
</form>
		
		
	</BODY>
</HTML>
<?php
mysql_close($g_link);
?>
		</center>
