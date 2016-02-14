<!DOCTYPE html>
<!-- main page/home page -->
<html class="mainelement">

<header>
	<link href="css_files/commonCSS.css" rel="stylesheet">
	<link href="css_files/mainPage.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="javascript_files/mainPage.js"></script>

	<title>Max's Website</title>
</header>

<body class="body"  onload="onpageloads()">
	<div class="back">
		<div class="topbar">
			<h1 id="title">Maxwell A. DeVos</h1>

			<div style="padding-left:50%">
				<div class="welcomebox">
					<h2 id="Welcometext">Welcome to my Website</h2>
				</div>
			</div>
			<br>
			<div style="padding-left:50%">
				<a href="phpPage.php">
					<div class="phpsitebutton">
						<h2>
						My PHP Site
					</h2>
					</div>
				</a>
			</div>
			<div style="padding-left:50%">
				<a href="phpGamePage.php">
					<div class="phpsitebutton">
						<h2>
						My First Game
					</h2>
					</div>
				</a>
			</div>
			<div style="padding-left:50%">
				<a href="drawing.php">
					<div class="phpsitebutton">
						<h2>
						Paint!
					</h2>
					</div>
				</a>
			</div>
			<div style="padding-left:50%">
				<a href="ticTacToe.php">
					<div class="phpsitebutton">
						<h2>
						Tic Tac Toe
					</h2>
					</div>
				</a>
			</div>
			<div style="padding-left:50%">
				<a href="snake.html">
					<div class="phpsitebutton">
						<h2>
						Snake Game
					</h2>
					</div>
				</a>
			</div>
		</div>
		<div style="padding-left:50%">
				<a href="pacMan.html">
					<div class="phpsitebutton">
						<h2>
						Pac Man
					</h2>
					</div>
				</a>
			</div>
		<div class="middlesec">

			<div class="leftbar">
				<h2>Pictures</h2>
				<div>
					<img src="http://goo.gl/5CsVZT" />
				</div>
				<div>
					<img src="https://goo.gl/Uhcfk9" />
				</div>
			</div>
			<div class="rightbar">

				<div>
					<ul>
						<h2 style="padding:1%;">Who am I</h2>
						<li>
							<p style="text-align:left">My name is Maxwell A. DeVos and I am a junior in high school. I have 2 sisters and 1 brother. One of my sisters is in college at UNI to become a teacher. My other two siblings are both in elementary school. Some of my favorite things to do is coding
								and building stuff. My favorite food is brats and my favorite color is blue. My favorite NFL team is the Vikings.</p>
						</li>
						<h2 style="padding:1%;">Why I joined</h2>
						<li>
							<p style="text-align:left">The main reason that I joined this class is because I love technology. I love to to code and learn how computers work and I also like to take things apart to fix them or just to see how they work.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="coolsection">
			<h1 id="test">
			Javascript Stuff
		</h1>
			<div class="ButtonStuff">
				<input id="btn1" type="button" onclick="firstButtonPressed()" value="Press me">
				<br>
				<input id="btn2" type="button" onclick="secondButtonPressed()" value="No press me">
				<br>
				<input id="btn3" type="button" onclick="thirdButtonPressed()" value="Press me I am the best">
				<br>
				<p id="btn3a"></p>
				<p id="hidetexts">
					Hey can you figure out how to <a href="javascript:;" onclick="hidetext()">hide</a> this text?
				</p>
				<div id="colorcircle" onmouseenter="colorcirclefunc()">
					<p>
						Move your mouse over me!
					</p>
				</div>
			</div>

		</div>

		<div class="survey">
			<div>

				<table class="surveytable" border="5px" color="black">
					<tr border="5px">
						<th colspan="3">
							<h3 id="surveytitle" style="text-align:center"><strong>Survey Results <a href="javascript:;" onclick="startsurvey()"><h3>Take Survey Here!!</h3>
							</a>
							</strong>
							</h3>
						</th>
					</tr>
					<tr border="5px">
						<th>
							<h3 style="text-align:center"><strong>Question</strong></h3>
						</th>
						<th>
							<h3 style="text-align:center"><strong>My Answer</strong></h3>
						</th>
						<th>
							<h3 style="text-align:center"><strong>Your Answer</strong></h3>
						</th>
					</tr>
					<tr border="5px">
						<th>What is your favorite color?</th>
						<th style="text-align:center">Blue</th>
						<th id="firstanswer" style="text-align:center"></th>
					</tr>
					<tr border="5px">
						<th>What is your favorite Animal?</th>
						<th style="text-align:center">Velociraptor</th>
						<th id="secondanswer" style="text-align:center"></th>
					</tr>
					<tr border="5px">
						<th>What is your favorite Food?</th>
						<th style="text-align:center">Brats</th>
						<th id="thirdanswer" style="text-align:center"></th>
					</tr>
					<tr border="5px">
						<th>What is your favorite computer language?</th>
						<th style="text-align:center">javascript</th>
						<th id="fourthanswer" style="text-align:center"></th>
					</tr>
					<tr border="5px">
						<th>What is your favorite sport to watch?</th>
						<th style="text-align:center">Football</th>
						<th id="fifthanswer" style="text-align:center"></th>
					</tr>
				</table>
			</div>
		</div>

		<div class="bottombar">
			<h3>Contact: Tel. (712-229-9631)  Email: (Devosmaxwell@ccsd.k12.ia.us)</h3>
		</div>
	</div>
</body>

</html>
