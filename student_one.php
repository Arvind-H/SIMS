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
$studentid=$_SESSION['id'];
$query="select name,class_id,email_id,exam_reg,roll_num,attend_percent
        from student
        where student_id='$studentid'";

$result=mysqli_query($conn,$query);
if($result===FALSE)
  die(mysqli_error($conn));
$row=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Home</title>
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


    <div id="mainStudentHome" >

    <?php
    $classid=$row['class_id'];
    $_SESSION['class_id']=$classid;

    $query2="select * from classcode where class_id='$classid'";
    $result2=mysqli_query($conn,$query2);
    if($result2===FALSE)
      die(mysqli_error($conn));

        $classrow=mysqli_fetch_assoc($result2);
        echo 'Name: '."<b>".$row['name']."</b>"."<br/>";
        echo "Roll number: "."<b>".$row['roll_num']."</b>"."<br/>";
        echo "Class:  ".$classrow['dept']."  ".$classrow['year']."year  ".$classrow['section']." -section<br>";
        echo "Exam Reg. number: ".$row['exam_reg']."<br/>";
        echo "Email id: ".$row['email_id']."<br/>";
    ?>
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


    <div id="notifier">
      <a href=""><h3>NOTIFICATIONS</h3></a>
      <?php
      $query1="select * from notification where student_id='$studentid' and flag>0 order by flag";
      $result1=mysqli_query($conn,$query1);
      if($result1===false)
        die(mysqli_error($conn));




        $i=0;
        for($i=0;$i<4;$i++)
        {
          $row1=mysqli_fetch_assoc($result1);
          $type=$row1['type'];
          $query2="select * from message where type='$type'";
          $result2=mysqli_query($conn,$query2);
          if($result2===false)
            die(mysqli_error($conn));

/*-------Update Flag-----*/
        $notifyid=$row1['notify_id'];
          $query3="update notification set flag='flag-1' where notify_id='$notifyid'";
          $result3=mysqli_query($conn,$query3);
          if($result3===false)
            die(mysqli_error($conn));
/*------delete older notifications---*/
        $query4="delete from notification where flag<-3";
        $result4=mysqli_query($conn,$query4);
        if($result4===false)
          die(mysqli_error($conn));


          $row2=mysqli_fetch_assoc($result2);



        ?>
        <a href="<?php echo $row2['href']; ?>"><p><?php echo $row1['subject_id']."-".$row2['msg']; ?></p></a>
        <?php } ?>
    </div>

  </div>
  <div id="footer">

    <p align="center">&copy ARVIND.H and Co.</p>

  </div>
</body>
</html>
<?php } ?>
