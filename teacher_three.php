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

  <!DOCTYPE html>
  <head>
    <title>Teacher-Students</title>
    <link rel="stylesheet" href="http://localhost/SIMS/styles/theme.css" type="text/css"/>
  </head>
  <body>
    <div id="container" >
      <!--header start-->
      <div id="header" >

        <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
        <div id="logout">
          <a href="logout.php"><b>Log Out</b></a>
        </div>
      </div><!--end of header-->

      <div id="tableTeacherThree">
        <table border="1px" cellpadding="5px">
          <caption><b>List of Students</b></caption>
          <tr>
            <td>Roll Num</td>
            <td>Name</td>
            <td>ID</td>
            <td>Attendance %</td>

          </tr>
          <?php
          $classid=$_SESSION['class_id'];
          $query="select roll_num,name,student_id,attend_percent
                  from student where class_id='$classid' order by roll_num";


          $result=mysqli_query($conn,$query);
          if($result===FALSE)
            die(mysqli_error($conn));

          while($row = mysqli_fetch_assoc($result))
          {
          ?>

          <tr>
            <td><?php echo $row['roll_num']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['attend_percent']; ?></td>

          </tr>
          <?php } ?>


        </div>
      </div>
    </body>
    </html>
    <?php } ?>
