<?php


if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && ($_POST['secret']=='W')) // Happens if someone has attempted account reset
{
		require_once '../config.php';
		require_once 'login.js';
	
		$user = $_POST['username'];
		$pass1 = $_POST['password'];
		$pass2 = $_POST['password2'];
	
		$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

		mysql_select_db('stt', $g_link);

		if($pass1 !== $pass2)
		{
			echo "<script>window.location.href='passwordReset.php';alert('The passwords do not match! Please Re-enter your passwords and try again!');</script>";
			
		}
	
		if(!$g_link)
		 {
			 die("Connection failed: " . mysql_connect_error());
		 }
		
		$cost = 10;
	
		$salt = sprintf("$2a$%02d$", $cost). $salt;

		$hash = crypt($pass2, $salt);

		$query = "UPDATE `students` SET `password`='$hash'  WHERE username ='$user'";

   		$result = mysql_query($query);
		if($result) {echo "Password set for ".$user.".<BR>";}
		else {echo mysql_error($g_link);}


	
}
else
{
	?>
	<html>
		<head>
			<titlePlease Please type the password you would like for your username</title>
				<script language="JavaScript" type="text/JavaScript" src="login.js"></script>
				<script language="JavaScript">
//					alert(Login);
//					Login(this);
//					fred;
			</script>
		<body background= "#FF8D01">
			<form name="SetPassword" method="post">
				<br>
				<center>					
					Current Username:
					<input type="text" name="username" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
					<br>

					Requested Password:
					<input type="password" name="password" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
					<br>
					
					Retype Password:
					<input type="password" name="password2" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
					<br>
					Secret:
					<input type="text" name="secret" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
					<br>
					<input type="button" value="Set" onClick="Login(this.form);" style="background:#bfbfbf;color:#000000;border-color:#212121;" onMouseOver="this.style.color = '#404040';" onMouseOut="this.style.color = '#000000';" onFocusr="this.style.color = '#404040';"
					onBlur="this.style.color = '#000000';">
				</center>
				<br>
			</form>
		</body>
		</head>
		</html>
<?php
}
