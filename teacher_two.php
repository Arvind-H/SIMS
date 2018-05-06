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
   if(isset($_POST['teacher_three'])||isset($_POST['teacher_four'])||isset($_POST['teacher_five'])||isset($_POST['teacher_six']))
   {
     if(isset($_GET['class_id'])&&isset($_GET['subject_id']))
     {
   $teacher_three=$_POST['teacher_three'];
   $teacher_four=$_POST['teacher_four'];
   $teacher_five=$_POST['teacher_five'];
   $teacher_six=$_POST['teacher_six'];
   $classid = $_GET['class_id'];
   $_SESSION['class_id']=$classid;
   $subjectid = $_GET['subject_id'];
   $_SESSION['subject_id']=$subjectid;

     if(isset($_POST['teacher_three'])){
       header("Location: teacher_three.php");
       exit;
     }
     if($teacher_four){
       header("Location: teacher_four.php");
       exit;
     }
     if($teacher_five){
       header("Location: teacher_five.php");
       exit;
     }
     if($teacher_six){
       header("Location: teacher_six.php");
       exit;
     }
   }
 }
     else{
   ?>

  <!DOCTYPE html>
  <head>
    <!--LOGO for title-->
    <title>Teacher Activities</title>
    <link rel="stylesheet" href="http://localhost/SIMS/styles/theme.css" type="text/css"/>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
        <div id="logout">
          <a href="logout.php"><b>Log Out</b></a>
        </div>
      </div><!--end of header-->
      <div></div>
<?php
$classid=$_GET['class_id'];
$query="select * from classcode where class_id='$classid'";

$result=mysqli_query($conn,$query);
if($result===FALSE)
  die(mysqli_error($conn));

$row=mysqli_fetch_assoc($result);


?>
<div id="class_info" >
  <table>
    <caption></caption>
    <tr>
      <td><b>Class :-</td><td><?php echo $row['dept']."  ".$row['year']."year  ".$row['section']." -section<br>";?></b></td>
    </tr>
  </table>
</div>

  <div id="teacherActivities">
    <form action="" method="post">
      <input type="submit" name="teacher_three" value="Students"><br/><br/>
      <input type="submit" name="teacher_four" value="SEND Assignments"><br/><br/>
      <input type="submit" name="teacher_five" value="Enter Attendance"><br/><br/>
      <input type="submit" name="teacher_six" value="Answer Queries"><br/>
    </form>
  </div>

  <div id="footer">
    <br/>
    <p align="center">&copy Reserved</p>
    <br/>
  </div>
  </body>
  <?php } ?>
  </html>
  <?php } ?>
