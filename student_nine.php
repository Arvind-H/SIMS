<?php session_start();
if(!($_SESSION['auth']===true&&$_SESSION['person']=='Student'))
{
  header("Location: logout.php");
}
else{
?>
<?php
$servername='localhost';
$username='root';
$password='root';
$dbname='sims_db';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php

if(isset($_GET['id']))
{
  $taskid=$_GET['id'];
  $deadline=$_GET['deadline'];
$query="update task_reminder set task_status=1, finish_date=CURDATE() where task_id='$taskid'";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error($conn));

  $query3="select finish_date from task_reminder where task_id=$taskid";
  $result3=mysqli_query($conn,$query3);
  if($result3===false)
    die(mysqli_error($conn));
    $row3=mysqli_fetch_row($result3);
$finishdate=$row3[0];
if('$deadline'<'$finishdate')
{
  $query2="update task_reminder set remark=1 where task_id='$taskid'";
}
else{
  $query2="update task_reminder set remark=0 where task_id='$taskid'";
}
  $result2=mysqli_query($conn,$query2);
  if($result2===false)
    die(mysqli_error($conn));

header("Location: student_four.php");
exit;
}
}
?>
