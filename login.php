
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
echo "Connected successfully";


//$database='sims_test';
//$db=mysql_select_db($database) or die("unable to select db" . mysql_error());

/***$query='select * from student where id=1';
$j=1;
$result=mysql_query($query,1,'name');
if(!$result) die('query not exe'.mysql_error());
*
$checkname='JohnWick';
$name=$_POST['password'];

if($name==$checkname)
echo 'Successfully Authenticated';
else {
  echo 'Not Authenticated';
}***/

 ?>
