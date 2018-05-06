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
 if($_SESSION['person']=="Student")
$studentid=$_SESSION['id'];
else {
  $studentid=$_GET[''];
}

$query="select * from student where student_id='$studentid'";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error());

  $row=mysqli_fetch_assoc($result);
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Student Profile</title>
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
