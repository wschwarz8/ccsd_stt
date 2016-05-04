<?php
	require_once "config.php";
	require_once "functions.php";
	if(!isset($_GET['kiosk'])){
		promptLogin();
	}

	makeHeader("Incident Report", "Make an Incident Report", 2,"incident_report.php", '<link href="/css_files/create_jobs.css" rel="stylesheet">');
?>

<center>
	<div class="centeringDiv">
	<h2>
		Incident Report
	</h2>
  <form method="post" name="postIt">
    <table>
<?php
if(isset($_GET['kiosk'])){
	echo "<tr><td>Who should get the points?</td><td><select name='personid'>";
	echo "<option value='14'>-----</option>";
	$query = "SELECT name, id FROM students WHERE active=1";
	$resul = mysql_query($query);
	while ($ro = mysql_fetch_assoc($resul)) {
		echo "<option value='".$ro['id']."'>".$ro['name']."</option>";
	}	
}
echo "</option>";
?>
			<!-- Date Recieved input field -->
      <tr><td>Date Recieved</td><td><input type="date" name="jDate" placeholder="Date"
value="<?php
echo date("Y-m-d");
?>
"></td></tr>
			
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
          </select>
					<br><br>Whats Wrong if it needs repaired?:
					<select name="whatsWrong" onChange="if(this.selectedIndex==6)document.getElementById('other').type='text'">
						<option value="1">Broken Screen</option>
						<option value="2">Does not turn on </option>
						<option value="3">Does not connect to wifi</option>
						<option value="4">Keyboard does not work</option>
						<option value="5">Mouse does not work</option>
						<option value="6">Unknown</option>
						<option value="7">Other:<br><input id='other' type="hidden" name="otherReason" placeholder="Other Reason"></option>
					</select>
        </td>
      </tr>
		
			<!-- Laptop serial input field -->
 			<tr><td>Serial Number of Laptop</td><td><textarea name="jLaptopNumber" placeholder="Laptop Serial Number" onChange="this.form.jLaptopTaken.selectedIndex=0"></textarea></td></tr>
			
			  <!-- Laptop taken input field -->		 
			<tr><td>Laptop taken from student?</td>
        <td>
          <select name="jLaptopTaken">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2" selected>No</option>
          </select>
        </td>
      </tr>

			
		  <!-- Charger serial input field -->
 			<tr><td>Serial Number of Charger</td><td><textarea name="jChargerNumber" placeholder="Charger Serial Number" onChange="this.form.jChargerTaken.selectedIndex=0"></textarea></td></tr>
		

	
			<!-- Charger taken input field -->		 
			<tr><td>Charger taken from student?</td>
        <td>
          <select name="jChargerTaken">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2" selected>No</option>
          </select>
        </td>
      </tr>
 
		
		  <!-- New Laptop input field -->
		  <tr><td>Did you give a new laptop or charger to the student?</td>
        <td>
          <select name="jNewLaptop" onChange="document.getElementById('lserialrow').style='display: table-row';document.getElementById('cserialrow').style='display: table-row'">
            <!-- replace options with a query later -->
            <option value="1">No loaner given to student</option>
            <option value="2">Loaner/Replacement given to student</option>
          </select>
        </td>
      </tr>
		
			<!-- Serial Number input field -->
			<tr id=lserialrow style="display:none"><td>Serial Number of new laptop</td><td><textarea name="jNewNumber" placeholder="New Serial Number"></textarea></td></tr>
		
		<!-- Serial Number input field -->
			<tr id=cserialrow style="display:none"><td>Serial Number of new laptop Charger</td><td><textarea name="jNewNumberCharger" placeholder="New Charger Serial Number"></textarea></td></tr>
		
			<!-- Explanation input field -->
			<tr><td>Explanation of incident</td><td><textarea name="jExplanation" placeholder="Explanation of incident"></textarea></td></tr>
<?php
if(isset($_SESSION['admin'])) {
	echo "<tr><td>Point override</td><td><input type='text' name='NewPoints' placeholder='Admin Point Override'></td></tr>";
} 
?>

      <tr><td colspan="2" style="text-align:center;"><input type="submit"></td></tr>
    
		</table>
  </form>

