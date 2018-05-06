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
if(isset($_POST['upload'])&&($_FILES['userfile']['size']>0))
{
  $filename=$_FILES['userfile']['name'];
  $tempname=$_FILES['userfile']['tmp_name'];
  $filesize=$_FILES['userfile']['size'];
  $filetype=$_FILES['userfile']['type'];



  $fp=fopen($tempname,'r');
  $filecontent=fread($fp,filesize($tempname));
  if(!get_magic_quotes_gpc()){
    $filecontent=addslashes($filecontent);
    $filename=addslashes($filename);
  }
  fclose($fp);


  $query="insert into files(file_name,file_type,file_size,file_content)".
          "values('$filename','$filetype','$filesize','$filecontent')";

  $result=mysqli_query($conn,$query);
  if($result===false)
      die(mysqli_error($conn));
      echo "Uploaded.";
}
 ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Attendance Student </title>
    <link rel="stylesheet" href="http://localhost/SIMS/styles/theme.css" type="text/css" />

  </head>
  <body>
    <div id="container">
      <div id="header">

        <h1 id="headerTitle"><strong>STUDENT  INFORMATION  MANAGEMENT  SYSTEM</strong></h1>
      </div><!--end of header-->

      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <input type="file" name="userfile">
        <input type="submit" name="upload" value="send">
      </form>

      <div id="footer">

        <p align="center">&copy ARVIND.H and Co.</p>

      </div>
    </body>
    </html>
