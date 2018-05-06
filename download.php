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


  $fileid= $_GET['file_id'];
  $query="select * from files where file_id='$fileid'";
  $result=mysqli_query($conn,$query);
  if($result===false)
      die(mysqli_error($conn));

  $rows=mysqli_num_rows($result);
  if($rows==0)
        die("File doesn't exist");
  $row=mysqli_fetch_assoc($result);
  $filename=$row['file_name'];
  $filetype=$row['file_type'];
  $filesize=$row['file_size'];
  $filecontent=$row['file_content'];

  header("Content-type: $filetype");
  header("Content-length: $filesize");
  header("Content-Disposition: attachment; filename=$filename");
  echo $filecontent;




?>
