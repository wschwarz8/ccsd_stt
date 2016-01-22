<?php
//header function to set up at the beginning of the webpage
//call this function by declaring
//makeHeader(string: "tabbar title here",string: "page title here", Int: style#);             <--- needs updated
//style can be either 0,1,2, or 3 where 0 is default and the other three are more detailed premade styles
function makeHeader($tbtitle,$ptitle,$pstyle,$fileName, $hhtml=""){
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
		
				<div class='buttonRow'>
				
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
			 if ($footerbox == "False"){
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
		return $styleText = '<link href="css_files/headerStyle2.css" rel="stylesheet">';
		break;
		case 3://braves theme
		return $styleText = '<link href="/css_files/headerStyle3.css" rel="stylesheet";>';
		break;
		default://select this style if you want to have your own style. Just have your <style> or <link> tags be your first line of code between the header and footer functions
		return $styleText = "";
	}
}
