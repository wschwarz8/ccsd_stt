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
		$article_part = 5;
		$article_array[$useful_info['article_id']][$article_part]=$useful_info['archive'];
		//takes on the last articles id giving total amount of articles
		$article_count = $useful_info['article_id'];
	}
?>

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
						if ($article_array[$i][5] == 1){
							echo("<style>.article".$i."{background:red;}</style>");
						}else{
							echo("<style>.article".$i."{background:green;}</style>");
						}
						echo("<tr class='article".$i."'><td><p>" . $article_array[$i][0] . "</td><td><p>" . $article_array[$i][1] . "</p></td><td><p>" . $article_array[$i][2] . "</p></td><td><img src='" . $article_array[$i][3] . "' style='width:45px;height:45px;'></td><td><p>" . $article_array[$i][4] . "</p></td></tr>");
					}
					?>
				</table>
				
			</div>
		</center>
	</section>

	<section class="newNews">
		
		<?php
		
		if ($_POST && $_POST['password'] == 'password1'){//password is password1
			
			$article_count = $article_count + 1;
			
			$article_array[$article_count][0] = $article_count;
			$article_array[$article_count][1] = $_POST['title'];
			$article_array[$article_count][2] = $_POST['message'];
			$article_array[$article_count][3] = $_POST['imageUrl'];
			$article_array[$article_count][4] = $_POST['date'];
			$article_array[$article_count][5] = 0;
			
			$queryinfo = "INSERT INTO `news`(`article_id`, `title`, `message`, `image_url`, `date`, `archive`) VALUES (" . $article_array[$article_count][0] . ",'" . $article_array[$article_count][1] . "','" . $article_array[$article_count][2] . "','" . $article_array[$article_count][3] . "','". $article_array[$article_count][4] ."', ". $article_array[$article_count][5] .")";
			
			mysql_query($queryinfo);
			

		} else if ($_POST && $_POST['password'] == 'password2'){//password is password2
			
			echo $article_array[$_POST['articleId']][5];
			
			if ($article_array[$_POST['articleId']][5] != 0){
				$archive_var = 0;
				
			}else{
				$archive_var = 1;
			}
			
			$article_array[$_POST['articleId']][5] = $archive_var;
			
			$archiveQuery = "UPDATE `news` SET `archive`= ". $archive_var ." WHERE article_id = ". $article_array[$_POST['articleId']][0];
			
			//change article archive status
			mysql_query($archiveQuery);

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

<section class="articleStatus">
	<center>
		<h2>Change Archive Status</h2>
			<form method="post" name="deleteArticle">
				<table>
					<tr><td>Article Id to Change:  </td><td><input type="text" name="articleId" placeholder="Article Id"></td></tr>
					<tr><td>Authorization code: </td><td><input type="password" name="password" placeholder="password2"></td></tr>
				</table>
				<input type="Submit" value="Submit">
			</form>
		</center>
	</section>

	
	
	<?php
  makeFooter("&#169; Copyright Cherokee Washington Highschool <a href='index.php'> Home Page<a/><a href='' onclick='initIt()'>About us</a> <style>#footer a{color:black; margin-left:3px;}#footer p{color:black; text-decoration:underlined;}</style>",0,"true");
			mysql_close($conn);
?>