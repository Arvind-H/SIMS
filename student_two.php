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
<?php
  $classid=$_SESSION['class_id'];
  $query="select * from assignment where class_id='$classid'";
  $result=mysqli_query($conn,$query);
  if($result===false)
    die(mysqli_error($conn));
  ?>

<!DOCTYPE html>
<html>
<head>
  <title>Assignments Student </title>
  <link rel="stylesheet" href="http://localhost/SIMS/styles/bootstrap.css" type="text/css">
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

        <a href="student_one.php">HOME</a>
        <a href="student_two.php">ASSIGNMENTS</a>
        <a href="student_three.php">ATTENDANCE</a>
        <a href="student_four.php">REMINDER</a>
        <a href="student_six.php">PROFILE</a>

    </div>
  -->
    <!--End of Navigator-->

    <div id="assignmentList">
      <table cellpadding="5px" border="2px solid red" align="center" >
        <caption><b>Assignment Inbox</b></caption>
        <tr>
          <td>Sno.</td>
          <td>Subject</td>
          <td>Assgn. no.</td>
          <td>Date of Submission</td>
        </tr>
        <?php  $i=1; while($row=mysqli_fetch_assoc($result)){  ?>
          <tr>
            <td><?php  echo $i; $i++; ?></td>
            <td><a href="student_five.php?assign_id=<?php echo $row['assign_id']; ?>&file_id=<?php echo $row['file_id']; ?>">
              <?php echo $row['subject_id'];
              $subjectid=$row['subject_id'];
              $_SESSION['subject_id']=$subjectid; ?></a>
            </td>
            <td><?php echo $row['assign_num']; ?></td>
            <td><?php echo $row['dead_line']; ?>
          <!--  <td><?php
              /*  $deadline=date_create($row['dead_line']);
                $queryy=" select CURDATE()";
                $resultt=mysql_query($queryy);
                if($resultt==false)
                  die(mysql_error());
                  $roww=mysql_fetch_row($resultt);
                  echo $roww[0];
                $datetoday=date_create($roww[0]);

                echo $datetoday->format('Y-m-d');

              //  $date1=date_create_from_format("Y-m-d","2016-10-01");
              //  $date2=date_create("2016-09-12");
                 $diff=date_diff($deadline,$datetoday);
                 echo $diff;
                 //print($diff);
                */ ?></td>
            <td>Status</td>
          -->
          </tr>

<?php } ?>

      </table>
    </div>


    <div id="footer">

      <p align="center">&copy ARVIND.H and Co.</p>

    </div>
  </body>
  </html>
  <?php } ?>
