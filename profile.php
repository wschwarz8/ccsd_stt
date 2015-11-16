<?php
require_once 'config.php';

$g_link = mysql_connect('localhost', $g_username, $g_password);

mysql_select_db('stt', $g_link);

$query="SELECT * FROM `students` WHERE 1";






$Name="Britton";
$Jobs="Jobs";
$STT="Student Tech Team";
$Biography="Biography and Info";
$Rewards="Rewards";

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
      <h2><?php echo $Jobs; ?></h2>
      <div class "col-md-4">
        <h3><?php echo $STT; ?></h3>
      </div>
      <div class="col-md-4">
        <h3><?php echo $Biography; ?></h3>
        <p></p>
      </div>
      <div class="col-md-4">
        <h3><?php echo $Rewards; ?></h3>
        <p></p>
        <p></p>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
