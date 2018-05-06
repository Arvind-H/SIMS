<?php

session_start();
//error_reporting(0);
if($_SESSION['auth']===true)
{
  if($_SESSION['person']=='Teacher')
  {
    header("Location: teacher_one.php");
    exit;
  }
  elseif($_SESSION['person']=='Student')
  {
    header("Location: student_one.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login to SIMS</title>
  <link rel="stylesheet" href="http://localhost/SIMS/styles/bootstrap.css" type="text/css">
  <link rel="stylesheet"  href="http://localhost/SIMS/styles/theme.css" type="text/css">

</head>
<body>
<?php

if(isset($_POST['userid'])&&isset($_POST['password'])){

  $userid=$_POST['userid'];
  $pwd=$_POST['password'];
  $person=$_POST['person'];
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
  if($person=='Student'){
    $query="select * from student where student_id='$userid' and password='$pwd'";
  }
  else{
    $query="select * from teacher where teacher_id='$userid' and password='$pwd'";
  }

  $result=mysqli_query($conn,$query);
  if($result===FALSE)
    die(mysqli_error($conn));
  $rows=mysqli_num_rows($result);
  if($rows==1){
    $_SESSION['auth']=true;
    $_SESSION['id']=$userid;
    $_SESSION['person']=$person;
    echo "succesfully authenticated<br/>";
    if($person=='Student'){
      header("Location: student_one.php");
      exit;
    }
    if($person=='Teacher'){
      header("Location: teacher_one.php");
      exit;
    }
  }
  else{
    echo ("Invalid Credentials");
  }
}

else{

  ?>


  <div id="container" >
    <!--header start-->
    <div id="header" >
      <div id="logo">
        <img src="images\atom.png" height=70px width=150px  alt="logo here"/>
      </div>
      <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
    </div><!--end of header-->

    <div id="loginForm">
      <p></p>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" ><br/>
        <b>username</b>
        <input type="text" name="userid" value="UserID"><br><br><br/>
        <b>password</b>
        <input type="password" name="password" ><br><br>
        <input type="radio" name="person" value="Teacher">Teacher
        <input type="radio" name="person" value="Student">Student<br/>
        <br/>
        <input type="submit" value="sign in">
      </form>

    </div>
  </div>
    <div id="footer">
      <br/>
      <p align="center">&copy Reserved</p>
      <br/>
    </div>
  </body>
  <?php } ?>
  </html>
