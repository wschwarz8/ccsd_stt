<?php
  require_once "functions.php";
	require_once "config.php";
promptLogin(1);

	makeHeader("Create Jobs","Create a job",2,"create_jobs.php",'<link href="/css_files/create_jobs.css" rel="stylesheet">');

?>

<center>
	<div class="centeringDiv">
	<h2>
		Create a Job
	</h2>
  <form method="post" name="postIt">
    <table>
      <!-- job name input field -->
      <tr><td>Job Name</td><td><input type="text" name="jName" placeholder="Name"></td></tr>
      <!-- job description input field -->
      <tr><td>Job Description</td><td><textarea name="jDesc" placeholder="Description"></textarea></td></tr>
      <!-- job skill category input field -->
      <tr><td>Job Skill Category</td>
        <td>
          <select name="jSkill">
            <!-- replace options with a query later -->
            <option value="1">Unclassified</option>
            <option value="2">Computer Software</option>
            <option value="3">Programming</option>
            <option value="4">Training/Documentation</option>
            <option value="5">Computer Hardware</option>
          </select>
        </td>
      </tr>
      <!-- job status input field -->
      <tr><td>Job status</td><td><input type="text" name="jStatus" value="1" placeholder="Status"></td></tr>
      <!-- job Points input field -->
      <tr><td>Job Points</td><td><input type="text" name="jPoints" value="1" placeholder="Points"></td></tr>
      <tr><td>Job Claim</td>
        <td>
          <select name="jClaim" value="0">
						<option value="0">No one</option>
            <?php
						//start connection
						$conn = mysql_connect("localhost", $g_username, $g_password);

						//access correct database
						mysql_select_db('stt', $conn);
						
						//query students
						$studentQuery = "SELECT name, id FROM students WHERE active=1";
						
						$studentz = mysql_query($studentQuery);
						
						while ($row = mysql_fetch_assoc($studentz)) {
							$students[$row['id']]=$row['name'];
						}	
						
						foreach($students as $id=>$name){
							echo "<option value=$id>$name</option>";
						}
						
						?>
						
          </select>
        </td>
      </tr>
      <!-- job repeatable input field -->
      <tr><td>Priority</td><td><input type="text" name="jPriority" value="1" placeholder="Priority"></td></tr>
      <!-- job repeatable input field -->
      
      <tr><td colspan="2" style="text-align:center;"><input type="submit"></td></tr>
    </table>
  </form>
		<?php

	 if ($_POST){
		$jDesc=mysql_real_escape_string($_POST['jDesc']);
		  
		 //make query
$queryinsertjob = "INSERT INTO `jobs`( `name`, `description`, `skillcatid`, `status`, `points`, `claimedby`, `priority`) VALUES ('".$_POST['jName']."','".$jDesc."', ".$_POST['jSkill'].", ".$_POST['jStatus'].", ".$_POST['jPoints'].", ".$_POST['jClaim'].", ".$_POST['jPriority'].")";

		 //commence query
		 $rsp = mysql_query($queryinsertjob);
		 
		 if($rsp) echo"Job Created :)";
		 else {
			echo "ERROR";
    			die('Invalid query: ' . mysql_error());
		}
			
		 
		 mysql_close($conn);
		 
		 //clear old variables
		 $_POST['jName'] = "";
		 $_POST['jDesc'] = "";
		 $_POST['jSkill'] = "";
		 $_POST['jStatus'] = "";
		 $_POST['jPoints'] = "";
		 $_POST['jClaim'] = "";
		 $_POST['jPriority'] = "";
	 }
	else if($_POST) {
		echo "ERROR: Job not created";
	}
		?>
	</div>
</center>

<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>
