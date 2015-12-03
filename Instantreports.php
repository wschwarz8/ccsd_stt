<?php
$studentarray=array();
foreach ($studentarray as $key=>$value){
	echo "<option value=".$key.">".$value."</option>";
}	
?>


<form method=post name=theform>
<table border=1>
	<tr>
		<td>Student Name</td>
		<td><input type="text" name="studentname" id="studentname"></td>
	</tr>
	<tr>
		<td>Date of Incident</td>
		<td><input type="text" name="" id=""></td>
	</tr>
	<tr>
		<td>Status Of Computer</td>
		<td><input type="text" name="statusofcomputer" id="statusofcomputer"></td>
	</tr>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<tr>
	<td>Job
	<td>
   <select name=firstjob>
	   <option value=''>---</option>
	</select>
	</td>
</tr>
	
	
<tr><td>Serial Number Of Computer and Charger</td><td><input type="text" name="serialnumberofcomputerandcharger" id="points"></td></tr>
<tr><td>Laptop Taken From Student?</td><td><input type="text" name="laptoptakenfromstudent?" id="laptoptakenfromstudent?" value=""></td></tr>
	<tr><td>Charger Taken From Student?</td><td><input type="text" name="chargertakenfromstudent?" id="chargertakenfromstudent?" value=""></td></tr>
<tr><td colspan=2><input type="submit"></td></tr>
</table>
</form>
<form method=post name=theform>
<table border=1>
	<tr>
		<td>Explanation Of Incident</td>
		<td><input type="text" name="explanationofincident" id="explanationofincident"></td>
	</tr>
	<tr>
		<td>Is This Someone Else's Pay?</td>
		<td><input type="text" name="someoneelsespay" id="someoneelsespay"></td>
	</tr>
	<tr>
<td>New Computer?</td>
		<td><input type="text" name="newcomputer" id="newcomputer"></td>
	</tr>
	<tr>
		<td>Serial Number Of New Computer</td>
		<td><input type="text" name="serialnumberofnewcomputer" id="serialnumberofnewcomputer"></td>
	</tr>
	<tr>
		
	
	
	