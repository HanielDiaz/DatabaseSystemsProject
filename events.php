
<html>
<header>
</header>
<body>
<?php
	include('session.php');
$query = "SELECT * FROM events"; //You don't need a ; like you do in SQL
$result = mysqli_query($db, $query);

echo "<table>"; // start a table tag in the HTML

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['myCreator'] . "</td><td>" . $row['eventName'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

?>
</body>
</html>