<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include("Config.php");
   session_start();
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $sname = mysqli_real_escape_string($db,$_POST['sname']); 
	  $location = mysqli_real_escape_string($db,$_POST['location']); 
	  $description = mysqli_real_escape_string($db,$_POST['description']); 
	  $numstudents = mysqli_real_escape_string($db,$_POST['numstudents']); 
	
	$sql = "SELECT sname FROM schools WHERE email = '$sname'";
		  $result = mysqli_query($db,$sql);
	if ($result && mysqli_num_rows($result) > 0) {
		printf("Error: That school already exists\n");
		exit();
	}
      $sql = "INSERT INTO schools(name, location, description, numStudents) VALUES ('$sname', '$location', '$description', '$numstudents')";
      $result = mysqli_query($db,$sql);
      if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
	  else{
		  $username = $_SESSION['login_user'];
		  $sql2 = "SELECT * FROM users WHERE email = '$username'";
		  $result2 = mysqli_query($db, $sql2);
		  $row = $result2->fetch_assoc();
		  $id = $row["userID"];
		  $sql = "UPDATE users SET school=
			(SELECT schoolID from schools WHERE name = '$sname')
			WHERE userID = '$id'";
		  $result = mysqli_query($db,$sql);
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
                <input type="text" class="form-textbox" placeholder="RSO Name" name="rsoName" required>
                <div class="underline"></div>
              </div>
              <div class="row">
               <textarea class="form-descriptionbox" placeholder="Description" name="description" required></textarea>
               <div class="underline"></div>
              </div>
             <div class="row">
               <div class="col-one-third">
                 <button onclick="Cancel('landing.php')" type="button" class="boxshadow CreateAccount-Button">Cancel</button>
               </div>
               <div class="col-one-third" style="float: right;">
                 <button type="submit" style="float: right; margin-right: 12px;" class="boxshadow CreateAccount-Button">Create Event</button>
               </div>
             </div>
           </div>
          </form> 
        </div>
  </body>
</html>