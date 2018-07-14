<?php
	include('session.php');
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
		$fname = $row["fname"];
		if($fname==""){
			echo $_SESSION['login_user'];
		}
		else{
			echo "Welcome back, ";
			echo $fname;
		}
	}
?>

<html>
	<header>
		
	<body>
		
		<div class="navigationbar2">
		<br>
		
		<div class="navigationbar">

			<nav class="menu">
			
				<a class="menutab" style="color: black;" href="events.php">Events</a><br>
				<a class="menutab" style="color: black" href="accountEdit.php">Edit Account</a><br>
				<a class="menutab" style="color: black" href="new_RSO.php">Create a new RSO</a><br>
				<a class="menutab" style="color: black" href="rsos.php">Find New RSOs</a><br>
				<a class="menutab" style="color: black" href="logout.php">Logout</a>
			
			</nav>
		</div>
		</div>
			
	</header>
		
	</body>
	
</html>