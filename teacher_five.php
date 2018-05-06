
<?php session_start();
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
if(isset($_POST['submit']))
{
  $classid=$_SESSION['class_id'];
  $subjectid=$_SESSION['subject_id'];
  if(isset($_POST['absentees']))
  {
$rollnumber=$_POST['absentees'];
$query="select student_id from student where class_id='$classid' and roll_num='$rollnumber'";
$result=mysqli_query($conn,$query);
if($result===false){
  die(mysqli_error($conn));
}
$row=mysqli_fetch_assoc($result);
$studentid=$row['student_id'];

$query2="select * from class_subject_num where class_id='$classid'";
$result2=mysqli_query($conn,$query2);
if($result2===false)
    die(mysqli_error($conn));

    $row2=mysqli_fetch_assoc($result2);
    if($subjectid==$row2['subject_one'])
    {
      $subject_num="subject_one";
    }
    elseif($subjectid==$row2['subject_two'])
    {
      $subject_num="subject_two";
    }
    elseif($subjectid==$row2['subject_three'])
    {
      $subject_num="subject_three";
    }
    elseif($subjectid==$row2['subject_four'])
    {
      $subject_num="subject_four";
    }
    elseif($subjectid==$row2['subject_five'])
    {
      $subject_num="subject_five";
    }
    elseif($subjectid==$row2['subject_six'])
    {
      $subject_num="subject_six";
    }

    $query3="select $subject_num from student_attendance where student_id='$studentid'";
    $result3=mysqli_query($conn,$query3);
    if($result3===false)
      die(mysqli_error($conn));

      $row3=mysqli_fetch_assoc($result3);
      $num=$row3[$subject_num];

      $num=$num-1;

      $query4="update student_attendance set $subject_num='$num' where student_id='$studentid'";
      $result4=mysqli_query($conn,$query4);
      if($result4===false)
        die(mysqli_error($conn));

        $query5="insert into attendance_transaction(student_id,subject_id,date) values('$studentid','$subjectid',CURDATE())";
        $result5=mysqli_query($conn,$query5);
        if($result5===false)
          die(mysqli_error($conn));




        echo "Attendance Updated successfully<br/>";
        header("Location: teacher_five.php?check=1");


  }

}
else{





?>

<!DOCTYPE html>
<head>
  <title>Enter Attendance</title>
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

    <body>
<?php
if(isset($_GET['check'])){
$check=$_GET['check'];
if($check==1)
        echo "Updated Successfully<br/><br/>";
else if($check==2)
 echo " Sorry, Cannot Update";
}
?>

      <div id="enterAttendance">
        <form method="post" action ="">
          Enter Absentees:<br/><br/>
          <input type="text" name="absentees"><br/><br/><br/>
          <input type="submit" name="submit" value="UPDATE">
        </form>
      </div>
    </body>
    </html>


  <?php
 }
}
?>
