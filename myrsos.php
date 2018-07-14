<?php
include('session.php');
$username = $_SESSION['login_user'];
$sql = "SELECT * FROM USERS WHERE userID = '$username'";
$result = mysqli_query($db,$sql);
$row = $result->fetch_assoc();
$myid = $row["userID"];
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>



<html>
<header>
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen, projection">
</header>
<body>

<table>
<tr>
	<th>Creator</th>
	<th>RSO</th>
	<th>Number of Members</th>
	<th></th>
</tr>
<?php
$query = "SELECT * FROM rsos"; 
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
if ($result && mysqli_num_rows($result3) < 1) {
	continue;
}			
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row['rsoName'] . "</td><td>" . $row['numMembers'] . "</td>

<form method='post' action='rsopage.php'>
<input type=\"hidden\" name = 'join' value=".$row["rsoID"].">
<td><input type='submit' value='View'></td>
</form>
</tr>";  
}

?>
</table>
</body>
</html>