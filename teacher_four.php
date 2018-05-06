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
<?php

  if(isset($_POST['upload']))//&&isset($_POST['assign_num'])&&isset($_POST['dead_line']))
    {
      if($_POST['assign_num']==""||$_POST['dead_line']==""||!($_FILES['userfile']['size']>0))
      {
        header("Location: teacher_four.php");
        exit;
      }

    echo "size:  ";
    echo $_FILES['userfile']['size'];
    if($_FILES['userfile']['size']>0)
    {


      $filename=$_FILES['userfile']['name'];
      $tempname=$_FILES['userfile']['tmp_name'];
      $filesize=$_FILES['userfile']['size'];
      $filetype=$_FILES['userfile']['type'];



      $fp=fopen($tempname,'r');
      $filecontent=fread($fp,filesize($tempname));
      if(!get_magic_quotes_gpc())
      {
        $filecontent=addslashes($filecontent);
        $filename=addslashes($filename);
      }
      fclose($fp);


      $query1="insert into files(file_name,file_type,file_size,file_content)
                values('$filename','$filetype','$filesize','$filecontent')";

      $result1=mysqli_query($conn,$query1);
      if($result1===false)
          die(mysqli_error($conn));

    $query="select file_id from files order by file_id desc";
    $result=mysqli_query($conn,$query);
    if($result===FALSE)
      die(mysqli_error($conn));
    $row=mysqli_fetch_assoc($result);
    $fileid=$row['file_id'];

    $classid=$_SESSION['class_id'];
    $subjectid=$_SESSION['subject_id'];


    $id=$_SESSION['id'];
    $assignnum=$_POST['assign_num'];

    $deadline=$_POST['dead_line'];
    $message=$_POST['message'];
    $query="insert into assignment(class_id,subject_id,assign_num,dead_line,file_id,message,sent_by)
            values('$classid','$subjectid','$assignnum','$deadline','$fileid','$message','$id')";

    $result=mysqli_query($conn,$query);
    if($result===FALSE)
      die(mysqli_error($conn));

        echo "Assignment sent successfully";
$querysid="select student_id from student where class_id='$classid'";
$resultsid=mysqli_query($conn,$querysid);
if($resultsid===FALSE)
  die(mysqli_error($conn));
while ($rowsid=mysqli_fetch_assoc($resultsid))
{
  $studentid=$rowsid['student_id'];
$queryrem="insert into task_reminder(student_id,task_name,priority,deadline) values('$studentid','$subjectid Assignment- $assignnum',2,'$deadline')";
$resultrem=mysqli_query($conn,$queryrem);
if($resultrem==false)
  die(mysqli_error($conn));

  $querynot="insert into notification(student_id,type,flag,subject_id) values('$studentid','gen',3,'$subjectid')";
  $resultnot=mysqli_query($conn,$querynot);
  if($resultnot==false)
    die(mysqli_error($conn));


}

        header("Location: teacher_four.php?check_assign=1");
        exit;



      //else{
        //die("Not uploaded".mysqli_error($conn));
      //}

    }
  }

    else{
 ?>


   <?php
   $classid=$_SESSION['class_id'];
   $query="select * from classcode where class_id='$classid'";

   $result=mysqli_query($conn,$query);
   if($result===FALSE)
     die(mysqli_error($conn));

   $row=mysqli_fetch_assoc($result);


   ?>
   <div id="class_info" >
     <table>
       <caption>Class</caption>
       <tr>
         <td><?php echo $row['dept']."  ".$row['year']."year  ".$row['section']." -section<br>";?></td>
       </tr>
     </table>
</div>
<?php
if(isset($_GET['check_assign'])){
if($_GET['check_assign']==1)
{
  echo "<br/><b>Assignment Sent successfully</b><br/><br/>";
}
}
?>

 <div id="assignForm">

 <form method="post" action="" enctype="multipart/form-data">

   Assignment Number(1,2,3)*:
   <input type="text" name="assign_num"><br/><br/>

   Message:<br/>
   <textarea name="message" rows="4" cols="60"></textarea><br/><br/>
   Assignment File*:

     <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
     <input type="file" name="userfile">

   <br/><br/>Deadline(yyyy-mm-dd)*:<br/>
   <input type="" name="dead_line"><br/><br/>
   <input type="submit" name="upload" value="Send">
 </form>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><p>* marked fields are Required</p>

</body>
<?php } ?>
</html>
<?php } ?>
