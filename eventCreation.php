<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include("session.php");
   $username = $_SESSION['login_user'];
	$sql = "SELECT * FROM users WHERE email = '$username'";
	$result = mysqli_query($db,$sql);
	if (!$result || mysqli_num_rows($result) == 0) {
		echo $_SESSION['login_user'];
	}
	else {
		$sql = "SELECT * FROM users WHERE email='$username'";
		$result = mysqli_query($db,$sql);
		$row = $result->fetch_assoc();
		$mycreator = $row["userID"];
	}
	
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
	  $eventName = mysqli_real_escape_string($db,$_POST['eventName']); 
	  $category = mysqli_real_escape_string($db,$_POST['category']); 
	  $description = mysqli_real_escape_string($db,$_POST['description']); 
	  $time = mysqli_real_escape_string($db,$_POST['time']); 
	  $date = mysqli_real_escape_string($db,$_POST['date']); 
	  $location = mysqli_real_escape_string($db,$_POST['location']);
	  $phone = mysqli_real_escape_string($db,$_POST['phone']); 
	  $email = mysqli_real_escape_string($db,$_POST['email']); 
 
      $sql = "INSERT INTO events(myCreator, eventName, eventCategory, description, startTime, startDate, location, phoneNumber, email) VALUES ('$mycreator', '$eventName', '$category', '$description', '$time', '$date', '$location', '$phone', '$email')";
      $result = mysqli_query($db,$sql);
      if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
	  
	  else{
		  header("location: landing.php");
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
                <input type="text" class="form-textbox" placeholder="Event Name" name="eventName" required>
                <div class="underline"></div>
              </div>
              <div class="row">
                <input type="text" class="form-textbox" placeholder="Category" name="category" required>
                <div class="underline"></div>
              </div>
              <div class="row">
               <input type="text" class="form-textbox" placeholder="Description" name="description" required>
               <div class="underline"></div>
              </div>
              <div class="row col-full">
               <input type="text" class="form-textbox" placeholder="Start Date" name="date" required>
               <div class="underline"></div>
              </div>
			  <div class="row col-full">
               <input type="text" class="form-textbox" placeholder="Start Time" name="time" required>
               <div class="underline"></div>
              </div>
			  <div class="row col-full">
               <input type="text" class="form-textbox" placeholder="Location" name="location" required>
               <div class="underline"></div>
              </div>
			  <div class="row col-full">
               <input type="text" class="form-textbox" placeholder="Contact Phone Number" name="phone" required>
               <div class="underline"></div>
              </div>
			  <div class="row col-full">
               <input type="text" class="form-textbox" placeholder="Contact Email" name="email" required>
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