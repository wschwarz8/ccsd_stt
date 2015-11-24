<?php
//header function to set up the beginning of the webpage
//call this function by declaring 
//makeHeader(string: "tabbar title here",string: "page title here", Int: style#);
//style can be either 0,1,2, or 3 where 0 is default and the other three are more detailed premade styles
function makeHeader($tbtitle,$ptitle,$pstyle, $hhtml=""){
	if(!$ptitle)$ptitle=$tbtitle;	
	echo("
	<!--max devos made this -->
	<html>
		<head>
			<title>". $tbtitle . "</title>
			". styleChoice($pstyle)
			);
	echo $hhtml;
	echo("
		</head>
		<body>
			<div class='header'>
				<a href='../index.php'><h1 id='headerTitle'>". $ptitle . "</h1><a>
				<div class='buttonRow'>
					<a href='../index.php'><div class='buttons'>Home</div></a><a href='../jobs.php'><div class='buttons'>Jobs</div></a> <a href='../scoreboard.php'><div class='buttons'>Scoreboard</div></a> <a href='../team.php'><div class='buttons'>Team Pages</div></a> <a href='../DisplayBroken.php'><div class='buttons'>Broken</div></a> <a href='../login/login.php'><div class='buttons'>Login</div></a> 
				</div>
			</div>
			<div class='meat'>
	");
}
//footer function to set up the end of a webpage easier
//call this function by declaring
//makeFooter(String: "message", Int style#);
//leave style as 0 if you want to keep the style from the makeHeader functions
function makeFooter($footermessage,$pstyle,$footerbox=""){
	echo("
	<!--max devos made this -->
	</div>
		<style>". styleChoice($pstyle) ."</style>
			");
			 if ($footerbox === "false"){
			 }else{
				echo ("
				<div class='footer'>
					<h3 id='footerMessage'>". $footermessage . "</h3>
				</div>
				");
			 }
			 echo ("
		<body>
	<html>
	");
}


//stores desired theme into a variable
function styleChoice($styleNum){
	switch($styleNum){
		case 1://basic style with some bare structure
		return $styleText = '<link href="/css_files/headerStyle1.css" rel="stylesheet">';                     
		break;
		case 2://coding theme
		return $styleText = '<link href="/css_files/headerStyle2.css" rel="stylesheet">';
		break;
		case 3://braves theme
		return $styleText = '<link href="/css_files/headerStyle3.css" rel="stylesheet";>';
		break;
		default://select this style if you want to have your own style. Just have your <style> or <link> tags be your first line of code between the header and footer functions
		return $styleText = "";
	}
}



function promptLogin()
{
	session_start();
	
	if(!$_SESSION['loginid'])
	{
		header('location:login/login.php?reason=1');
	}
}
?>
