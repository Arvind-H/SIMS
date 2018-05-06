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
<?php
$studentid=$_SESSION['id'];
$subjectid=$_GET['subject_id'];

$query="select date from attendance_transaction where  student_id='$studentid' and subject_id='$subjectid' order by date desc";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error($conn));

  ?>
  <b>Subject:  </b>
<?php
echo "<b>".$subjectid."</b>";
?>
<body>
  <div id="absentDays">
<table cellpadding="7px">
  <caption><b>Days&nbspAbsent:</b></caption>
<?php
while($row=mysqli_fetch_assoc($result))
{
  ?>
  <tr><td><?php echo $row['date']; ?></td></tr>
<?php } ?>

</table>
</div>
</body>
</html>
<?php } ?>
