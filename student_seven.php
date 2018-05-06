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
  <!-- Add Reminder -->
  <title>Reminder Student </title>
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




<?php

if(isset($_POST['add'])&&isset($_POST['task_name'])&&isset($_POST['priority'])&&isset($_POST['deadline']))
{
  $studentid=$_SESSION['id'];
  $taskname=$_POST['task_name'];
  $priority=$_POST['priority'];
  $deadline=$_POST['deadline'];
  if($studentid==""||$taskname==""||$priority==""||$deadline=="")
  {
    echo "All fields are Required!";
    header("Location: student_seven.php");
    exit;
  }


  $query="insert into task_reminder(student_id,task_name,priority,deadline)
          values('$studentid','$taskname','$priority','$deadline')";
  $result=mysqli_query($conn,$query);
  if($result===false)
    die("Cannot Add Task".mysqli_error($conn));

    echo "successfully Added";
    header("Location: student_four.php");
    exit;
}
else{

?>


  <div id="">
    <form method="post" action="">
      Task:*<br/>
      <textarea name="task_name" rows="4" cols="60"></textarea><br/><br/>
      <select name="priority">
        <option value="1">HIGH</option>
        <option value="2" selected>MEDIUM</option>
        <option value="3">LOW</option>
      </select><br/><br/>
      Dead Line:*<br/>
      <input type="text" name="deadline"><br/><br/>
      <input type="submit" value="ADD" name="add">
    </form>
  </div>
</body>
<?php } ?>
</html>
<?php } ?>
