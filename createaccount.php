<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include("Config.php");
   include('encryption.php');
   session_start();
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
	  $myfname = mysqli_real_escape_string($db,$_POST['fname']); 
	  $mylname = mysqli_real_escape_string($db,$_POST['lname']); 
	  $myemail = mysqli_real_escape_string($db,$_POST['email']); 
	  
	  $instance = new Encryptor($mypassword);
	$mypassword = $instance->encrypt($mypassword); 
	
$sql = "SELECT email FROM users WHERE email = '$myemail'";
      $result = mysqli_query($db,$sql);
if ($result && mysqli_num_rows($result) > 0) {
    printf("Error: That email already exists\n");
    exit();
}
      $sql = "INSERT INTO users(password, fname, lname, email) VALUES ('$mypassword', '$myfname', '$mylname', '$myemail')";
      $result = mysqli_query($db,$sql);
      if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
   }
?>