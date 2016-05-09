<?php
    
  require_once "functions.php";
	require_once "config.php";

  promptLogin(1);

	makeHeader("Student Skills","Student Skills",2,"studentSkillsListing.php",'<style>td{color:white;border:1px solid white;}</style>');




	//check if the table was submitted for up dates
	if (isset($_POST)){
		
		$studentQuery = queryFunc("SELECT `id`, `name`, `active` FROM `students` WHERE 1");
		while($studentResults = mysql_fetch_assoc($studentQuery)){//only choose active students

			//cycle throught the skills for each person
			$skillQuery = queryFunc("SELECT `id`, `skillName`, `skillcatid` FROM `skills` WHERE 1");
			while($skillResults = mysql_fetch_assoc($skillQuery)){

			$studentSkillQuery = queryFunc("SELECT `skid` From `studentsxskills` WHERE stid=".$studentResults['id']." AND skid=".$skillResults['skillcatid']);
			$studentSkillResults = mysql_fetch_assoc($studentSkillQuery);
				
			if ($skillResults['id'] != $studentSkillResults['skid']){
				
				if (isset($_POST[''.$studentResults['id'].$skillResults['skillcatid'].'']) && $_POST[''.$studentResults['id'].$skillResults['skillcatid'].''] == 1){
					$updateQuery = "INSERT INTO `studentsxskills`(`stid`, `skid`) VALUES (".$studentResults['id'].",".$skillResults['skillcatid'].")";
					
					queryFunc($updateQuery);
				}
			}else{
				if (isset($_POST[''.$studentResults['id'].$skillResults['skillcatid'].'']) && $_POST[''.$studentResults['id'].$skillResults['skillcatid'].''] == 2){
				$deleteQuery = "DELETE FROM `studentsxskills` WHERE stid=".$studentResults['id']." AND skid=".$skillResults['skillcatid'];
					queryFunc($deleteQuery);
				}
			}
				


			}//end of skill result while

		}//end of student result while
		
	}//end of post if



  //print beginning of table
  echo("
  <center>
	<form name='skillUpdate' method='post'>
	<fieldset>
	<legend>Student Skills Listing</legend>
    <table style='margin:10px;'>
  ");

  //print initial row
  echo "<tr> <td>Student</td>";

  $skillQuery = queryFunc("SELECT `id`, `skillName`, `skillcatid` FROM `skills` WHERE 1");
	while($skillResults = mysql_fetch_assoc($skillQuery)){
     echo "<td>".$skillResults['skillName']."</td>";
	}
  echo "</tr>";

  //print row by row the skills each person has with an x if the have it
$studentQuery = queryFunc("SELECT `id`, `name`, `active` FROM `students` WHERE 1");
	while($studentResults = mysql_fetch_assoc($studentQuery)){
    echo "<tr><td>".$studentResults['name']."</td>";
	
		//cycle throught the skills for each person
		$skillQuery = queryFunc("SELECT `id`, `skillName`, `skillcatid` FROM `skills` WHERE 1");
		while($skillResults = mysql_fetch_assoc($skillQuery)){
		
		$studentSkillQuery = queryFunc("SELECT `skid` From `studentsxskills` WHERE stid=".$studentResults['id']." AND skid=".$skillResults['skillcatid']);
		$studentSkillResults = mysql_fetch_assoc($studentSkillQuery);
			if ($skillResults['id'] == $studentSkillResults['skid']){
				echo "<td style='background:green;'>
								<center>
									<input name='".$studentResults['id'].$skillResults['skillcatid']."' type='checkbox' value='2'>
								</center>
							</td>";
			}else{
				echo "<td style='background:red;'>
								<center>
								<input name='".$studentResults['id'].$skillResults['skillcatid']."' type='checkbox' value='1' >
								</center>
							</td>";
			}
		}
	echo "</tr>";
	}

//print end of table
  echo("
    </table>
		</fieldset>
		<button type='submit' name='updateButt' style='margin:10px;background:white;color:black;'>Update Skills</button>
		</form>
  </center>
  ");



  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");


?>