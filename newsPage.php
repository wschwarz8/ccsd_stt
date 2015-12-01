<?php
  require_once "functions.php";
  require_once "config.php";
	makeHeader("News","News Page",2, "<link href='css_files/newsPage.css' rel='stylesheet'>");
	
	$article_count = 0;

	$conn = mysql_connect("localhost", $g_username, $g_password);
			
	mysql_select_db('stt', $conn);
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
		//takes on the last articles id giving total amount of articles
		$article_count = $useful_info['article_id'];
	}
?>

	<section class="newNews">
		
		<?php
		
		if ($_POST && $_POST['password'] == 'password1'){
			
			$_POST['password'] = "dfgsdfsdfsd";
			
			$article_count = $article_count + 1;
			
			$article_array[$article_count][0] = $article_count;
			$article_array[$article_count][1] = $_POST['title'];
			$article_array[$article_count][2] = $_POST['message'];
			$article_array[$article_count][3] = $_POST['imageUrl'];
			$article_array[$article_count][4] = $_POST['date'];
			
			$queryinfo = "INSERT INTO `news`(`article_id`, `title`, `message`, `image_url`, `date`) VALUES (" . $article_array[$article_count][0] . ",'" . $article_array[$article_count][1] . "','" . $article_array[$article_count][2] . "','" . $article_array[$article_count][3] . "','". $article_array[$article_count][4] ."')";
			
			mysql_query($queryinfo);
			

		} else if ($_POST && $_POST['password'] == 'password2'){
			
			$_POST['password'] = "tyerterte";
			
			//change how many articles their are now
			$oldArticle_count = $article_count;
			$article_count = $article_count - 1;
			
			//update still present articles to new article id's
			if ($article_count != 0){
				//move stories up behind id that will be removed
				for ($i = $_POST['articleId']; $i <= $oldArticle_count - 1; $i = $i + 1){
		
					$article_array[$i][0] = $article_array[$i][0];
					$article_array[$i][1] = $article_array[$i+1][1];
					$article_array[$i][2] = $article_array[$i+1][2];
					$article_array[$i][3] = $article_array[$i+1][3];
					$article_array[$i][4] = $article_array[$i+1][4];
					
					$updateQuery ="UPDATE `news` SET `article_id`=". $article_array[$i][0] .",`title`='" . $article_array[$i][1] . "',`message`='" . $article_array[$i][2] . "',`image_url`='',`date`='' WHERE article_id=".$i; 
					
					mysql_query($updateQuery);
				}
			}
			
			//make query to delete selected article
			$removeQuery = "DELETE FROM `news` WHERE article_id=" . $oldArticle_count;
			
			//remove last uncessary article
			mysql_query($removeQuery);
			

		}
		
		?>
		<center>
			<div class="formBox">
				<h1>
					Submit News Articles
				</h1>
				<form name="newsSubmission" method="post">
					<table style="color:white;">
						<tr>
							<td>Article Title:</td>
							<td>
								<input type="text" name="title" placeholder="News Title" style="opacity:1.0;">
							</td>
						</tr>
						<tr>
							<td>Article Body:</td>
							<td>
								<textarea style="width:200px;height:150px;" name="message" placeholder="Im the main text area of the article.Type your main point here"></textarea>
							</td>
						</tr>
						<tr>
							<td><a href="https://goo.gl/">Shortened</a> Article Image Url:</td>
							<td>
								<input type="text" name="imageUrl" placeholder="Image Url">
							</td>
						</tr>
						<tr>
							<td>Current Date:</td>
							<td>
								<input type="date" name="date" style="width:200px;">
							</td>
						</tr>
						<tr>
							<td>Authorization Code:</td>
							<td>
								<input type="password" name="password" placeholder="password1">
							</td>
						</tr>
					</table>
					<input type="Submit" value="Submit" style="margin:5px;">
				</form>
			</div>
		</center>
	</section>

	<section class="currentNews">
		<center>
			<div class="currentArticles">
			<h1>
				Current News Articles
			</h1>
				<table>
					<tr><td>Article ID</td><td>Title</td><td>Message</td><td>Image</td><td>Date</td></tr>
					<?php
					for ($i = 1;$i < $article_count + 1; $i = $i + 1){
						echo("<tr><td>" . $article_array[$i][0] . "</td><td>" . $article_array[$i][1] . "</td><td>" . $article_array[$i][2] . "</td><td><img src='" . $article_array[$i][3] . "' style='width:45px;height:45px;'></td><td>" . $article_array[$i][4] . "</td></tr>");
					}
					?>
				</table>
				<p>Remove an Article?</p>
				<form method="post" name="deleteArticle">
					<input type="text" name="articleId" placeholder="Article Id">
					<input type="password" name="password" placeholder="password2">
					<input type="Submit" value="Submit">
				</form>
			</div>
		</center>
	</section>

	<?php
  makeFooter("",0,"false");
			mysql_close($conn);
?>