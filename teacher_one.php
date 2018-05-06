<?php
session_start();


if(!($_SESSION['auth']===true&&$_SESSION['person']=='Teacher'))
{
  header("Location: sims_login.php");
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
   <title>Home Teacher</title>
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
 <?php
$id= $_SESSION['id'];
$query="select * from teacher_class_subject where teacher_id='$id'";
$result=mysqli_query($conn,$query);
if($result===FALSE)
  die(mysqli_error($conn)());

 ?>
     <div id="tableTeacherOne">
       <table border="1" width="300px" height="100px">
           <caption>CLASSES&nbspTEACHING</caption>
         <tr>
           <td>CLASS</td>
           <td>SUBJECT</td>
         </tr>
         <!--GET values from DB-->
         <?php while($row = mysqli_fetch_assoc($result)){ ?>
           <tr>
           <td><a href="teacher_two.php?class_id=<?php echo $row['class_id'];?>&subject_id=<?php echo $row['subject_id'];?>"><?php echo $row['class_id']; ?></a></td>
           <td><?php echo $row['subject_id']; ?></td>
          </tr>
          <?php } ?>

       </table>
     </div>
     </div>
     <div id="footer">
       <br/>
       <p align="center">&copy ARVIND.H and Co.</p>
       <br/>
     </div>
     </body>
     </html>
     <?php } ?>
