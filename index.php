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
						//make a query that stores each part of a news segment into a seperate variables
					function getArticles(){
						
						//get username and password
						require_once "config.php";
						
						//start connection
						$conn = mysql_connect("localhost", $g_username, $g_password);
						
						//access correct database
						mysql_select_db('stt', $conn);
						
						//store query command in a variable
						$query = "SELECT * FROM news";
						
						//commence query
						$info = mysql_query($query);
						
						//store info from query into an array
						while($useful_info = mysql_fetch_assoc($info)){
							$article_part = 0;
							$article_array[$useful_info['article_id']][$article_part]=$useful_info['article_id'];
							$article_part = 1;
							$article_array[$useful_info['article_id']][$article_part]=$useful_info['title'];
							$article_part = 2;
							$article_array[$useful_info['article_id']][$article_part]=$useful_info['message'];
							$article_part = 3;
							$article_array[$useful_info['article_id']][$article_part]=$useful_info['image_url'];
							$article_part = 4;
						 $article_array[$useful_info['article_id']][$article_part]=$useful_info['date'];
						}
					
					/* variables to access the article
					$article_array[1][0];  --contains article id
					$article_array[1][1];  --contains article title
					$article_array[1][2];  --contains article message
					$article_array[1][3];  --contains article image url
					$article_array[1][4];  --contains article date made/published
					*/
						
					//close connection
					mysql_close($conn);
						
						echo('
							<style>
							.viewingFrame{
								opacity:1.0;
								background-image: url(' . $article_array[1][3] . ');
								background-size:100%;
								background-repeat: no-repeat;
							}
							.newsHeader{
								margin:0 0 5px 0;
								width:100%;
								height:5%;
								background:black;
								opacity:0.5;
								
							}
							</style>
							<div class=¨newsHeader¨><h1>' . $article_array[1][1] . '</h1></div>
							');
						
					//display the first article
					//showArticle(1);
					}
					
					function showArticle($article_Num){
							
						}
						
					getArticles();
					
					?>
				</div>
				
				<!--these will cycle through stories-->
				<a href="#" onclick="leftClick()"><h2> <<< </h2></a>
				
				<a href="#" onclick="rightClick()"><h2> >>> </h2></a>
					
				</div>
			</center>
	</section>


	<?php
	makefooter("",0,"false");
?>