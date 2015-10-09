<?php
if(false)
{
			require_once '../config.php';

			$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

			mysql_select_db('stt', $g_link);

			$query = "SELECT * FROM `students` WHERE 1";

			if(!$g_link)
				 {
				 die("Connection failed: " . mysqli_connect_error());
				 }

			$result = mysql_query($query);
			if (mysql_num_rows($result) > 0)
			{
				 // output data of each row
				 while($row = mysql_fetch_assoc($result))
				{
					echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["password"]. "<br>";
				}
			}
			else
			{
				echo "0 results";
			}


			mysql_close($g_link);

}

else
?>
{
	<html>
	<head>
		<titlePlease type your Username and Password... </title>
			<script language="JavaScript" type="text/JavaScript" src="login.js"></script>
	<body background= "http://www.pptwallpapers.com/uploads/abstract-blue-grid-backgrounds-powerpoint.jpg">
		<form>
			<br>
			<center>
				Username:
				<input type="text" name="username" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
				<br>Password:
				<input type="password" name="password" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
				<br>
				<input type="button" value="Login" onClick="Login(this.form);" style="background:#bfbfbf;color:#000000;border-color:#212121;" onMouseOver="this.style.color = '#404040';" onMouseOut="this.style.color = '#000000';" onFocusr="this.style.color = '#404040';"
				onBlur="this.style.color = '#000000';">
			</center>
			<br>
		</form>
	</body>
	</head>
	</html>
}