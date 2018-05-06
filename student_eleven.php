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
if(isset($_POST['ask'])&&isset($_POST['question'])&&isset($_GET['subject_id'])&&$_GET['assign_num'])
{
  if($_POST['question']!="")
  {

    $studentid=$_SESSION['id'];
    $classid=$_SESSION['class_id'];
    $subjectid=$_GET['subject_id'];
    $assignnum=$_GET['assign_num'];
    //echo $subjectid.$studentid.$classid ;

    $query2="select teacher_id from teacher_class_subject where class_id='$classid' and subject_id='$subjectid'";
    $result2=mysqli_query($conn,$query2);
    if($result2===false)
        die(mysqli_error($conn));

    $row=mysqli_fetch_assoc($result2);
    $teacherid=$row['teacher_id'];

    $ques=$_POST['question'];
  $query="insert into querier(student_id,teacher_id,subject_id,assign_num,date,question)
            values('$studentid','$teacherid','$subjectid','$assignnum',CURDATE(),'$ques')";
  $result=mysqli_query($conn,$query);
  if($result===false)
      die(mysqli_error($conn));
echo "asked.";

header("Location: student_two.php");
exit;

  }
}

}
 ?>
