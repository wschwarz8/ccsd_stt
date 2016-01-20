<?php
//todo
//fix header issue   <--fixed
//add working sort by logic
//add alert message for when claiming,unclaiming, and resolving a job

//get access to proper files
require_once 'config.php';
require_once "functions.php";
require_once "Classes/jobsClass.php";

//check for login
promptLogin();//can this be put into functions.php?

//start a connection
$conn = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

//select a correct database
mysql_select_db('stt', $conn);

//check for any forms submitted
formCheckFunc();

//set up the base of the page
makeHeader('Jobs List','Jobs List',2,"jobs2.php","<link href='css_files/jobs.css' rel='stylesheet'>");

//do setup here
function main(){
  
  //add the job display buttons to the screen
  echo("
  <div class='jobDisplayButtons' name='jobDisplay'>
    <form method='post' name='jobdisplaybutts'>
		
    <button class='allButt' type='submit' name='jobsToList' value='1'>All Jobs</button>
		
    <button class='unclaimedButt' type='submit' name='jobsToList' value='2'>Unclaimed Jobs</button>
		
    <button class='myButt' type='submit' name='jobsToList' value='3'>My Jobs</button>
		
		<p style='float:right;'>not finished yet->    Sort By:
		
		<select name'sortBy'>
			<option value='1'>Name</option>
			<option value='2'>Points</option>
			<option value='3'>Category</option>
			<option value='4'>Claimed</option>
		</select>
		
		<button type='button' name='ascendingButt' class='ascButt'>Ascending</button>
		
		<button type='button' name='descendingButt' class='desButt'>Desending</button>
		
		<button type='Submit' name='descendingButt' class='setButt'>Set</button>
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
  echo"<center><table style='width:100%;'><tr><td>Job Name</td><td>Job Description</td><td>Job Points</td><td>Job Category</td><td>Claim Status</td></tr>";
  
  //create an object for every job
  while ($jobdata = mysql_fetch_assoc($jobQueryResult)) {
	$job[$jobdata['id']] = new jobs($jobdata['id'],$jobdata['name'],$jobdata['description'],$jobdata['skillcatid'],$jobdata['status'],$jobdata['points'],$jobdata['repeatable'],$jobdata['limitone'],$jobdata['claimedby'],$jobdata['priority'],$jobdata['bypassLimit']);
  $job[$jobdata['id']]->printJob();//print the row for a job
}	
  //finish the table
  echo"</table></center>";
  
}//end of main function

//check if a claim button was pressed
function formCheckFunc(){
	//check if any of the forms were submitted
	if (isset($_POST['formIdentifier'])){
		//logic for job claim,unclaim, and resolve logic
		if ($_POST['claimStatButt'] == 1){
			//make a query to claim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=".$_SESSION['loginid']." WHERE id=" . $_POST['formIdentifier'];
			queryFunc($claimStatQuery);

		}else if($_POST['claimStatButt'] == 2){
			//make a query to unclaim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=0 WHERE id=" . $_POST['formIdentifier'];
			queryFunc($claimStatQuery);

		}else if($_POST['claimStatButt'] == 3){
			//make a query to resolve a job
			$resolveQuery = "UPDATE `jobs` SET `status`=3 WHERE id=" . $_POST['formIdentifier'];
			queryFunc($resolveQuery);
			$jobInfoQuery = "SELECT * FROM `jobs` WHERE id=" . $_POST['formIdentifier'];
			while ($jobdata = mysql_fetch_assoc($jobInfoQuery)) {
				$job[$jobdata['id']] = new jobs($jobdata['id'],$jobdata['name'],$jobdata['description'],$jobdata['skillcatid'],$jobdata['status'],$jobdata['points'],$jobdata['repeatable'],$jobdata['limitone'],$jobdata['claimedby'],$jobdata['priority'],$jobdata['bypassLimit']);
			}	
			$addPointsQuery = "INSERT INTO `points`(`job_id`, `student_id`, `points`, `category_id`) VALUES (".$jobdata['id'].",".$_SESSION['loginid'].",".$jobdata['points'].",".$jobdata['skillcatid'].")";
			queryFunc($addPointsQuery);
		}

		//update screen
		header('location:rewriteJobs.php');
	}
}

//call main function
main();


//add the footer html
makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page</a> <a href='create_jobs.php'>Create Job</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"True");

//end connection
mysql_close($conn);

?>