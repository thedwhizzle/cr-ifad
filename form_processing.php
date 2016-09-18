<html lang="en">
<head>
<title>cr-ifad.net</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Style Sheets --> 
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/styles.css" />
</head>

<body>

<pre>
	<?php
		print_r($_POST);
	?>
</pre>
</br>

<?php 
	if (isset($_POST['submit'])) 
	{
		echo "form was submitted</br>";
		if (isset($_POST["FirstName"])) 
		{
			$FirstName = $_POST["FirstName"];
		} 
		else 
		{
			$FirstName= "";
		}

		if (isset($_POST["LastName"])) 
		{
			$FirstName = $_POST["LastName"];
		}
		else 
		{
			$LastName= "";
		}

		// set default values
		$FirstName = isset($_POST['FirstName']) ? $_POST['FirstName'] : "";
		$LastName = isset($_POST['LastName']) ? $_POST['LastName'] : "";
	}
	else 
	{
		$FirstName = "";
		$LastName = "";
	}
	
?>

<?php 
	echo"{$FirstName}: {$LastName}";
?>

</body>
</html>