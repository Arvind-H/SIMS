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
     <!--LOGO for title-->
     <title>Teacher Activities</title>
     <link rel="stylesheet" href="http://localhost/SIMS/styles/theme.css" type="text/css"/>
   </head>
   <body>
     <div id="container">
       <div id="header">
         <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
         <div id="logout">
           <a href="logout.php"><b>Log Out</b></a>
         </div>
       </div><!--end of header-->
       <div></div>


   <?php

   $teacherid=$_SESSION['id'];
$query="select * from querier where teacher_id='$teacherid' and answer=''";
$result=mysqli_query($conn,$query);
if($result===FALSE)
  die(mysqli_error($conn));



while($row=mysqli_fetch_assoc($result))
{
  $studentid=$row['student_id'];
  $query2="select name from student where student_id='$studentid'";
  $result2=mysqli_query($conn,$query2);
  if($result2===FALSE)
    die(mysqli_error($conn));
  $row2=mysqli_fetch_assoc($result2);
  $studentname=$row2['name'];

?>

<div id="q">
<?php echo "Q-".$row['question']."?"; ?><br/>
<?php echo "Topic: ".$row['subject_id']."  assignment number"."-".$row['assign_num']; ?><br/>
<?php echo "Asked by: ".$studentname; ?><br/>

<form method="post" action="teacher_seven.php?q_id=<?php echo $row['q_id']; ?>">
  <textarea name="answer" rows="4" cols="70"></textarea>
    <input type="submit" name="submit" value="Answer">
  </form>
</div>

</body>

<?php
  }
}

?>
</html>
