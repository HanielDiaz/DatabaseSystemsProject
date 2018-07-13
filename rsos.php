
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
</tr>
<?php
	include('session.php');
$query = "SELECT * FROM rsos"; 
$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result)){ 
$id = $row["adminID"];
$query2 = "SELECT * FROM users WHERE userID ='$id'";
$result2 = mysqli_query($db, $query2);
$row2 = mysqli_fetch_array($result2);
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row['rsoName'] . "</td><td>" . $row['numMembers'] . "</td></tr>";  
}

?>
</table>
</body>
</html>