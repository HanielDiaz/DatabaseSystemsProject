
<html>
<header>
<link rel="stylesheet" type="text/css" href="css/table.css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen, projection">
</header>
<body>

<div class="topnav">
  <a href="events.php">Events at my School</a>
  <a class="active" href="rsoevents.php">Events from my RSOs</a>
  <a href="landing.php">Back</a>
</div>

<?php
include('session.php');
$username = $_SESSION['login_user'];
$sql = "SELECT * FROM users WHERE email = '$username'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$myid = $row["userID"];
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
$query4 = "SELECT * FROM rsomembers WHERE rsoID ='$rsoid' AND memberID = '$myid'";
$result4 = mysqli_query($db, $query4);
$row4 = mysqli_fetch_array($result4);
if ($result && mysqli_num_rows($result4) < 1) {
	continue;
}	
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row3['rsoName'] . "</td><td>" . $row['eventName'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

?>
</body>
</html>