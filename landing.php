<?php
include ("session.php");
$username = $_SESSION['login_user'];
 $sql = "SELECT * FROM users WHERE email = '$username'";
 $result = mysqli_query($db,$sql);
 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $level = $row["userlevel"];
 if($level == 1){
	echo "<script type='text/javascript'> document.location = 'studentlanding.php'; </script>";
 }
 if($level == 2){
	echo "<script type='text/javascript'> document.location = 'adminlanding.php'; </script>";
 }
 if($level == 3){
	echo "<script type='text/javascript'> document.location = 'superadminlanding.php'; </script>";
 }
		
?>