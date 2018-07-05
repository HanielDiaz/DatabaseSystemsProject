<?php
   include("config.php");
   include('encryption.php');
   ini_set('display_errors', '1');
   session_start();
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
      $instance = new Encryptor($mypassword);
	$mypassword = $instance->encrypt($mypassword); 
      //this line pulls from the database
      $sql = "SELECT email FROM users WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
	  if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	  if(isset($row['active'])){
		$active = $row['active'];
	  }
      
      $count = mysqli_num_rows($result);//searches user name entered
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {//count is how many of that user name is in the database
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         header("location: map.html");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="css/large.css" media="screen and (min-width: 1000px)">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script src='main.js'></script>
  </head>
  <body class="max-width">
    <div class="header max-width boxshadow">
      <div>
      </div>
    </div>
    <div class="greeting">
      <div class="title">
          <form action="" method="post">
            <div class="row">
             <input type="text" class="form-textbox" placeholder="Email" name="email">
             <div class="underline"></div>
            </div>
            <div class="row">
             <input type="password" class="form-textbox" placeholder="Password" name="psw">
              <div class="underline"></div>
            </div>
            <div class="row">
             <button  class="boxshadow" type="submit">Login</button>
             <label>
               <input type="checkbox" checked="checked" name="remember"> Remember me
             </label>
           </div>
             <div class="row">           
                <span style="float:none" class="forgotPsw-home col-half"><a href="#">Forgot password?</a></span>
                <a style="float:none" href="CreateAccount.php" class="CreateAccount-home col-half">Create Account</a>
             </div>
          </form> 
      </div>
      <!-- <img src="http://placekitten.com/1450/1250" class="backgroundimg"> -->
	   <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
    </div>
      <footer>
      </footer>
  </body>
</html>