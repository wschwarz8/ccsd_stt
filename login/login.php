<?php
session_start();

if(isset($_GET["reason"]))
	
{
	echo"<script>alert('You need to login to view this page!');</script>";
	
}

if(isset($_POST["username"]) || isset($_POST["password"])) // Happens if someone has attempted a login
{
		require_once '../config.php';
		require_once 'login.js';
	
		$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

		mysql_select_db('stt', $g_link);

		if(!$g_link)
		 {
			 die("Connection failed: " . mysql_connect_error());
		 }
		
	
		$query = "SELECT * FROM `students` WHERE username='".$_POST['username']."'";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);	
		
		$cost = 10;


		$salt = sprintf("$2a$%02d$", $cost). $salt;

		$hash = crypt($_POST["password"], $salt);

		if($_POST["username"] !== $row["username"] && $hash !== $row["password"])
		{
			echo "<script>window.location.href='login.php';alert('The password and Username you have entered are incorrect, try again!');</script>";
		}
	
	
		elseif($_POST["username"] !== $row["username"])
		{
			echo "<script>window.location.href='login.php';alert('The Username you have entered is incorrect, try again!');</script>";
		}
	
	
		elseif($hash !== $row["password"])
		{
			echo "<script>window.location.href='login.php';alert('The password you have entered is incorrect, try again!');</script>";
		}
	
	
		else
		{
			$_SESSION['loginid']=$row['id'];
			header('location:../index.php');	
		}
		
	
		
			mysql_close($g_link);
		
}

else
{
?>
	<html>
	<head>
		<titlePlease type your Username and Password... </title>
			<script language="JavaScript" type="text/JavaScript" src="login.js"></script>
	<body background= "http://www.pptwallpapers.com/uploads/abstract-blue-grid-backgrounds-powerpoint.jpg">
		<form name="LogMeIn" method="post">
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
<a href="forgotPassword.php">Forgot Password? (or don't have one yet)</a>
	</body>
	</head>
	</html>
<?php
}
