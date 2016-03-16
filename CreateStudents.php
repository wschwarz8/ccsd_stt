<?php
  require_once "functions.php";
	require_once "config.php";
promptLogin(1);
	makeHeader("Create Students","Create a Student",2,"CreateStudents.php",'<link href="/css_files/create_jobs.css" rel="stylesheet">');
    $g_link = mysql_connect('localhost', $g_username, $g_password); 
		mysql_select_db('stt', $g_link);//TODO use a persistant database connections
		$query = "SELECT id FROM `students`";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		mysql_select_db('stt', $g_link);
?>

<center>
	<div class="centeringDiv">
	<h2>
		Create a Student
	</h2>
  <form method="post" name="postIt">
    <table>
 
			
			<!-- student name input field -->
			<tr><td>Student Name</td><td><input type="text" name="Name" placeholder="Student Name"></td></tr>
			
			<!-- student username input field -->
			<tr><td>Student Username</td><td><input type="text" name="Username" placeholder="Student Username"></td></tr>
			
			<tr><td>Student Password</td><td><input typw="text" name="Password" placeholder="Student Password"</td></tr>
			
			<!-- Graduation Year input field -->
			<tr><td>Graduation Year</td><td><input type="number" name="GraduationYear" placeholder="Graduation Year"</td>
      
      <tr><td colspan="2" style="text-align:center;"><input type="submit"></td></tr>
    </table>
  </form>
		<?php
	 if ($_POST){
		 $id=$row['id']+"1";
		 
		 $username=$_POST['Username'];
		 
		 $password=$_POST['Password'];
		 
		 $name=mysql_real_escape_string($_POST['Name']);
		 
		 $GradYear=$_POST['GraduationYear'];
		 
		 $active="1";
		 
		 $admin="0";
		 
		 $bio=" ";
		 
		 //make query
		 $CreateStudent = "INSERT INTO `students`(`username`, `password`, `name`, `class`, `active`, `bio`, `admin`) VALUES (
			'".$username."',
			'".$password."',
			'".$name.    "', 
			'".$GradYear."', 
			'".$active.  "', 
			'".$bio.     "', 
			'".$admin.   "')";

		 //commence query
		 $rsp = mysql_query($CreateStudent);
		 
		 if($rsp) echo"Student Created :)";
		 else {
			echo "ERROR";
    			die('Invalid query: ' . mysql_error());
		}
			
		 
		 mysql_close($conn);
		 
		 //clear old variables
		 $_POST['Username'] = "";
		 $_POST['Password'] = "";
		 $_POST['Name'] = "";
		 $_POST['GraduationYear'] = "";
	 }
	else if($_POST) {
		echo "ERROR: Student not created";
	}
		?>
	</div>
</center>

<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
?>