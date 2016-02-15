<?php
//add the all page to show even ignored jobs and add check boxes for ignoring multiple jobs at once

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
	echo"<script> ignoreCount = 0;</script>";
	echo "<script>jobCount = 0;</script>";
	 $formMessage = "";
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
			
			$claimQuery = "SELECT COUNT(*) as count FROM jobs WHERE STATUS<3 && bypassLimit=0 && claimedby='".$_SESSION['loginid']."'";
			$claimResult = queryFunc($claimQuery);
			$numClaimed = mysql_fetch_assoc($claimResult);
			if($numClaimed['count'] < 3) { // If they haven't claimed too many jobs already
				if($jobdata['requirement_id']=='0') { // If they have the skill needed to do the job
					if ($jobdata['repeatable'] != 1){
					//make a query to claim a job
					$claimStatQuery = "UPDATE `jobs` SET `claimedby`=".$_SESSION['loginid']." status=2 WHERE id=" . $_POST['formIdentifier'];
					queryFunc($claimStatQuery);
					//give a status message
					$formMessage = "You have Successfully Claimed a Job";
						
					}else{
					//make the duplicate job if its repeatable
					$addDupJobQuery = "INSERT INTO `jobs`(`name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`, `bypassLimit`) VALUES ('".$jobdata['name']."','".$jobdata['description']."',".$jobdata['skillcatid'].",2 ,".$jobdata['points'].",1 ,".$jobdata['limitone'].",".$_SESSION['loginid'].",".$jobdata['priority'].",".$jobdata['bypassLimit'].")";
					queryFunc($addDupJobQuery);	
					
					//ignore the original job so they cant claim it multiple times
					$ignoreJobQuery = "INSERT INTO `ignorejobs`(`studentname`, `jobid`) VALUES (".$_SESSION['loginid'].",".$_POST['formIdentifier'].")";
	 				queryFunc($ignoreJobQuery);
						
					//give a status message
					$formMessage = "You have Successfully Claimed a Repeatable Job";
					}
				
					//give a status message
					$formMessage = "You have Successfully Claimed a Job";
				} // End if skill needed
				else {
					$formMessage = "You do not have the required skill to claim that job.";
				}
			} // End if claimed too many jobs
			else{
				$formMessage = "<p style='color:red;'>You can't claim this job, you are already working on ".$numClaimed['count']." jobs!!!</p>";
			}
			
			
		}else if($_POST['claimStatButt'] == 2){
			//get info for processing
			$jobInfoQuery = "SELECT * FROM `jobs` WHERE id=" . $_POST['formIdentifier'];
			
			//send query
			$jobInfo = queryFunc($jobInfoQuery);
			
			//process query
			$jobdata = mysql_fetch_assoc($jobInfo);
			
			if ($jobdata['repeatable'] == 1){
				//make a query to unclaim a job
				$claimStatQuery = "DELETE FROM `jobs` WHERE id=" . $_POST['formIdentifier'];
				queryFunc($claimStatQuery);
				$formMessage = "You have Successfully Unclaimed a Job";
			}else{
				//make a query to unclaim a job
				$claimStatQuery = "UPDATE `jobs` SET `claimedby`=0, status=2 WHERE id=" . $_POST['formIdentifier'];
				queryFunc($claimStatQuery);
				$formMessage = "You have Successfully Unclaimed a Job";
			}

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
		$_POST['jobsToList'] = $_SESSION['jobsection'];
		
	}//end of form check for claiming,unclaiming, resolving, and ignoring
	
	//determine how it should be sorted
	if (isset($_POST['sortButt'])){
		switch($_POST['sortButt']){
			case 1://if name is sorted
				if ($_SESSION['jobsortdirection'] == 1){//asc
					$_SESSION['sortby'] = " ORDER BY name ASC;";
					$_SESSION['jobsortdirection'] = 2;
				}else{//desc
					$_SESSION['sortby'] = " ORDER BY name DESC;";
					$_SESSION['jobsortdirection'] =1;
				}
				break;//sort by description
			case 2:
				if ($_SESSION['jobsortdirection'] == 1){//asc
					$_SESSION['sortby'] = " ORDER BY description ASC;";
					$_SESSION['jobsortdirection'] = 2;
				}else{//desc
					$_SESSION['sortby'] = " ORDER BY description DESC;";
					$_SESSION['jobsortdirection'] =1;
				}
				break;
			case 3://sort by name
				if ($_SESSION['jobsortdirection'] == 1){//asc
					$_SESSION['sortby'] = " ORDER BY points ASC;";
					$_SESSION['jobsortdirection'] = 2;
				}else{//desc
					$_SESSION['sortby'] = " ORDER BY points DESC;";
					$_SESSION['jobsortdirection'] = 1;
				}
				break;
			case 4:// sort by category
				if ($_SESSION['jobsortdirection'] == 1){//asc
					$_SESSION['sortby'] = " ORDER BY skillcatid ASC;";
					$_SESSION['jobsortdirection'] = 2;
				}else{//desc
					$_SESSION['sortby'] = " ORDER BY skillcatid DESC;";
					$_SESSION['jobsortdirection'] = 1;
				}
				break;
			case 5://sort by who has claimed it
				if ($_SESSION['jobsortdirection'] == 1){//asc
					$_SESSION['sortby'] = " ORDER BY claimedby ASC;";
					$_SESSION['jobsortdirection'] = 2;
				}else{//desc
					$_SESSION['sortby'] = " ORDER BY claimedby DESC;";
					$_SESSION['jobsortdirection'] = 1;
				}
				break;
			default://this shouldnt ever happen
				$_SESSION['sortby'] = "";
		}
		$_POST['jobsToList'] = $_SESSION['jobsection'];
	}else{
		$_SESSION['sortby'] = "";
		$_SESSION['jobsortdirection'] = 0;
	}
	
	
	  //check for what jobs should be displayed and how
  if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 1){
		//display all jobs
    $jobQuery="SELECT * FROM jobs ".$_SESSION['sortby'];
    echo"<style>.allButt{background:white;color:black;}</style>";
		$_SESSION['jobsection'] = "1";
		
  }else if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 2){
		//display all unclaimed jobs
    $jobQuery="SELECT * FROM jobs WHERE status=1" .$_SESSION['sortby'];
    echo"<style>.unclaimedButt{background:white;color:black;}</style>";
		$_SESSION['jobsection'] = "2";

  }else if (isset($_POST['jobsToList']) && $_POST['jobsToList'] == 3){
		//display only your jobs
    $jobQuery="SELECT * FROM jobs WHERE claimedby=".$_SESSION['loginid'] .$_SESSION['sortby'];
    echo"<style>.myButt{background:white;color:black;}</style>";
		$_SESSION['jobsection'] = "3";
		
  }else{
		//display all jobs if no button has been selected yet
    $jobQuery="SELECT * FROM jobs WHERE claimedby=".$_SESSION['loginid'];
    echo"<style>.myButt{background:white;color:black;}</style>";
		$_SESSION['jobsection'] = "3";
		
  }
	
	
  //add the job display buttons to the screen
  echo("
  <div class='jobDisplayButtons' name='jobDisplay'>
    <form method='post' name='jobdisplaybutts'>
		
    <button class='myButt' type='submit' name='jobsToList' value='3'>My Jobs</button>
		
    <button class='unclaimedButt' type='submit' name='jobsToList' value='2'>Unclaimed Jobs</button>
		
    <button class='allButt' type='submit' name='jobsToList' value='1'>All Jobs</button>
		
		<p id='status' style='float:right;font:45px;margin:25px 10px 0 0'>
			Status: ".$formMessage."
		</p>
		
		</form>
  </div>
  ");
	//load you dang css
  //commence query
  $jobQueryResult = mysql_query($jobQuery); 
  
  //make a table
  echo("
	<center>
		<table style='width:100%;margin-bottom:10px;'>
		<tr>
			<form method='post' name='sortButtons'>
				<td><button class='sortRowButts' type='submit' name='sortButt' value='1'>Job Name</button></td>
				<td><button class='sortRowButts' type='submit' name='sortButt' value='2'>Job Description</button></td>
				<td><button class='sortRowButts' type='submit' name='sortButt' value='3'>Job Points</button></td>
				<td><button class='sortRowButts' type='submit' name='sortButt' value='4'>Job Category</button></td>
				<td><button class='sortRowButts' type='submit' name='sortButt' value='5'>Claim Status</button></td>
			</form>
		</tr>");

  //create an object for every job
  while ($jobdata = mysql_fetch_assoc($jobQueryResult)) {
		$job[$jobdata['id']] = new jobs($jobdata['id'],
																		$jobdata['name'],
																		$jobdata['description'],
																		$jobdata['skillcatid'],
																		$jobdata['status'],
																		$jobdata['points'],
																		$jobdata['repeatable'],
																		$jobdata['limitone'],
																		$jobdata['claimedby'],
																		$jobdata['priority'],
																		$jobdata['bypassLimit']);
		$job[$jobdata['id']]->printJob();//print the row for a job
		echo "<script>jobCount++;</script>";
	}	

	//print the job count to the screen
	if ($formCheck == "False"){
		echo("
		<script>
			document.getElementById('status').innerHTML = 'Status: '+(jobCount - ignoreCount)+' Jobs were retrieved!';
		</script>
		");
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
