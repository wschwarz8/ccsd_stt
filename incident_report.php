<?php
  require_once "functions.php";
	require_once "config.php";
	makeHeader("Incident Report", "Make an Incident Report", 2,"incedent_report.php", '<link href="/css_files/create_jobs.css" rel="stylesheet">')
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
            <option value="1">Usable</option>
            <option value="2">Usable but needs repairs</option>
            <option value="3">No repair needed</option>
						<option value="4">Other:<br><input type="text" placeholder="Other"></option>
          </select>
        </td>
      </tr>
			
      </tr>
      <!-- Problem input field -->
 			<tr><td>Serial Number of Laptop and/or Charger</td><td><textarea name="jNumber" placeholder="Serial Number"></textarea></td></tr>
		  <!-- Laptop taken input field -->		 
			<tr><td>Laptop taken from student?</td>
        <td>
          <select name="jTaken">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </td>
      </tr>
  		  <!-- Charger taken input field -->		 
			<tr><td>Charger taken from student?</td>
        <td>
          <select name="jTaken2">
            <!-- replace options with a query later -->
            <option value="1">Yes</option>
            <option value="2">No</option>
          </select>
        </td>
      </tr>
		  <!-- New Laptop input field -->
		  <tr><td>Did you give a new laptop to the student?</td>
        <td>
          <select name="jNewLaptop">
            <!-- replace options with a query later -->
            <option value="1">No loaner given to student</option>
            <option value="2">Loaner given to student</option>
						<option value="3">Replacement given to student</option>
          </select>
        </td>
      </tr>
			<!-- Serial Number input field -->
			<tr><td>Serial Number of new laptop and/or charger</td><td><textarea name="jNewNumber" placeholder="New Serial Number"></textarea></td></tr>
			<!-- Explanation input field -->
			<tr><td>Explanation of incident</td><td><textarea name="jExplanation" placeholder="Explanation of incident"></textarea></td></tr>
			<!-- Recieved by input field -->
      <tr><td>Recieved by</td><td><input type="text" name="jRecieved" placeholder="Recieved by"></textarea></td></tr>

  
      <tr><td colspan="2" style="text-align:center;"><input type="submit"></td></tr>
    </table>
  </form>
		<?php
		 
		 //make query
		 $queryinsert = "INSERT INTO `devices`( `owner`, 'recieved', 'recievedby', 'problem', 'notes', 'serial') VALUES ('".$_POST['jName']."','".$_POST['jDesc']."', ".$_POST['jSkill'].", ".$_POST['jStatus'].", ".$_POST['jPoints'].", ".$_POST['jClaim'].", ".$_POST['jPriority'].")";
		 
		 //commence query
//		 mysql_query($queryinsertjob);
		 
		 mysql_close($conn);
		 
		 //clear old variables
		 $_POST['jDate'] = "";
		 $_POST['jOwner'] = "";
		 $_POST['jStatus'] = "";
		 $_POST['jNumber'] = "";
		 $_POST['jTaken'] = "";
		 $_POST['jTaken2'] = "";
		 $_POST['jNewLaptop'] = "";
		 $_POST['jNewNumber'] = "";
		 $_POST['jExplanation'] = "";
		 $_POST['jRecieved'] = "";

		?>
	</div>
</center>

<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>