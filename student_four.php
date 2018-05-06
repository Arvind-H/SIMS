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

<!--
<p>Sort BY:</p>
<form method="get" action="">
  <select name="sort">
  <option value="Dead Line" selected>Dead Line</option>
  <option value="Priority" >Priority</option>
  <option value="Task Name" >Task Name</option>
</select>
<input type="submit" name="sortby" value="order">
</form>
-->



    <div id="reminderTop">
      <table border="2px solid red" align="center" width="100%" >
        <caption><b>Task-Reminder</b></caption>.

        <tr>
          <td>Sno</td>
          <td>  TASK  </td>
          <td>Deadline</td>
          <td>Priority</td>
          <td></td>
          <td></td>

          </tr>
<?php
$studentid=$_SESSION['id'];
$sort='deadline';
if(isset($_GET['sortby']))
{
  $sort=$_GET['sort'];
}
$query="select * from task_reminder where student_id='$studentid' and task_status=0 order by deadline";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error($conn));

$i=1;
while($row=mysqli_fetch_assoc($result))
{
  ?>
  <tr>
    <td><?php echo $i; $i++; ?> </td>
    <td><?php echo $row['task_name']; ?></td>

    <td><?php echo $row['deadline']; ?></td>
    <td><?php $k=$row['priority'];
          if($k==1) echo "High";
          elseif($k==2) echo "Medium";
          elseif($k==3) echo "Low";
          ?>
    </td>
    <td><a href="student_nine.php?id=<?php echo $row['task_id']; ?>"<p>finish</p></a></td>
    <td><a href="student_ten.php?id=<?php echo $row['task_id']; ?>"><p>Delete</p></a></td>
  </tr>

  <?php } ?>

<tr><td><a href="student_seven.php">Add Task</a></td></tr>

      </table>
</div>



    <div id="reminderBottom">
      <table border="2px solid red" align="center" >
        <caption><b>Completed Tasks</b></caption>.

        <tr>
          <td>Sno</td>
          <td>  TASK  </td>
          <td>Completed Date</td>
          <!--<td>Remark</td>-->

          </tr>

          <?php
          $studentid=$_SESSION['id'];
          $query="select * from task_reminder where student_id='$studentid' and task_status=1 order by deadline desc";
          $result=mysqli_query($conn,$query);
          if($result===false)
            die(mysqli_error($conn));
            $j=1;
          while($row=mysqli_fetch_assoc($result))
          {
            ?>
            <tr>
              <td><?php echo $j; $j++; ?> </td>
              <td><?php echo $row['task_name']; ?></td>
              <td><?php echo $row['finish_date']; ?>
              </td>
              <!--<td><?php /* $k= $row['remark'];
                    if($k==1) echo "IN Time ";
                    elseif($k==0) echo "Not IN Time"; */ ?>
                  </td>
                -->

              <td><a href="student_ten.php?id=<?php echo $row['task_id']; ?>"><p>Delete</p></a></td>
            </tr>

            <?php } ?>

      </table>
    </div>
  </div>
</body>
</html>
<?php } ?>
