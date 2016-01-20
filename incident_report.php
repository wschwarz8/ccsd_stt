<?php
	require_once "config.php";
	require_once "functions.php";
	promptLogin();

	makeHeader("Incident Report", "Make an Incident Report", 2,"incident_report.php", '<link href="/css_files/create_jobs.css" rel="stylesheet">')
?>

<center>
	<div class="centeringDiv">
	<h2>
		Incident Report
	</h2>
  <form method="post" name="postIt">
    <table>
			<!-- Date Recieved input field -->
      <tr><td>Date Recieved</td><td><input type="date" name="jDate" placeholder="Date"></td></tr>
			
      <!-- Owner input field -->
      <tr><td>Owner of Laptop</td><td><input type="text" name="jOwner" placeholder="Owner"></td></tr>
			
			<!-- Status input field -->
			  <tr><td>Status of Laptop</td>
        <td>
          <select name="jStatus">
            <!-- replace options with a query later -->
            <option value="1">Not Usable</option>
            <option value="2">Usable but needs repairs</option>
            <option value="3">No repair needed</option>
						<option value="4">Other:<br><input type="text" placeholder="Other"></option><!--make this line work right later-->
          </select>
					<br><br>Whats Wrong if it needs repaired?:
					<select name="whatsWrong">
						<option value="1">Broken Screen</option>
						<option value="2">Does not turn on </option>
						<option value="3">Does not connect to wifi</option>
						<option value="4">Keyboard does not work</option>
						<option value="5">Mouse does not work</option>
						<option value="6">Unknown</option>
						<option>Other:<br><input type="text" placeholder="Other"></option><!--make this line work right later-->
					</select>
        </td>
      </tr>
		
			  <!-- Laptop taken input field -->		 
			<tr><td>Laptop taken from student?</td>
        <td>
          <select name="jLaptopTaken">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </td>
      </tr>
			
			<!-- Laptop serial input field -->
 			<tr><td>Serial Number of Laptop</td><td><textarea name="jLaptopNumber" placeholder="Laptop Serial Number"></textarea></td></tr>
			
			<!-- Charger taken input field -->		 
			<tr><td>Charger taken from student?</td>
        <td>
          <select name="jChargerTaken">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </td>
      </tr>
			
		  <!-- Charger serial input field -->
 			<tr><td>Serial Number of Charger</td><td><textarea name="jChargerNumber" placeholder="Charger Serial Number"></textarea></td></tr>
		

	
 
		
		  <!-- New Laptop input field -->
		  <tr><td>Did you give a new laptop to the student?</td>
        <td>
          <select name="jNewLaptop">
            <!-- replace options with a query later -->
            <option value="1">No loaner given to student</option>
            <option value="2">Loaner/Replacement given to student</option>
          </select>
        </td>
      </tr>
		
			<!-- Serial Number input field -->
			<tr><td>Serial Number of new laptop</td><td><textarea name="jNewNumber" placeholder="New Serial Number"></textarea></td></tr>
		
		<!-- Serial Number input field -->
			<tr><td>Serial Number of new laptop Charger</td><td><textarea name="jNewNumberCharger" placeholder="New Charger Serial Number"></textarea></td></tr>
		
			<!-- Explanation input field -->
			<tr><td>Explanation of incident</td><td><textarea name="jExplanation" placeholder="Explanation of incident"></textarea></td></tr>
			
		<!-- Recieved by input field -->
     	 <tr><td>Recieved by</td><td><input type="text" name="jRecievedBy" placeholder="Recieved by"></textarea></td></tr>

  		
      <tr><td colspan="2" style="text-align:center;"><input type="submit"></td></tr>
    
		</table>
  </form>

<?php
		
	//start connection
	$conn = mysql_connect("localhost", $g_username, $g_password);

	//access correct database
	mysql_select_db('stt', $conn);

	if ($_POST){

		//make query to add an incident
		$queryinsertincident = "INSERT INTO `incidents`
			(`date`, `owner`, `status`, `laptopserial`, `chargerserial`, `laptoptaken`, `chargertaken`, `newlaptop`, `newlaptopserial`, `newchargerserial`, `explanation`, `receviedby`) VALUES 
			('". $_POST['jDate'] ."','". $_POST['jOwner'] ."','". $_POST['jStatus'] ."','". $_POST['jLaptopNumber'] ."','". $_POST['jChargerNumber'] ."', ". $_POST['jLaptopTaken'] .", ". $_POST['jChargerTaken'] .", ". $_POST['jNewLaptop'] .",'". $_POST['jNewNumber'] . "', '". $_POST['jNewNumberCharger'] ."','". $_POST['jExplanation'] ."','". $_POST['jRecievedBy'] ."')";
	
		//commence query to add an incident
		 $result = mysql_query($queryinsertincident);
		
		//announce if the incident was recorded
		if(!$result){
			echo"Incident failed to report";
			die('Invalid query: ' . mysql_error());
			$fail = "True";
		}else{
			echo "New Incident Reported!<br>";
			$fail = "False";
		}
		
		//
		//add a job for incident
		//
		
		//make a job now if needed and add it to devices table
		if ($_POST['jLaptopTaken'] = 1){
			
			//check what is wrong with laptop
			switch($_POST["whatsWrong"]){
				case 1:
						$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is reported to have a broken screen.";
						$jobPoints = 1;//change these to appropriate points later
						$jobPriority = 5;//change later maybe
						$jobSkill = 5;
				break;
				case 2:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is reported to not turn on.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 5;
					break;
				case 3:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is reported to have a not connect to the wifi.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 2;//change later maybe
					$jobSkill = 2;
					break;
				case 4:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is reported to have a broken keyboard.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 3;//change later maybe
					$jobSkill = 5;
					break;
				case 5:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is reported to have a broken mousepad.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 3;//change later maybe
					$jobSkill = 5;
					break;
				default:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s laptop that is not known what is wrong with it.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 1;
			}
			
			//all jobs are named laptop repair???? if not add this variable with a specific name to each case above
			$jobName = "Laptop Repair";
			
			//make a query to add a job
			$makeJobQuery = "INSERT INTO `jobs`(`name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`) VALUES ('".$jobName."','".$jobMessage."',".$jobSkill.",1,".$jobPoints.",0,0,0,".$jobPriority.")";
			
			//commence query if it fails it returns false
			$result = mysql_query($makeJobQuery);
			
			//announce whether a job was created and query was successful
			if (!$result){
				echo "Job Creation Failed<BR><BR>";
				die('Invalid query: ' . mysql_error());
			}else{
				echo "New Job Created!<BR>";
			}
			
			//
			//add this device to the devices table below
			//
			
			//make query to add to devices table
			$makeDevicesQuery = "INSERT INTO `devices`(`owner`, `assignedto_id`, `received`, `problem`, `resolution`, `notes`, `repaired`, `returned`, `last_update`, `receivedby_id`, `serial`, `point_value`, `status_id`) VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])";
			
			//commence query and returns false if query failed
			$result = mysql_query($makeDevicesQuery);
			
			//announce whether a job was created and query was successful
			if (!$result){
				echo "Device Failed to be added to devices table<BR><BR>";
				die('Invalid query: ' . mysql_error());
			}else{
				echo "Device added to devices table!<br>";
			}
			
		}	
		
	}

?>
	</div>
</center>

<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
	mysql_close($conn);
// the three things this needs to do:
// first: put all data into incident table
// second: if laptop was taken, put data into devices table
// third: if laptop was taken for repair, make a job to diagnose the laptop
?>

