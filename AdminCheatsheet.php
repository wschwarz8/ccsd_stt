	<?php


    require_once 'config.php';
    require_once 'functions.php';
		makeheader("Cheatsheet", "Cheatsheet", 2, "AdminCheatsheet.php",'<link href="/css_files/homePage.css" rel="stylesheet">');
		promptLogin(1);


    $g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT * FROM `students` WHERE `active` = 1";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
	?>
<html>
	<style>
		table, th, td 
		{
			color: white;
			border: 1px solid white;
			border-collapse: collapse;
			
		}
		
		th, td 
		{
			padding: 5px;
		}
	</style>
	<center><h4>
		Students Table!
		</h4>
	</center>
	
	<table border = 1 style= "width:100%">
					<tr>
					<th><?php echo "Student id"; ?></th>
					<th><?php echo "Student name"; ?></th>
					<th><?php echo "Username";?></th>
					<th><?php echo "Active";?></th>

		</tr>
			<?php
		while($row = mysql_fetch_assoc($result))
        {
					$myid = $row['id'];
					$myname = $row['username'];
					$name = $row['name'];
					$active = $row['active'];		
					$idrow[$myid] = $myid;
					$namerow[$myid] = $name;
					$userrow[$myid] = $myname;
					$activerow[$myid] = $active;
        }
			foreach($idrow as $myid)
			{		
				
					echo	"<tr><td>$myid.</td><td>$namerow[$myid]</td><td>$userrow[$myid]</td><td>$activerow[$myid]</td></tr>";
			}	
			?>


	</table>
	<br>
	<br>
	<br>
	<br>
	<center><h4>
		Skill Table!
		</h4></center>
	<table border = 1 style = "width:100%">
		<tr>
			<th><?php echo "Skill id";?></th>
			<th><?php echo "Skill name";?></th>
			<th><?php echo "Skill Suit";?></th>
			<?php
		$g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT * FROM `skillcategories` WHERE 1";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		
			while($row = mysql_fetch_assoc($result))
        {
		
			$skillname = $row['id'];
			$skillid = $row['category'];
			$skillsuit = $row['suit'];
			
			
					$skillarray[$skillid] = $skillid;
					$skillpirate[$skillid] = $skillname;
					$suitrow[$skillid] = $skillsuit;
				
	
        }
			foreach($skillarray as $skillid)
			{		
				
					echo	"<tr><td>$skillid</td><td>$skillpirate[$skillid]</td><td>$suitrow[$skillid]</td></tr>";
			}
			

				makefooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='#'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
			
				?>
		</tr>
	</table>
</html>
  
