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
$assignid=$_GET['assign_id'];
$fileid=$_GET['file_id'];
$classid=$_SESSION['class_id'];

$query="select * from assignment where assign_id='$assignid'";
$result=mysqli_query($conn,$query);
if($result===false)
  die(mysqli_error($conn));
  $row=mysqli_fetch_assoc($result);

  $q2="select * from files where file_id='$fileid'";
  $r2=mysqli_query($conn,$q2);
  if($r2===false)
    die(mysqli_error($conn));

$row2=mysqli_fetch_assoc($r2);


 ?>



      <!DOCTYPE html>
      <html>
      <head>
        <title>Assignment Download</title>
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



    <div id="assignmentInbox">
      Subject: <?php echo $row['subject_id']; ?>
      <br/>
      Assignment-Number: <?php echo $row['assign_num']; ?>
      <br/>
      <?php if($row['message']!=""){ ?>
      Meassage: <br/>
      <?php echo $row['message']; }?>
      <br/><br/>
      <a href="download.php?file_id=<?php echo $row2['file_id']; ?>" >Assignment File:</a><br/>
      <br/>
      Deadline: <?php echo $row['dead_line']; ?><br/>

    </div>
<div id="querier">
<p><b>Querier</b></p>
<form method=post action="student_eleven.php?subject_id=<?php echo $row['subject_id']; ?>&assign_num=<?php echo $row['assign_num']; ?>">
  <textarea name="question" rows="3" cols="70"></textarea>
  <input type="submit" name="ask" value="ASK">
</form>

<?php
$studentid=$_SESSION['id'];
$subjectid=$_SESSION['subject_id'];
$queryy="select * from querier where student_id='$studentid' and subject_id='$subjectid'";
$resultt=mysqli_query($conn,$queryy);
if($resultt===false)
  die(mysqli_error($conn));

  while($roww=mysqli_fetch_assoc($resultt))
  {
    if($roww['answer']!="")
    {
      echo "Q-".$roww['question']."?"."<br/>";
      echo "Ans:-".$roww['answer']."."."<br/>";
      echo "<br/>";
    }
  }

 ?>
</div>

</body>
</html>
<?php } ?>
