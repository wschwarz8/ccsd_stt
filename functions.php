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
		<header>
			<title>". $tbtitle . "</title>
			<style>". styleChoice($pstyle) . "</style>");
	echo $hhtml;
	echo("
		</header>
		<body>
			<div class='header'>
				<a href='../index.php'><h1 id='headerTitle'>". $ptitle . "</h1><a>
				<div class='buttonRow'>
					<a href='index.php'><div class='buttons'>Home</div><a><a href='jobs.php'><div class='buttons'>Jobs</div><a><a href='scoreboard.php'><div class='buttons'>Scoreboard</div><a><a href='team.php'><div class='buttons'>Team Pages</div><a><a href='login/login.php'><div class='buttons'>Login</div><a>
				</div>
			</div>
	");
}
//footer function to set up the end of a webpage easier
//call this function by declaring
//makeFooter(String: "message", Int style#);
//leave style as 0 if you want to keep the style from the makeHeader functions
function makeFooter($footermessage,$pstyle,$footerbox=""){
	echo("
	<!--max devos made this -->
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
function styleChoice($styleNum){
	switch($styleNum){
		case 1://basic style with some bare structure
		return $styleText= "
		html{margin:0;padding:0;background:Black;color:White;}
		
		body{margin: 0 10% 0 10%;padding: 0 1% 0 1%;background:gold;color:black;font-size: 20px;}
		
		.header{position:absolute;width:78%;height:75px;background:black;color:White;margin-top:0;border-radius: 0 0 10px 10px;}
		
		.header a{text-decoration:none;}
		
		.header a:hover{text-decoration:underline;}
		
		#headerTitle{text-align: Center;color:white;border-bottom:0;}
		
		.footer{position:absolute;bottom:0;width:78%;height:75px;background:black;color:white;border-radius: 10px 10px 0 0;}
		
		#footerMessage{text-align: Center;}
		";
		break;
		case 2://coding theme
		return $styleText="
		html{background:grey;margin-bottom:0;}
		
		body {margin:0 10% 0 10%;padding:0 1% 0 1%;background-color:black;background-image: url(http://goo.gl/JrYNZX);background-repeat: no-repeat;border-radius:0;}
		
		.header{background:white;margin-top: 0;margin-left:10px;margin-right:10px;border-radius: 0 0 10px 10px;opacity: 0.9;padding:5px;}
		
		.header a{text-decoration:none;color:Black;}
		
		.header a:hover{text-decoration:underline;}
		
		#headerTitle{text-align: center;}
		
		.buttonRow{width:100%;text-align:center;}
		
		.buttons{width:120px;height:30px;display:inline-block;background:black;color:white;margin-left:40px;border-radius:8px;padding-top:3px;}
		
		.footer{position:absolute;bottom:0;width:78%;height:75px;color:black;border-radius: 10px 10px 0 0; opacity:0.9;background:white;opacity:0.9;}
		
		#footerMessage{text-align: Center;}
		
		";
		break;
		case 3://very complex and fancy 
		return $styleText = "
		html{margin:0;padding:0;background:Black;color:White;}
		
		body{margin: 0 10% 0 10%;padding: 0 1% 0 1%;background:gold;color:black;font-size: 20px;}
		
		.header a{text-decoration:none;}
		
		.header a:hover{text-decoration:underline;}
		
		.header{position:absolutewidth:78%;height:125px;background: linear-gradient(to right, black, black, grey,black, black);color:gold;margin-top:0;border-radius: 0 0 10px 10px;opacity:0.9;}
		
		#headerTitle{text-align: Center;color: gold;opacity:1;}
		
		.buttonRow{width:100%;text-align:center;}
		
		.buttons{width:120px;height:30px;display:inline-block;background:yellow;color:black;margin-left:40px;border-radius:8px;padding-top:3px;}
		
		.footer{position:absolute;bottom:0;width:78%;height:75px;color:white;border-radius: 10px 10px 0 0; opacity:0.9;background: linear-gradient(to right, black, black, grey,black, black);}
		
		#footerMessage{text-align: Center;}
		";
		break;
		default://select this style if you want to have your own style. Just have your <style> or <link> tags be your first line of code between the header and footer functions
		return $styleText = "";
	}
}



function promptLogin()
{
	//stuff
}
?>
