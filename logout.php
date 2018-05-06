<?php
session_start();
//if($_SESSION['person']=='Teacher')

session_unset();
session_destroy();

header("Location: sims_login.php");
exit;

 ?>
