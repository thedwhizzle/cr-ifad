<?php 
// 1. Create database connection
	$dbhost = "localhost";
	$dbuser = "crifadne_larry";			
	$dbpass = "larry1";			
	$dbname = "crifadne_golfers";
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
// Test if connnection occured.
	if(mysqli_connect_error()) 
	{
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ") "
		);
	}
?>