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
				<a href="newsPage.php"><h1>News</h1></a>
				<div id="viewingFrame">
					<?php
						//make a query that stores each part of a news segment into a seperate variables
						
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
							$article_part = 5;
							$article_array[$useful_info['article_id']][$article_part]=$useful_info['archive'];
							
							//takes on the last articles id giving total amount of articles
							$article_count = $useful_info['article_id'];
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
					
					
					echo("
					<script>
						//store all php variables into javascript for use later
						var articleCount = " . $article_count . ";
						
						var article_id = [];
						var article_title = [];
						var article_message = [];
						var article_img = [];
						var article_date = [];
						var article_archive = [];
						var current_article;
					</script>
					");
					
					for ($i = 1; $i < $article_count + 1;$i = $i + 1){
						
						echo ('
						<script>
							article_id[' .$i . '] = ' . $article_array[$i][0] . ';
							article_title[' .$i . '] = "' . $article_array[$i][1] . '";
							article_message[' .$i . '] = "' . $article_array[$i][2] . '";
							article_img[' .$i . '] = "' . $article_array[$i][3]. '";
							article_date[' .$i . '] = "' . $article_array[$i][4] . '";
							article_archive[' . $i . '] = ' . $article_array[$i][5] . ';
						</script>
						');
					}
					
					?>
					
				<script>
					//function to show articles
					function showNews(article_num) {
						
							if (article_num > 0 && article_num < (articleCount + 1)) {
								current_article = article_num;
							} else {
								current_article = 1;
							}
						 
						//check if article is archived
							if (article_archive[current_article] == 1){
								//if article is archived the do this atleast once
								do{
									
									//increment 1 article up
									current_article = current_article + 1;
									
									//check if article id is valid
									if (current_article > 0 && current_article < (articleCount + 1)) {
										//leaving this cuz im lazy
									} else {
										current_article = 1;
									}
									
									//check if the new article is still archived and if not start again
								}while (article_archive[current_article] == 1)
							}
							
							var newsFrame = document.getElementById("viewingFrame");

							var part1 = "<style>#viewingFrame {opacity: 1.0;background-image: url(";
							var part2 = ");background-size: 100% ;background-repeat: no-repeat ;padding: 0;}.newsHeader {margin:0; top: 0;width: 100%; color: white; border-radius: 10px 10px 0 0; opacity: 0.9; background:black; padding-top: 10px; padding-bottom: 10px;}.newsHeader h1{opacity: 1;color: white; margin: 0;} .messageBody{transition: all .3s linear;margin-bottom: 65px;position: absolute; bottom: 0;width: 54.9%;height: 75px; color: white; border-radius: 0 0 10px 10px; opacity: 0.9; background: black;padding: 0;overflow:hidden;}.messageBody p{word-wrap: break-word;padding: 5px;margin: 0;}.messageBody:hover{height:300px;} </style><div class='newsHeader'><h1>";
							var part3 = "</h1></div><div class='messageBody'><p>";
							var part4 = " </p><p>Article created on ";
							var part5 = " </p></div>";

							newsFrame.innerHTML = part1 + article_img[current_article] + part2 + article_title[current_article] + part3 + article_message[current_article] + part4 + article_date[current_article] + part5;
						}

					showNews(1);
				</script>
			</div>
				
				
			<!--these will cycle through stories-->
				<button class="directionButts" onclick="showNews(current_article = current_article - 1)"> <<< </button>
				<button class="directionButts" onclick="showNews(current_article = current_article + 1)"> >>> </button>
			</div>
		</center>
	</section>


	<?php
	makefooter("",0,"false");
?>