<?php
	//start connection
	$conn = mysql_connect("localhost", $g_username, $g_password);

	//access correct database
	mysql_select_db('stt', $conn);

	if ($_POST){
		$explanation = str_replace("'","",$_POST['jExplanation']);
		$otherReason = str_replace("'","",$_POST['otherReason']);

		//make query to add an incident
		$queryinsertincident = "INSERT INTO `incidents`
			(`date`, `owner`, `status`, `laptopserial`, `chargerserial`, `laptoptaken`, `chargertaken`, `newlaptop`, `newlaptopserial`, `newchargerserial`, `explanation`, `receviedby`) VALUES 
			('". $_POST['jDate'] ."','". $_POST['jOwner'] ."','". $_POST['jStatus'] ."','". $_POST['jLaptopNumber'] ."','". $_POST['jChargerNumber'] ."', ". $_POST['jLaptopTaken'] .", ". $_POST['jChargerTaken'] .", ". $_POST['jNewLaptop'] .",'". $_POST['jNewNumber'] . "', '". $_POST['jNewNumberCharger'] ."','". $explanation ."',' ".$personid."')";
	
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
		if ($_POST['jStatus'] != 3 && $_POST['jLaptopTaken'] == 1 && $_POST['jLaptopNumber'] != ''){
			$personid = $_SESSION['loginid'];
			if(isset($_GET['kiosk'])){
				$personid = $_POST['personid'];
			}
			$type = CheckModel($_POST['jLaptopNumber']);
			//check what is wrong with laptop
			$requirement_id=0; // if it isn't set in the case it should be 0
			switch($_POST["whatsWrong"]){
				case 1:
						$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is reported to have a broken screen.";
						$jobPoints = 1;//change these to appropriate points later
						$jobPriority = 5;//change later maybe
						$jobSkill = 5;
					switch($type){
						case 'Lenovo':
							$requirement_id=7;
							break;
						case 'Dell':
							$requirement_id=2;
							break;
						case 'Samsung':
							$requirement_id=4;
							break;
					}
					break;
				case 2:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is reported to not turn on.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 5;
					$requirement_id=1;
					break;
				case 3:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is reported to have a not connect to the wifi.";
					$jobPoints = 2;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 2;
					break;
				case 4:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is reported to have a broken keyboard.";
					$jobPoints = 3;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 5;
					break;
				case 5:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is reported to have a broken mousepad.";
					$jobPoints = 3;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 5;
					break;
				case 7:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that has the problem:".$otherReason;
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 1;
					break;
				default:
					$jobMessage = "Fix " . $_POST['jOwner'] . "s $type laptop that is not known what is wrong with it.";
					$jobPoints = 5;//change these to appropriate points later
					$jobPriority = 5;//change later maybe
					$jobSkill = 1;
			}
			
			//all jobs are named laptop repair???? if not add this variable with a specific name to each case above
			$jobName = "Laptop Repair for ".$_POST['jOwner'];

			if(isset($_POST['NewPoints']))
				$PointOverride=$_POST['NewPoints'];
			else
				$PointOverride=$jobPoints;
			
			

			// Give the student a point
			queryFunc("INSERT INTO points (student_id, points, category_id) VALUES ('".$personid."', 1, 1)");
			
			
			//
			//add this device to the devices table below
			//
			
			//make query to add to devices table

			$makeDevicesQuery = "INSERT INTO `devices`(`owner`, `assignedto_id`, `received`, `problem`, `resolution`, `notes`, `repaired`, `returned`, `last_update`, `receivedby_id`, `serial`, `status_id`) VALUES ('".$_POST['jOwner']."','','".date('Y-m-d H:i:s')."','".$jobMessage."','','".$notes."','','','','".$personid."','".$_POST['jLaptopNumber']."', '1')";

			//commence query and returns false if query failed
			$result = mysql_query($makeDevicesQuery);
			
			//announce whether a job was created and query was successful
			if (!$result){
				echo "Device Failed to be added to devices table<BR><BR>";
				die('Invalid query: ' . mysql_error());
				$deviceID = 0;
			}else{
				echo "Device added to devices table!<br>";
				$deviceID = mysql_insert_id();
			}
			

			
			
			
			//make a query to add a job
			$makeJobQuery = "INSERT INTO `jobs`(`name`, `description`, `skillcatid`, `status`, `points`, `repeatable`, `limitone`, `claimedby`, `priority`, `requirement_id`, `device_id`)
						VALUES ('".$jobName."','".$jobMessage."',".$jobSkill.",1,'".$PointOverride."',0,0,0,".$jobPriority.",".$requirement_id.",'".$deviceID."')";
			//commence query if it fails it returns false
			$result = mysql_query($makeJobQuery);
			
			//announce whether a job was created and query was successful
			if (!$result){
				echo "Job Creation Failed<BR><BR>";
				die('Invalid query: ' . mysql_error());
			}
			else{
				echo "New Job Created!<BR>";
			}
			
		}// end if laptop taken
		
	} // end if post

?>
	</div>
</center>

<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
	mysql_close($conn);
?>
