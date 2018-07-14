
<html>
<header>
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen, projection">
</header>
<body>

<div class="topnav">
  <a class="active" href="events.php">Events at my School</a>
  <a href="rsoevents.php">Events from my RSOs</a>
  <a href="landing.php">Back</a>
</div>

<?php
include('session.php');
$username = $_SESSION['login_user'];
$sql = "SELECT * FROM users WHERE email = '$username'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$school = $row["school"];
$query = "SELECT * FROM events WHERE mySchool = '$school'"; 
$result = mysqli_query($db, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
	  }
echo "<table>"; 

while($row = mysqli_fetch_array($result)){ 
$id = $row["myCreator"];
$rsoid = $row["myRSO"];
$query2 = "SELECT * FROM users WHERE userID ='$id'";
$result2 = mysqli_query($db, $query2);
$row2 = mysqli_fetch_array($result2);
$query3 = "SELECT * FROM rsos WHERE rsoID ='$rsoid'";
$result3 = mysqli_query($db, $query3);
$row3 = mysqli_fetch_array($result3);
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row3['rsoName'] . "</td><td>" . $row['eventName'] . "</td>";  //$row['index'] the index here is a field name

echo"<form method='post' action='rsopage.php'>
<input type=\"hidden\" name = 'eventID' value=".$row["eventID"].">
<td><input type='submit' value='View'></td>
</form></tr>";
}

echo "</table>"; //Close the table in HTML

?>
</body>
</html>