<?php
require_once "functions.php";
require_once "config.php";
//promptLogin(); // Don't need to log in for this page

function weekdiff($date1, $date2) {
   if($date1 > $date2) return weekdiff($date2, $date1);
    $first = DateTime::createFromFormat('m/d/Y', $date1);
    $second = DateTime::createFromFormat('m/d/Y', $date2);
    return floor($first->diff($second)->days/7);
}

$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

$label = 'now';

if($_GET['type']=='lastweek'){
   $type = 'lastweek';
}
else if($_GET['type']=='all'){
   $type = 'all';
}
else{
   $type = 'thisweek';
}


$query = "SELECT a.id, a.name, b.points, c.category
FROM students a, points b, skillcategories c
WHERE a.id=b.student_id AND b.category_id=c.id";

if($type=='thisweek'){ // If this is a weekly score and not a total score
    $label = 'the Current Week';
    $last_sunday = date('Y-m-d H:i_s', strtotime('last Sunday'));
    $query .= " AND b.timestamp > '$last_sunday'";
}
else if($type=='lastweek'){ // If this is a weekly score and not a total score
    $label = 'the Last Week';
    $last_sunday = date('Y-m-d H:i_s', strtotime('-1 weeks Sunday'));
    $last_last_sunday = date('Y-m-d H:i_s', strtotime('-2 weeks Sunday'));
    $query .= " AND b.timestamp < '$last_sunday'";
    $query .= " AND b.timestamp > '$last_last_sunday'";
}
else if($type=='all'){
    $maxpoints = 100 - floor(100/20 * (weekdiff('05/27/2016', date("m/d/Y"))));
    $label='now';
}
else { // This shouldn't happen
    $label='ERROR';
}

mysql_select_db('stt', $g_link);
	
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

// prints one row at a time, the results from the database.
$scoreboard=array();
$names = array();
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
	$names[$row['id']]=$row['name'];
	if(isset($scoreboard[$row['id']]))
		$scoreboard[$row['id']] = $scoreboard[$row['id']] + $row['points'];
	else
		$scoreboard[$row['id']] = $row['points'];
}

mysql_close($g_link);

arsort($scoreboard);

makeHeader("Scoreboard for $label","Scoreboard for $label",2,"scoreboard.php","<meta http-equiv='refresh' content='60'><style> .meat a{color:white;} .meat{color:silver;}.meat table{color:white;}</style>");

//<meta http-equiv="refresh" content="60">
if($type=='thisweek') echo "thisWeek";
else echo "<a href='scoreboard.php?type=thisweek'>thisWeek</a>";
echo " | ";
if($type=='lastweek') echo "lastWeek";
else echo "<a href='scoreboard.php?type=lastweek'>lastWeek</a>";
echo " | ";
if($type=='all') echo "all";
else echo "<a href='scoreboard.php?type=all'>all</a>";

echo "<table><tr><td valign=top>";
if($label=='now') echo '<BR>Top 5<BR>(Out of '.$maxpoints.' points)';
echo "<table><tr><td>";
echo "<tr><td><nobr>Student</nobr></td><td>Score</td>";
$count=0;
foreach ($scoreboard as $key => $value) {
    if(($count++ < 5) || $type!='all'){
	echo "<tr><td><nobr><a href='studentJobs.php?id=$key'>".$names[$key]."</nobr></td><td>$value</td></tr>";
    }
}

makefooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black;} #footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>
