
<html>
<header>
</header>
<body>
<?php
	include('session.php');
$query = "SELECT * FROM events"; //You don't need a ; like you do in SQL
$result = mysqli_query($db, $query);

echo "<table>"; // start a table tag in the HTML

while($row = mysqli_fetch_array($result)){ 
$id = $row["myCreator"];
$query2 = "SELECT * FROM users WHERE userID ='$id'";
$result2 = mysqli_query($db, $query2);
$row2 = mysqli_fetch_array($result2);
$fname = $row2["fname"];
$lname = $row2["lname"];
$myCreator = $fname . " " . $lname;
echo "<tr><td>" . $myCreator. "</td><td>" . $row['eventName'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

?>
</body>
</html>