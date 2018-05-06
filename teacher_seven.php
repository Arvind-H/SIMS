<?php
  session_start();
  if(!($_SESSION['auth']===true&&$_SESSION['person']=='Teacher'))
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
if(isset($_POST['answer'])&&isset($_POST['submit'])&&isset($_GET['q_id']))
{
  $ans=$_POST['answer'];
  $qid=$_GET['q_id'];
  $query="update querier set answer='$ans' where q_id='$qid'";
  $result=mysqli_query($conn,$query);
  if($result===FALSE)
    die(mysqli_error($conn));

  //echo "answered .";

  header("Location: teacher_six.php");
  exit;
}

}

 ?>
