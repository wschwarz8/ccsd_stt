<!--max devos made this -->

<?php
//header function to set up the beginning of the webpage
//call this function by declaring 
//makeHeader(string: "tabbar title here",string: "page title here", Int: style#);
//style can be either 0,1,2, or 3 where 0 is default and the other three are more detailed premade styles
function makeHeader($tbtitle,$ptitle,$pstyle){
	
	echo("
	<html>
		<header>
			<title>". $tbtitle . "</title>
			<style>". styleChoice($pstyle) . "</style>
		</header>
		<body>
			<div class='header'>
				<a href='index.php'><h1 id='headerTitle'>". $ptitle . "</h1><a>
			</div>
	");
}
//footer function to set up the end of a webpage easier
//call this function by declaring
//makeFooter(String: "message", Int style#);
//leave style as 0 if you want to keep the style from the makeHeader functions
function makeFooter($footermessage,$pstyle){
	echo("
		<style>". styleChoice($pstyle) ."</style>
			
				<div class='footer'>
					<h3 id='footerMessage'>". $footermessage . "</h3>
				</div>
			
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
		
		.header{position:absolutewidth:78%;height:75px;background:black;color:White;margin-top:0;border-radius: 0 0 10px 10px;}
		
		.header a{text-decoration:none;}
		
		.header a:hover{text-decoration:underline;}
		
		#headerTitle{text-align: Center;color:white;border-bottom:0;}
		
		.footer{position:absolute;bottom:0;width:78%;height:75px;background:black;color:white;border-radius: 10px 10px 0 0;}
		
		#footerMessage{text-align: Center;}
		";
		break;
		case 2://moderately complex
		return $styleText="
		html{margin:0;padding:0;background:Black;color:White;}
		
		body{margin: 0 10% 0 10%;padding: 0 1% 0 1%;background:gold;color:black;font-size: 20px;}
		
		.header a{text-decoration:none;}
		
		.header a:hover{text-decoration:underline;}
		
		.header{position:absolutewidth:78%;height:75px;background: linear-gradient(to right, black, black, grey,black, black);color:gold;margin-top:0;border-radius: 0 0 10px 10px;opacity:0.9;}
		
		#headerTitle{text-align: Center;color: gold;opacity:1;}
		
		.footer{position:absolute;bottom:0;width:78%;height:75px;color:white;border-radius: 10px 10px 0 0; opacity:0.9;background: linear-gradient(to right, black, black, grey,black, black);}
		
		#footerMessage{text-align: Center;}
		";
		break;
		case 3://very complex and fancy 
		return $styleText = "
		html{margin:0;padding:0;background:Black;color:White;}
		
		body{margin: 0 10% 0 10%;padding: 0 1% 0 1%;background:gold;color:black;font-size: 20px;}
		
		.header a{text-decoration:none;}
		
		.header a:hover{text-decoration:underline;}
		
		.header{position:absolutewidth:78%;height:75px;background: linear-gradient(to right, black, black, grey,black, black);color:gold;margin-top:0;border-radius: 0 0 10px 10px;opacity:0.9;}
		
		#headerTitle{text-align: Center;color: gold;opacity:1;}
		
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
