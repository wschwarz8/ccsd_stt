<?php
require_once 'config.php';

$g_link = mysql_connect('localhost', $g_username, $g_password);

mysql_select_db('stt', $g_link);

if(!isset($_GET['badabing'])){
  echo "You fail.";
  die;
}

$potato=$_GET['badabing'];

$query="SELECT * FROM `students` WHERE id=$potato";
$result = mysql_query($query);
$NewBox=mysql_fetch_assoc($result);

$Name=$NewBox['name'];
$Class=$NewBox['class'];
$Active=$NewBox['active'];
$Bio=$NewBox['bio'];

$jobs = array();
$query = "SELECT * from jobs where claimedby=$potato";
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)){
  $jobs[$potato]=$row['name'];
}
   
?>

<html>

<head>

</head>

<body>
  <div class="nav">
    <div class="container">
      <ul class="pull-left">
        <li>
          <p>Student Tech Team Member</p>
      </ul>
      <ul class="pull-right">
        <li>
          <p>Cherokee Washington Highschool</p>
    </div>
  </div>

  <div class="jumbotron">
    <div class="container">
      <h1><?php echo $Name; ?></h1>
    </div>
  </div>
  <div class="Hobbies">
    <div class="container">
      <h2><?php echo $Class; ?></h2>
      <div class="col-md-4">
        <h3><?php echo $Active; ?></h3>
      </div>
      <div class="col-md-4">
        <h3><?php echo $Bio; ?></h3>
        <p></p>
      </div>
      <div class="col-md-4">
        <h3></h3>
        <p></p>
        This student's claimed jobs are: <?php print_r($jobs); ?>
        <p></p>
        <p></p>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
