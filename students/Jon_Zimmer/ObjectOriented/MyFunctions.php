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

?>
