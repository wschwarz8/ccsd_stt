<?php
    
  require_once "functions.php";
	require_once "config.php";

  promptLogin(1);

	makeHeader("Student Skills","Student Skills",2,"studentSkillsListing.php",'<style>td{color:white;border:1px solid white;}</style>');

  //print beginning of table
  echo("
  <center>
    <table>
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
				echo "<td><center>X</center></td>";
			}else{
				echo "<td></td>";
			}
		}
	echo "</tr>";
	}

//print end of table
  echo("
    </table>
  </center>
  ");



  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");


?>