<!DOCTYPE html>
<html lang="en">
<head>
<title>Validation Errors</title>
<meta charset="utf-8">

<!-- Style Sheets --> 
<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/styles.css" />

</head>
	<body>
		<?php 
			require_once('validation_functions.php');
			$errors = array();
		?>

		<?php echo form_errors($errors); ?>
	</body>
</html>