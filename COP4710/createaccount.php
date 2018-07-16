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
	  $psw2 = mysqli_real_escape_string($db,$_POST['psw2']);  
	  $myfname = mysqli_real_escape_string($db,$_POST['fname']); 
	  $mylname = mysqli_real_escape_string($db,$_POST['lname']); 
	  $myemail = mysqli_real_escape_string($db,$_POST['email']); 
	  
	  	  if ($mypassword != $psw2) {
		  printf("Error: Passwords do not match\n");
		  exit();
	  }
		
	  $instance = new Encryptor($mypassword);
	  $mypassword = $instance->encrypt($mypassword); 
	
	  $sql = "SELECT email FROM users WHERE email = '$myemail'";
      $result = mysqli_query($db,$sql);
	  
	  if ($result && mysqli_num_rows($result) > 0) {
		  printf("Error: That email already exists\n");
		  exit();
	  }
	
      $sql = "INSERT INTO users(password, fname, lname, email, userLevel) VALUES ('$mypassword', '$myfname', '$mylname', '$myemail', 1)";
      $result = mysqli_query($db,$sql);
      if (!$result) {
		  printf("Error: %s\n", mysqli_error($db));
		  exit();
	  }
	  
	  else{
		  header("location: home.php");
	  }
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
   }
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="css/large.css" media="screen and (min-width: 1000px)">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src='main.js'></script>
      </head>
  <body class="">
        <div style="margin-top: 10%;"class="CreateAccount CreateAccount-Shadow">
          <form action="" method="post">
           <div class="container">
              <div class="row">
                <div class="col-half">
                  <input type="text" class="form-textbox" placeholder="First Name" name="fname" required>
                  <div class="underline"></div>
                </div>
                <div class="col-half">
                  <input type="text" class="form-textbox" placeholder="Last Name" name="lname" required>
                  <div class="underline"></div>
                </div>
              </div>
              <div class="row">
                <input type="text" class="form-textbox" placeholder="Email" name="email" required>
                <div class="underline"></div>
              </div>
              <div class="row">
               <input type="password" class="form-textbox" placeholder="Password" name="psw" required>
               <div class="underline"></div>
              </div>
              <div class="row col-full">
               <input type="password" class="form-textbox" placeholder="Re-enter Password" name="psw2" required>
               <div class="underline"></div>
              </div>
              <div class="row">
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
              </div>
             <div class="row">
               <div class="col-one-third">
                 <button onclick="Cancel('home.php')" type="button" class="boxshadow CreateAccount-Button">Cancel</button>
               </div>
               <div class="col-one-third" style="float: right;">
                 <button type="submit" style="float: right; margin-right: 12px;" class="boxshadow CreateAccount-Button">Sign Up</button>
               </div>
             </div>
           </div>
          </form> 
        </div>
  </body>
</html>