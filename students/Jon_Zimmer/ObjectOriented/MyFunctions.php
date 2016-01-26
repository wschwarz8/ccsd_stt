<?php
//header function
function makeHeader($tbtitle,$ptitle,$pstyle,$fileName, $hhtml=""){
	if(!$ptitle)$ptitle=$tbtitle;	
	echo("

	<html>
		<head>
			<title>". $tbtitle . "</title>
			". styleChoice($pstyle)
			);
	echo $hhtml;
	echo("
		</head>
		<body onload='calculateStuff();'>
			<div class='header'>
			<h1 id='headerTitle'>". $ptitle . "</h1>
			
				");
		
		//echo viewsofpage($fileName);
	
		echo("
		
				<div class='buttonRow'>
					<a href='../index.php'><div class='buttons'>Home</div></a>
					<a href='../index.html'><div class='buttons'>Back</div></a>
				</div>
		
			<div class='meat'>
	");
}
//
//footer function to set up the end of a webpage easier
//
function makeFooter($footermessage,$pstyle,$footerbox=""){
	echo("
	<!--max devos made this -->
	</div>
		<style>". styleChoice($pstyle) ."</style>
			");
			 if ($footerbox == "false"){
			 }else{
				echo ("
				<div id='footer'>
					<p id='footerMessage'>". $footermessage . "</p>
				</div>
				");
			 }
			 echo ("
		<body>
	<html>
	<script>
	
	function calculateStuff(){
	
		var body = document.body, html = document.documentElement;
		
		var footer = document.getElementById('footer');

		var height = Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight ) + 25;
		
		body.style.height = height;
		
		footer.style.width = '78%';
		footer.style.height= '25px';
		footer.style.top = height - 25;
	}
	
	</script>
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


function viewsofpage($uncletony){
	
	//init pass
	global $g_username,$g_password;
	
	//create conection
	$g_link = mysql_connect('localhost', $g_username, $g_password);

	//select database
	mysql_select_db('stt', $g_link);
	
	//make query
	$query = "SELECT views FROM `pageviews` WHERE filename='$uncletony'";
	
	//start and store query
	$result = mysql_query($query);
	
	//store into an array
	($result = mysql_fetch_assoc($result));
	
	//get variable ready for manipulation
	$variable = ($result['views'] + 1);
		
	//check if their are views already or not
		if($variable>1){
				//add a view to the page table
						$query = "UPDATE `pageviews` SET `views`=" . ($variable) . " WHERE `filename`= '$uncletony'";
						$result = mysql_query($query);
		}
		else{
			//add a table for the file
				$query = "INSERT INTO `pageviews`(`filename`, `views`) VALUES ('$uncletony',1)";
				$result = mysql_query($query);
		}
	
	//print views to screen
		echo ("
		<div class='viewCount'>
			<div class='viewBox'>
				<h3 class='countLeft'>Views: </h3>
				<h3 class='countRight'> ". $variable ." </h3>
			</div>
		</div>
		");
}
?>
