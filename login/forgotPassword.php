<?php


if(isset($_POST["email"]))
{
		require_once '../config.php';
		require_once 'login.js';
	
		$email = $_POST['email'];
	
		$g_link = mysql_connect('localhost', $g_username, $g_password); //TODO use a persistant database connections

		mysql_select_db('stt', $g_link);

		if(!$g_link)
		 {
			 die("Connection failed: " . mysql_connect_error());
		 }

// TODO query the database to select their username and set $user to it

// TODO generate a unique key and store it with a timestamp in the database, store the key in $key

$to      = $email;
$subject = 'Reset your STT password';
$message = 'Use this link to reset your password:<BR><a href="10.1.50.69/login/resetPassword.php?user='.$user.'&key='.$key;
$headers = 'From: wschwarz@ccsd.k12.ia.us' . "\r\n" .
    'Reply-To: wschwarz@ccsd.k12.ia.us' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
// TODO configure sendmail on the server so this actually works
$result = mail($to, $subject, $message, $headers);
if($reuslt)
	echo "An email has been sent with further instructions.";
else
	echo "The email was not sent, an error occurred.";




}
else
{
	?>
	<html>
		<head>
		<body background= "#FF8D01">
			<form name="SetPassword" method="post">
				<br>
				<center>					
					What is your Email Address:
					<input type="text" name="email" style="background:#bfbfbf;color:#212121;border-color:#212121;" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#bfbfbf';">
					<br>
				<br>
<input type="submit">
				</center>
			</form>
		</body>
		</head>
		</html>
<?php
}
