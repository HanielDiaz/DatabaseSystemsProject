<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    include("session.php");
    $username = $_SESSION['login_user'];
   	$eventID=$_SESSION['eventID'];
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
		$school = $row["school"];
	}
	
   $error = " ";
   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Send"])) {
	$comment = mysqli_real_escape_string($db,$_POST['comment']); 
	$sql = "INSERT INTO COMMENTS(commenterID, eventID, commentText) VALUES ('$mycreator', '$eventID', '$comment')";
	$result = mysqli_query($db,$sql);
   }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove"])) {
	$comment = mysqli_real_escape_string($db,$_POST['remove']); 
	$sql = "DELETE FROM comments WHERE commentID = '$comment'";
	$result = mysqli_query($db,$sql);
   }
   
   if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
?>
<html>
	<header>
	</header>
	
	<body>
<?php
	$sql = "SELECT * FROM events WHERE eventID = '$eventID'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$eventName = $row["eventName"];
	$email = $row["email"];
	$description = $row["description"];
	if (!$result || mysqli_num_rows($result) == 0) {
		echo $_SESSION['login_user'];
	}
	else {
		$sql = "SELECT * FROM users WHERE email='$username'";
		$result = mysqli_query($db,$sql);
		$row = $result->fetch_assoc();
		$fname = $row["fname"];
		echo $eventName. "<br>";
		echo "Email: ".$email. " <br> Description: <br>".$description;
		echo "<br>
		<form method='post' action=''>
		<input type=\"hidden\" name = 'send' value=".$eventID.">
		Comment: <br><textarea name='comment'></textarea><br/>
		<input type='submit' value='Send'>
		</form>";
	}
	
	$query = "SELECT * FROM comments WHERE eventID = '$eventID'"; 
	$result = mysqli_query($db, $query);

	while($row = mysqli_fetch_array($result)){ 
		$id = $row["commenterID"];
		$commentid = $row["commentID"];
		$currComment = $row["commentText"];
		$query2 = "SELECT * FROM users WHERE userID ='$id'";
		$result2 = mysqli_query($db, $query2);
		$row2 = mysqli_fetch_array($result2);
		$fname = $row2["fname"];
		$lname = $row2["lname"];
		$commenterName = $fname . " " . $lname;
		echo $commenterName. ":<br>
			<input type='textarea' name='comment' value='".$currComment."' readonly><br>
			<br>";
		if($id == $mycreator){
			echo "<form method='post' action=''>
			<input type=\"hidden\" name = 'remove' value=".$commentid.">
			<input type='submit' value='Remove'>
		</form>";
		}
	}
?>
		
	</body>
	
</html>