<?php
//todo
//add claim limit --> database file needs updated
//add working sort by logic
//add claimable all jobs <-- finished
//add ignore jobs -- needs a 3 column table   <--finished
//add alert message for when claiming,unclaiming, and resolving a job   <--finished

//get access to proper files
require_once 'config.php';
require_once "functions.php";
require_once "Classes/jobsClass.php";

//check for login
promptLogin();

//start a connection
$conn = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

//select a correct database
mysql_select_db('stt', $conn);

//set up the base of the page
makeHeader('Jobs List','Jobs List',2,"jobs2.php","<link href='css_files/jobs.css' rel='stylesheet'>");




//do stuff in here
function main(){
  
	//check for any forms submitted
  
	 $formMessage = "old jobs page exists at jobs.php if their is a problem :P";
	 $formCheck = "False";
	
	//check if any of the forms were submitted
	if (isset($_POST['formIdentifier'])){
		//logic for job claim,unclaim, and resolve logic
		if ($_POST['claimStatButt'] == 1){
			
			$viewerInfoQuery = "";
			
			//get info for processing
			$jobInfoQuery = "SELECT * FROM `jobs` WHERE id=" . $_POST['formIdentifier'];
			
			//send query
			$jobInfo = queryFunc($jobInfoQuery);
			
			//process query
			$jobdata = mysql_fetch_assoc($jobInfo);
			
			
			if ($jobdata['repeatable'] != 1){
			//make a query to claim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=".$_SESSION['loginid']." WHERE id=" . $_POST['formIdentifier'];
			queryFunc($claimStatQuery);
			//give a status message
			$formMessage = "You have Successfully Claimed a Job";
				
			}else{
			//make the duplicate job if its repeatable
			$addDupJobQuery = "INSERT INTO `jobs`(`name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`, `bypassLimit`) VALUES ('".$jobdata['name']."','".$jobdata['description']."',".$jobdata['skillcatid'].",1 ,".$jobdata['points'].",0 ,".$jobdata['limitone'].",".$_SESSION['loginid'].",".$jobdata['priority'].",".$jobdata['bypassLimit'].")";
			queryFunc($addDupJobQuery);	
				
			//ignore the original job so they cant claim it multiple times
			$ignoreJobQuery = "INSERT INTO `ignorejobs`(`studentname`, `jobid`) VALUES (".$_SESSION['loginid'].",".$_POST['formIdentifier'].")";
 			queryFunc($ignoreJobQuery);
				
			//give a status message
			$formMessage = "You have Successfully Claimed a Repeatable Job";
			}
			
			//give a status message
			$formMessage = "You have Successfully Claimed a Job";
		}else if($_POST['claimStatButt'] == 2){
			//make a query to unclaim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=0 WHERE id=" . $_POST['formIdentifier'];
			queryFunc($claimStatQuery);
			$formMessage = "You have Successfully Unclaimed a Job";

		}else if($_POST['claimStatButt'] == 3){
			
			//make a query to resolve a job
			$resolveQuery = "UPDATE `jobs` SET `status`=3 WHERE id=" . $_POST['formIdentifier'];
			
			//send query
			queryFunc($resolveQuery);
			
			//get info for adding points
			$jobInfoQuery = "SELECT * FROM `jobs` WHERE id=" . $_POST['formIdentifier'];
			
			//send query
			$jobInfo = queryFunc($jobInfoQuery);
			
			//process query
			$jobdata = mysql_fetch_assoc($jobInfo);
				
			//make points query
			$addPointsQuery = "INSERT INTO `points`(`job_id`, `student_id`, `points`, `category_id`) VALUES (".$_POST['formIdentifier'].",".$_SESSION['loginid'].",".$jobdata['points'].",".$jobdata['skillcatid'].")";
			
			//add points with query
			queryFunc($addPointsQuery);
			$formMessage = "You have Successfully Resolved a Job";
			
 		}else if($_POST['claimStatButt'] == 4){
 			//ignore a job
 			$ignoreJobQuery = "INSERT INTO `ignorejobs`(`studentname`, `jobid`) VALUES (".$_SESSION['loginid'].",".$_POST['formIdentifier'].")";
 			queryFunc($ignoreJobQuery);
			$formMessage = "You have Successfully Ignored a Job";
		}
		
		$formCheck = "True";
		
	}//end of form check
	
	
  //add the job display buttons to the screen
  echo("
  <div class='jobDisplayButtons' name='jobDisplay'>
    <form method='post' name='jobdisplaybutts'>
		
    <button class='allButt' type='submit' name='jobsToList' value='1'>All Jobs</button>
		
    <button class='unclaimedButt' type='submit' name='jobsToList' value='2'>Unclaimed Jobs</button>
		
    <button class='myButt' type='submit' name='jobsToList' value='3'>My Jobs</button>
		
		<p id='status' style='float:right;font:45px;margin:25px 10px 0 0'>
			Status: ".$formMessage."
		</p>
		
		</form>
  </div>
  ");
  
  //check for what jobs should be displayed and how
  if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 1){
		//display all jobs
    $jobQuery="SELECT * FROM jobs;";
    echo"<style>.allButt{background:white;color:black;}</style>";
		
  }else if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 2){
		//display all unclaimed jobs
    $jobQuery="SELECT * FROM jobs WHERE claimedby=0";
    echo"<style>.unclaimedButt{background:white;color:black;}</style>";

  }else if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 3){
		//display only your jobs
    $jobQuery="SELECT * FROM jobs WHERE claimedby=".$_SESSION['loginid'];
    echo"<style>.myButt{background:white;color:black;}</style>";
		
  }else{
		//display all jobs if no button has been selected yet
    $jobQuery="SELECT * FROM jobs;";
    echo"<style>.allButt{background:white;color:black;}</style>";
		
  }
  //commence query
  $jobQueryResult = mysql_query($jobQuery);
  
  //make a table
  echo"<center><table style='width:100%;margin-bottom:10px;'><tr><td>Job Name</td><td>Job Description</td><td>Job Points</td><td>Job Category</td><td>Claim Status</td></tr>";
  
  //create an object for every job
  while ($jobdata = mysql_fetch_assoc($jobQueryResult)) {
	$job[$jobdata['id']] = new jobs($jobdata['id'],$jobdata['name'],$jobdata['description'],$jobdata['skillcatid'],$jobdata['status'],$jobdata['points'],$jobdata['repeatable'],$jobdata['limitone'],$jobdata['claimedby'],$jobdata['priority'],$jobdata['bypassLimit']);
  $job[$jobdata['id']]->printJob();//print the row for a job
}	
  //finish the table
  echo"</table></center>";
  
}//end of main function





//call main function
main();

//add the footer html
makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page</a> <a href='create_jobs.php'>Create Job</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"True");

//end connection
mysql_close($conn);

?>