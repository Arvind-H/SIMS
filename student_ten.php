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
$query="delete from task_reminder where task_id='$taskid'";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error($conn));

header("Location: student_four.php");
exit;
}
}
?>
