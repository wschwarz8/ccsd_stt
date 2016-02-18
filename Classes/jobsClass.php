<?php
//jobs class
//do not add things to this file unless it pertains to the jobs class

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
  public $job_skillCategory;
  
  //contruct each property when a object is made
  function __construct($jid,$jna,$jde,$jca,$jst,$jpo,$jsc,$jre,$jli,$jcl,$jpr,$jby){
    $this->job_Id = $jid;
    $this->job_Name = $jna;
    $this->job_Description = $jde;
    $this->job_Category = $jca;
    $this->job_Status = $jst;
    $this->job_Points = $jpo;
    $this->job_skillCategory = $jsc;
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
		//check if job is ignored
		$ignore[$this->job_Id] = 0;
		$ignoreCheckQuery = "SELECT * FROM `ignorejobs` WHERE jobid=" . $this->job_Id ." AND studentname=" .$_SESSION['loginid'] ;
		$ignoreJobs = queryFunc($ignoreCheckQuery);
		
		while ($ignoredata = mysql_fetch_assoc($ignoreJobs)) {
				$ignore[$this->job_Id] = $ignoredata['studentname'];
		}	
		
		if ($this->job_Status < 3 && $ignore[$this->job_Id] != $_SESSION['loginid'] || $this->job_Status < 3 && isset($_SESSION['showIgnoredJobs']) && $_SESSION['showIgnoredJobs'] == "True"){
			echo("
				<tr style='".$this->jobPriorityFunc()."height:45px;'>
					<td style='width:10%;'>". $this->job_Name ."</td>
					<td style='width:50%;'>". $this->job_Description ."</td>
					<td style='width:10%;'>". $this->job_Points ."</td>
					<td style='width:10%;'>". $this->jobCategoryAndNameFunc(1) ."</td>
					<td style='width:10%;'>". $this->job_skilLCategory ."</td>
					<td style='width:10%;'><form method='post' name='claimStatForm'>". $this->jobClaimButtsFunc() ."</form></td>
				</tr>
			");
			}else{
			echo"<script> ignoreCount++;</script>";
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
			
			//make a query to check what jobs have been ignored by current student
			
			$ignore[$this->job_Id] = 0;
			$ignoreCheckQuery = "SELECT * FROM `ignorejobs` WHERE jobid=" . $this->job_Id ." AND studentname=" .$_SESSION['loginid'] ;
			$ignoreJobs = queryFunc($ignoreCheckQuery);
		
			while ($ignoredata = mysql_fetch_assoc($ignoreJobs)) {
					$ignore[$this->job_Id] = $ignoredata['studentname'];
			}	
			
			
			if (isset($_SESSION['showIgnoredJobs']) && $_SESSION['showIgnoredJobs'] == "True" && $ignore[$this->job_Id] == $_SESSION['loginid'] && $_SESSION['jobsection'] == "1"){
				//want to see ignored jobs
				return("
				<button type='submit' name='claimStatButt' value='5'>Unignore</button>
				<input type='hidden' name='formIdentifier' value='".$this->job_Id."'>
				");
				
			}else{
			//did not request to see ignored jobs
				return("
				<button type='submit' name='claimStatButt' value='1'>claim</button>
				<button type='submit' name='claimStatButt' value='4'>Ignore</button>
				<input type='hidden' name='formIdentifier' value='".$this->job_Id."'>
				");
			}
			
			
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
		while ($data = mysql_fetch_assoc(queryFunc($jobcategoryAndNameQuery))) {
			 return $data[$placeholder];
		}
	}
	
}//end of jobs class

?>
