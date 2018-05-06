<?php session_start();
error_reporting(0);
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
<!DOCTYPE html>
<html>
<head>
  <title>Attendance Student </title>
  <link rel="stylesheet" href="http://localhost/SIMS/styles/theme.css" type="text/css" />

</head>
<body>
  <div id="container">
    <div id="header">

      <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
      <div id="logout">
        <a href="logout.php"><b>Log Out</b></a>
      </div>
    </div><!--end of header-->
    <div id="topNav">
      <table cellspacing="7px">
      <tr>
        <td><a href="student_one.php">HOME</a></td><td></td><td>|</td><td></td>
        <td><a href="student_two.php">ASSIGNMENTS</a></td><td></td><td>|</td><td></td>
        <td><a href="student_three.php">ATTENDANCE</a></td><td></td><td>|</td><td></td>
        <td><a href="student_four.php">REMINDER</a></td><td></td><td>|</td><td></td>
        <!--  <td><a href="student_six.php">PROFILE</a></td><td></td><td>|</td><td></td>  -->
    </tr>
  </table>
    </div>

    <!--  <div id="nav">
        <ul>
          <a href="student_one.php"><li>HOME</li></a>
          <a href="student_two.php"><li>ASSIGNMENTS</li></a>
          <a href="student_three.php"><li>ATTENDANCE</li></a>
          <a href="student_four.php"><li>REMINDER</li></a>   -->
          <!--  <a href="student_six.php"><li>PROFILE</li></a>  -->
      <!--  </ul>
      </div>  --><!--End of Navigator-->


    <div id="attendanceReport">
      <table border="2px solid red" align="center" cellpadding="7px" >
        <caption><b>Attendance&nbspReport</b></caption>
        <tr>
          <td>Subject</td>
          <td>Title</td>
          <td>Percent %</td>
          </tr>
  <?php
  $studentid=$_SESSION['id'];
  $classid=$_SESSION['class_id'];
  $query="select * from student_attendance where student_id='$studentid'";
  $result=mysqli_query($conn,$query);
  if($result===false)
    die(mysqli_error($conn));
  $row=mysqli_fetch_row($result);

     $query2="select * from class_subject_num where class_id='$classid'";
    $result2=mysqli_query($conn,$query2);
    if($result2===false)
      die(mysqli_error($conn));
    $row2=mysqli_fetch_row($result2);
    $subject=array("","","","","","");
    $percent=array("","","","","","");
    $subjecttitle=array("","","","","","");
    $percent_total=0;
    $i=1;
    while($i<=6){
      $subjectid=$row2[$i];
      $subject[$i-1]=$subjectid;

      $num_days_present=$row[$i];

    $query3="select * from subjectcode where subject_id='$subjectid'";
    $result3=mysqli_query($conn,$query3);
    if($result3===false)
      die(mysqli_error($conn));
    $row3=mysqli_fetch_row($result3);
    $subjecttitle[$i-1]=$row3[1];
    $num_periods=$row3[2];
    $percent[$i-1]=($num_days_present/$num_periods)*100;
    $percent_total=$percent_total+$percent[$i-1];
    $i++;

   }
   $percent_total=$percent_total/6;
   ?>

     <b>Total: </b>
    <b> <i><?php echo round($percent_total,2)." %"; ?></i></b>

   <?php
   for($j=0;$j<6;$j++)
   {
?>

    <tr>
      <td><a href="student_eight.php?subject_id=<?php echo $subject[$j]; ?>"><?php echo $subject[$j]; ?></td>
      <td><?php echo $subjecttitle[$j]; ?></td>
      <td><?php echo round($percent[$j],2); ?></td>
    </tr>
<?php } ?>
      </table>
    </div>
  </div>
</body>
</html>
<?php } ?>
