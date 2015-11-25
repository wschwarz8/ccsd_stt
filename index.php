<?php
	require_once "functions.php";
	makeHeader("STT HOME","Student Technology Team Home",2,'<link href="/css_files/homePage.css" rel="stylesheet";><script language="javascript" type="text/javascript" src="javascript_files/homePage.js"></script>');
?>
	<nav>
		<center>
			<h2>Welcome to the site.</h2>
			<p>
				Visit <a href="phpmyadmin">here</a> for php MyAdmin.
			</p>
			<p>
				Visit <a href="students_skills.php">here</a> for a list of Students and Skills.
			</p>
			<p>
				Visit <a href="enter_skillNames.php">here</a> for entering skill names.
			</p>
			<p>
				Visit <a href="scoreboard.php">here</a> for the scoreboard.
			</p>
			<p>
				Visit <a href="jobs.php">here</a> for the Job List.
			</p>
			<p>
				Visit <a href="team.php">here</a> for the team page.
			</p>
			<p>
				Visit <a href="DisplayBroken.php"> here</a> for a list of broken chromebooks.
			</p>
			<p>
				Visit <a href="login/login.php"> here</a> for the login page.
			</p>
		</center>
	</nav>
	<section class="newsDisplay">
			<center>
			<div class="centeringFrame">
				<h1>News</h1>
				<div class="viewingFrame">
					<?php
						
					?>
				</div>
				
				<a href="#" onclick="leftClick()"><h2> <<< </h2></a>
				
				<a href="#" onclick="rightClick()"><h2> >>> </h2></a>
					
				</div>
			</center>
	</section>


	<?php
	makefooter("",0,"false");
?>