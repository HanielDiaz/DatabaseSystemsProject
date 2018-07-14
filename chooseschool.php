<?php
include ('session.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$username = $_SESSION['login_user'];
$sql = "SELECT * FROM users WHERE email = '$username'";
$result = mysqli_query($db,$sql);
$row = $result->fetch_assoc();
$userID = $row["userID"];
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$school = mysqli_real_escape_string($db,$_POST['name']); 
	$sql = "UPDATE users SET school='$school'
			WHERE userID = '$userID'";
	$result = mysqli_query($db,$sql);
	if (!$result) {
	printf($school);
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
	header("location: landing.php");
	  
}
?>


<html>
<header>
</header>
<body>
<form method="post">
<?php

$sql = "SELECT * FROM schools"; 
$filter = mysqli_query($db, $sql);

echo "<select name='name'>";
while ($row = mysqli_fetch_array($filter, MYSQLI_ASSOC)) {
    echo "<option value='" . $row['schoolID'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";
 
?>
<input type="submit" value="Submit">
</form>
</body>
</html>