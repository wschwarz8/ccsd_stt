<?php
//get access to proper files
require_once 'config.php';
require_once "functions.php";

//check for login
promptLogin();//can this be put into functions.php?

//start a connection
$conn = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

//select a correct database
mysql_select_db('stt', $conn);

//set up the base of the page
makeHeader('Jobs List','Jobs List',2,"jobs2.php","<link href='css_files/jobs.css' rel='stylesheet'>");

//jobs class
class jobs{
  
  //init any properties below for jobs info
  public $job_Id;
  public $job_Name;
  public $job_Description;
  public $job_Category;
  public $job_Status;
  public $job_Points;
  public $job_Repeatable;
  public $job_limitOne;
  public $job_ClaimedBy;
  public $job_Priority;
  public $job_BypassLimit;
  
  //contruct each property when a object is made
  function __construct($jid,$jna,$jde,$jca,$jst,$jpo,$jre,$jli,$jcl,$jpr,$jby){
    $this->job_Id = $jid;
    $this->job_Name = $jna;
    $this->job_Description = $jde;
    $this->job_Category = $jca;
    $this->job_Status = $jst;
    $this->job_Points = $jpo;
    $this->job_Repeatable = $jre;
    $this->job_limitOne = $jli;
    $this->job_ClaimedBy = $jcl;
    $this->job_Priority = $jpr;
    $this->job_BypassLimit = $jby;
  }
  
  //do something if the object is called as a string
  function __toString(){
    return "this is not string dude its an object!";
  }
  
  //do something if a job was destroyed
  function __destruct(){//this is acting funny\/\/\/ update-> i think it is because of a </div> missing somehow or a rogue quotation mark possibly in functions.php in makeheader() but thats just an idea
    //echo "The job object ". $this->job_Name ." was destroyed!!";
  }
  
  function printJob(){
		
		//process some data
		$jobPriority = $this->jobPriorityFunc();
		
		if ($this->job_Status == 1){
			echo("
				<tr style='".$jobPriority."height:45px;'>
					<td style='width:10%;'>". $this->job_Name ."</td>
					<td style='width:50%;'>". $this->job_Description ."</td>
					<td style='width:10%;'>". $this->job_Points ."</td>
					<td style='width:10%;'>". $this->jobCategoryAndNameFunc(1) ."</td>
					<td style='width:10%;'><form method='post' name='claimStatForm'>". $this->jobClaimButtsFunc() ."</form></td>
				</tr>
			");
			}
  }
  
	//determine job priority
	function jobPriorityFunc(){
		//determine the background color of the row for priority
		if ($this->job_Priority > 7){//important jobs are red
			return "background:red;";
		}else if($this->job_Priority > 3){//moderately important jobs are orange
			return "background:orange;";
		}else{//not very important
			return "";
		}
	}
	
  //logic for when to have claim, unclaim, and resolve buttons go here
  function jobClaimButtsFunc(){
		if ($this->job_ClaimedBy == 0 ){
			return("
			<button type='submit' name='claimStatButt' value='1'>claim</button>
			<input type='hidden' name='formIdentifier' value='".$this->job_Id."'>
			");
		}else if ($this->job_ClaimedBy == $_SESSION['loginid']){
			return("
			<button type='submit' name='claimStatButt' value='2'>Unclaim</button>
			<button type='submit' name='claimStatButt' value='3'>Resolve</button>
			<input type='hidden' name='formIdentifier' value='".$this->job_Id."'>
			");
		}else{
			return $this->jobCategoryAndNameFunc(2);
		}
  }
	
	//logic for job claim,unclaim, and resolve logic
	function claimUnclaimResolveFunc(){
		if ($_POST['claimStatButt'] == 1){
			//make a query to claim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=".$_SESSION['loginid']." WHERE id=" . $this->job_Id;
			$this->job_ClaimedBy = $_SESSION['loginid'];
			$this->queryFunc($claimStatQuery);

		}else if($_POST['claimStatButt'] == 2){
			//make a query to unclaim a job
			$claimStatQuery = "UPDATE `jobs` SET `claimedby`=0 WHERE id=" . $this->job_Id;
			$this->job_ClaimedBy = 0;
			$this->queryFunc($claimStatQuery);

		}else if($_POST['claimStatButt'] == 3){
			//make a query to resolve a job
			$resolveQuery = "UPDATE `jobs` SET `status`=3 WHERE id=" . $this->job_Id;
			$this->queryFunc($resolveQuery);
			$addPointsQuery = "INSERT INTO `points`(`job_id`, `student_id`, `points`, `category_id`) VALUES (".$this->job_Id.",".$_SESSION['loginid'].",".$this->job_Points.",".$this->job_Category.")";
			$this->queryFunc($addPointsQuery);
		}

		//update screen?? might be a better way but this works
		header('location:rewriteJobs.php');
	}
	
	//query function
	function queryFunc($query){
		//commence query
		return $queryResult = mysql_query($query);

		//check if query was succsesful
		if (!$queryResult) {
   	 die('Invalid query: ' . mysql_error());
		}
	}
	
	//turn the category num into text
  function jobCategoryAndNameFunc($type){
		
		//determine what to query
		if ($type == 1){
		//make a query for category name
		$jobcategoryAndNameQuery = "SELECT `category` FROM `skillcategories` WHERE id=" . $this->job_Category;
		$placeholder = "category";
		}else{
			//make a query for persons name
		$jobcategoryAndNameQuery = "SELECT `name` FROM `students` WHERE id=" . $this->job_ClaimedBy;
		$placeholder = "name";
		}
		
		//do query and process it
		while ($data = mysql_fetch_assoc($this->queryFunc($jobcategoryAndNameQuery))) {
			 return $data[$placeholder];
		}
	}
	
}//end of jobs class



//do setup here and navigates most of the logic
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
  $result = mysql_query($jobQuery);
  
  //make a table
  echo"<center><table style='width:100%;'><tr><td>Job Name</td><td>Job Description</td><td>Job Points</td><td>Job Category</td><td>Claim Status</td></tr>";
  
  //create an object for every job
  while ($jobdata = mysql_fetch_assoc($result)) {
	$job[$jobdata['id']] = new jobs($jobdata['id'],$jobdata['name'],$jobdata['description'],$jobdata['skillcatid'],$jobdata['status'],$jobdata['points'],$jobdata['repeatable'],$jobdata['limitone'],$jobdata['claimedby'],$jobdata['priority'],$jobdata['bypassLimit']);
  $job[$jobdata['id']]->printJob();//print the row for a job
}	
  //finish the table
  echo"</table></center>";
	
	//claim logic
	if (isset($_POST['formIdentifier'])){
		$job[$_POST['formIdentifier']]->claimUnclaimResolveFunc();
	}
  
}//end of main function


//call main function
main();


//add the footer html
makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page</a> <a href='create_jobs.php'>Create Job</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"True");

//end connection
mysql_close($conn);

?>