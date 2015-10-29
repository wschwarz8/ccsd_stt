<?php
require_once "functions.php";
require_once 'config.php';

makeHeader("STT HOME","STT HOME",0);

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
    $maxpoints = 100 - floor(100/20 * (weekdiff('1/8/2016', date("m/d/Y"))));
    $label='now<BR><BR>(Out of '.$maxpoints.' points)';
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

?>
<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
<body>
<?php
if($type=='thisweek') echo "thisWeek";
else echo "<a href='scoreboard.php?type=thisweek'>thisWeek</a>";
echo " | ";
if($type=='lastweek') echo "lastWeek";
else echo "<a href='scoreboard.php?type=lastweek'>lastWeek</a>";
echo " | ";
if($type=='all') echo "all";
else echo "<a href='scoreboard.php?type=all'>all</a>";

echo "<table><tr><td valign=top>";
echo "<nobr><h3>Scores for $label</h3></nobr>";
echo "<table><tr><td>";
echo "<tr><td>Student</td><td>Score</td>";
foreach ($scoreboard as $key => $value) {
    echo "<tr><td><a href='studentJobs.php?id=$key'>".$names[$key]."</td><td>$value</td></tr>";
}
echo "</table>";

$obj = json_decode(stream_get_contents(fopen("http://xkcd.com/info.0.json", "rb")));
echo "</td><td>";
echo "<a href='http://xkcd.com'><img src='".$obj->{'img'}."'></a>";
echo "</td></tr></table>";

	makefooter("",0);
?>
