<?php
require_once "functions.php";
require_once 'config.php';


$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections
mysql_select_db('stt', $g_link);


$query = "SELECT title, skillcategories.category, points, description FROM `Rewards`, `skillcategories` WHERE Rewards.category=skillcategories.id";
$result = mysql_query($query);


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
	








if (!$result) {
    die('Invalid query: ' . mysql_error());
}


makeHeader("Got some points?","ALL DA REWARDS",2,"DisplayRewards.php","<style>td{color:white;}</style>");


// prints one row at a time, the results from the database.
echo "<table border=1>";

//echo "<tr><td>Reward</td><td>Description</td><td>Category of Reward</td><td>Points</td></tr>";


//echo "</table>";



if ($_GET['order']=='ASC') {
echo "<tr><td>Reward</td><td>Description</td>
<td><a href='DisplayRewards.php?sortby=category'><font color=white>Category of Reward</font></a>
<td><a href='DisplayRewards.php?sortby=points&order=DESC'><font color=white>Points</a> v</font></td></td>";
}
		
 else if ($_GET['order']=='DESC') {
echo "<tr><td>Reward</td><td>Description</td>
<td><a href='DisplayRewards.php?sortby=category'><font color=white>Category of Reward</font></a>
<td><a  href='DisplayRewards.php?sortby=points&order=ASC'><font color=white>Points</a> ^</font></td></td>";
}	
		else{
			echo "<tr><td>Reward</td><td>Description</td>
			<td><a href='DisplayRewards.php?sortby=category'><font color=white>Category</font></a>
			<td><a  href='DisplayRewards.php?sortby=points&order=ASC'><font color=white>Points</font></a></td></td>";
}	
while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['title'].
			"</td><td>".$row['description'].
			"</td><td>".$row['category'].
			"</td><td>".$row['points']."</td></tr>";
}
mysql_close($g_link);
?>