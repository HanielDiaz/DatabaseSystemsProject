

<html>
	<header>
	</header>
	
	<body>
	<?php
	include('session.php');
	$username = $_SESSION['login_user'];
	$sql = "SELECT * FROM users WHERE email = '$username'";
	$result = mysqli_query($db,$sql);
	$rsoID=$_REQUEST['join'];
	$_SESSION['rsoID'] = $rsoID;
	$sql = "SELECT * FROM rsos WHERE rsoID = '$rsoID'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$rsoName = $row["rsoName"];
	$members = $row["numMembers"];
	$description = $row["description"];
	if (!$result || mysqli_num_rows($result) == 0) {
		echo $_SESSION['login_user'];
	}
	else {
		$sql = "SELECT * FROM users WHERE email='$username'";
		$result = mysqli_query($db,$sql);
		$row = $result->fetch_assoc();
		$fname = $row["fname"];
		echo $rsoName. "<br>";
		echo "Members: ".$members. " <br> Description: <br>".$description;
		echo "<br>
		<form method='post' action='eventCreation.php'>
		<input type=\"hidden\" name = 'join' value=".$rsoID.">
		<td><input type='submit' value='Create Event'></td>
		</form>";
	}
?>
		
	</body>
	
</html>