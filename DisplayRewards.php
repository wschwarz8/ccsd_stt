<?php
require_once "functions.php";
require_once 'config.php';


$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections


$query = "SELECT title, skillcategories.category, points, description FROM `Rewards`, `skillcategories` WHERE Rewards.category=skillcategories.id";


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
	

mysql_select_db('stt', $g_link);


$result = mysql_query($query);





if (!$result) {
    die('Invalid query: ' . mysql_error());
}


makeHeader("Got some points?","ALL DA REWARDS",2,"DisplayRewards.php","<style>td{color:white;}</style>");


// prints one row at a time, the results from the database.
echo "<table border=1>";

echo "<tr><td>Reward</td><td>Description</td><td>Category of Reward</td><td>Points</td></tr>";

while ($row = mysql_fetch_assoc($result)) { // TODO format to look better
    echo "<tr><td>".$row['title'].
			"</td><td>".$row['description'].
			"</td><td>".$row['category'].
			"</td><td>".$row['points']."</td></tr>";
}

echo "</table>";



if ($_GET['order']=='ASC') {
echo "<tr><td>Reward</td><td>Description</td><td>
<a  href='DisplayRewards.php?sortby=points&order=DESC'>Points</a> v</td><td>
<a href='DisplayRewards.php?sortby=category'>Category of Reward</a></td>";
}
		
 else if ($_GET['order']=='DESC') {
echo "<tr><td>Reward</td><td>Description</td><td>
<a  href='DisplayRewards.php?sortby=points&order=ASC'>Points</a> ^</td><td>
<a href='DisplayRewards.php?sortby=category'>Category of Reward</a></td>";
}	
		else{
			echo "<tr><td>Reward</td><td>Description</td><td>
<a  href='DisplayRewards.php?sortby=points&order=ASC'>Points</a></td><td>
<a href='DisplayRewards.php?sortby=category'>Category</a></td>";
}	
mysql_close($g_link);
?>