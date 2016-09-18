<?php 
// 1. Create database connection
	$dbhost = "localhost";
	$dbuser = "root";			
	$dbpass = "root";			
	$dbname = "crifadne_golfers";
	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
// Test if connnection occured.
	if(mysqli_connect_errno()) 
	{
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ") "
		);
	}
?>

<?php 
// 2. Perform database query
$query = "SELECT * FROM players";
$result = mysqli_query($connection, $query);
// Test if there was a query error
if (!$result) 
	{
		die("Database query failed.");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>databases</title>
<meta charset="utf-8">
</head>
<body>

	<?php
		// 3. Use returned data (if any)
		while($row = mysqli_fetch_assoc($result)) 
		{
			echo $row["LAST_NAME"] . "<br />";
		}
	?>

	<?php 
		// 4. Release returned data
		mysqli_free_result($result);
	?>

</body>
</html>

<?php 
	// 5. Close database connection
	mysqli_close($connection);
?>