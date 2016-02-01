<?php
require_once '../functions.php';
require_once '../config.php';
require_once 'login.js';

promptLogin(1);



if(isset($_POST['Masquerade']))
{
	$_SESSION['loginid'] = $_POST['Masquerade'];
	$_SESSION['Masquerade'] = $_POST['Masquerade'];
	$_SESSION['Masquerade'] = 1;
	?>
	<html>
		<script>
			alert('You have succesfully started masquerading!');
			window.location.href = "../index.php?mask";
		</script>
		</html>
	<?php
	if(isset($_SESSION['Masquerade']))
	{
		$_SESSION['JimCarrey'] = $_SESSION['name'];
	}
}








	$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

		mysql_select_db('stt', $g_link);

		if(!$g_link)
		 {
			 die("Connection failed: " . mysql_connect_error());
		 }
		
	
		$query = "SELECT * FROM `students` WHERE `active` = 1";
    $result = mysql_query($query);


	

    
?>

<html>
  <form id="Masquerade" method="post">
    <select name= Masquerade>
      <?php 
      	while($row = mysql_fetch_assoc($result))
        {
					$myid = $row['id'];
					$myname = $row['username'];
          echo "<option value= $myid >", $myname; "</option>";
        }
      ?>
				<br>
				<input type="submit" value="Masquerade" style="background:#bfbfbf;color:#000000;border-color:#212121;" onMouseOver="this.style.color = '#404040';" onMouseOut="this.style.color = '#000000';" onFocusr="this.style.color = '#404040';"
				onBlur="this.style.color = '#000000';">
			

				<br>
    </select>
  </form>
</html>
<?php

