<?php
session_start(); ?>
<?php
$server="localhost";
$username="root";
$password="root";
$conn=mysql_connect($server,$username,$password) or die("unable to connect to database".mysql_error());
$database="sample";
$db=mysql_select_db($database) or die("unable to select Database".mysql_error());

$classid=$_GET['classid'];

echo "CLASS ID::".$classid;
 ?>
