<?php
include('session.php');
$username = $_SESSION['login_user'];
$query = "SELECT * FROM users WHERE email = '$username'"; 
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();
$mySchool= $row["school"];
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
    $rsoid= mysqli_real_escape_string($db,$_POST['join']); 
	$sql = "SELECT * FROM rsos WHERE rsoID = '$rsoid'";
	$result = mysqli_query($db,$sql);
	$row = $result->fetch_assoc();
	$rso = $row["rsoID"];
	$members = $row["numMembers"];
	$members = $members + 1;
	$sql = "UPDATE rsos SET numMembers='$members'
			WHERE rsoID = '$rsoid'";
    $result = mysqli_query($db,$sql);
	$admin = $row["adminID"];
	
	if($members == 5){
		$sql = "SELECT * FROM USERS WHERE userID = '$admin'";
		$result = mysqli_query($db,$sql);
		$row = $result->fetch_assoc();
		if($row["userlevel"] == 1){
			$sql = "UPDATE users SET userlevel = '2'
			WHERE userID = '$admin'";
			$result = mysqli_query($db,$sql);
		}
	}
	
	$sql = "INSERT INTO rsomembers(rsoID, memberID) VALUES ('$rso', (SELECT userID FROM USERS WHERE email = '$username'))";
	$result = mysqli_query($db,$sql);
	if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }

      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
   }
?>



<html>
<header>
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen, projection">
</header>
<body>
  <a href="landing.php">Back</a>
<table>
<tr>
	<th>Creator</th>
	<th>RSO</th>
	<th>Number of Members</th>
	<th></th>
</tr>
<?php
$query = "SELECT * FROM rsos WHERE schoolID = $mySchool"; 
$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result)){ 
$id = $row["adminID"];
$query2 = "SELECT * FROM users WHERE userID ='$id'";
$result2 = mysqli_query($db, $query2);
$row2 = mysqli_fetch_array($result2);
$thisrso = $row["rsoID"];
$query3 = "SELECT * FROM rsomembers WHERE rsoID = '$thisrso' 
			AND memberID = 
			(SELECT userID FROM USERS WHERE email = '$username')";
$result3 = mysqli_query($db, $query3);
$row3 = mysqli_fetch_array($result3);
if ($result && mysqli_num_rows($result3) > 0) {
	continue;
}			
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row['rsoName'] . "</td><td>" . $row['numMembers'] . "</td>

<form method='post'>
<input type=\"hidden\" name = 'join' value=".$row["rsoID"].">
<td><input type='submit' value='Join'></td>
</form>
</tr>";  
}

?>
</table>
</body>
</html>