<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'Alex');
   define('DB_PASSWORD', 'Domovoi1');
   define('DB_DATABASE', 'cop4710');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if (mysqli_connect_error()) {
	   echo mysqli_connect_error();
		die("Could not connect to database");
   }
?>