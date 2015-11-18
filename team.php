<?php
	require_once "functions.php";
	makeHeader("Team Pages", "Team Pages", 2,"<style>.meat{position:absolute;width:77%;background:black;color:White;margin-top:5px;border-radius:10px;padding:5px;opacity:0.9;}</style>");
?>

<div class="meat">
	
<BR>
<a href='walter'>
	<div class="personBox">
		<h1 id="initial">W.S.</h1>
		<h1 id="name">Walter</h1>
		<img class="personPic" src="http://goo.gl/zBA0Gk" height="100px" width="100px">
	</div>
</a>
<BR>
<a href='Jaydon'>Jaydon</a>
<BR>
<a href='Mason'>Mason</a>
<BR>
<a href='mckayla'>McKayla</a>
<BR>
<a href='Daniel'>Daniel</a>
<BR>
<a href='britton'>Britton</a>
<BR>
<a href="Jon_Zimmer">Jon Zimmer</a>
<BR>
<a href="Hamdawg">Austin</a>
<BR>
<a href="Practice">Ethan</a>
<BR>
<a href="Maximus">Max</a>
<BR>
<a href="Wyatt">Wyatt</a>
	
</div>

	<style>
	
		.personBox{
			background:white;
			color:black;
			border-radius:5px;
			width:70px;
			height:60x;
			
		}
		#name{
			display:none;
		}
		.personPic{
			display:none;
		}
		.personBox:hover{
			width:200px;
			height:200px;
		}
	</style>
	
<?php
	makeFooter("this is going to be cool", 2);
?>
