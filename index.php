<?php require_once("./includes/session.php"); ?>
<?php require_once("./includes/db_connection.php"); ?>
<?php require_once("./includes/functions.php"); ?>
<?php require_once("./includes/validation_functions.php"); ?>
<?php 
global $connection;

$query = "SELECT * FROM admin_pw";
$result = mysqli_query($connection, $query) or die(mysqli_error());
$row = mysqli_fetch_array($result);

$Admin=$row['password'];
if (isset($_POST['submit'])) 
{
	$FirstName = trim($_REQUEST["FIRST_NAME"]);
	$LastName = trim($_REQUEST["LAST_NAME"]);
	$_REQUEST["LastName"] = "NONO";		//This is to stop people from returning via previous

	$EST = (time() + 7200);
	$timestamp = date("m/d/y : H:i:s", $EST);
	$query = "INSERT INTO log (name,time_stamp) VALUES ('$LastName','$timestamp')";
	mysqli_query($connection, $query)or die(mysqli_error());		//Keep a log in DB of who is logging in

	if ($LastName == $Admin)
	{			//Check for Admin login------------------------------------
		$_SESSION['LAST_NAME'] = $LastName;
		redirect_to("play3.php");	//Go to Admin page
		exit;
	}


	$FirstName = strtoupper($FirstName);	//Needed when names come from user
	$LastName = strtoupper($LastName);
	$_SESSION['FIRST_NAME']=$FirstName;
	$_SESSION['LAST_NAME']=$LastName;

	$_SESSION['bad_login']='NULL';
	$user_id = signin($FirstName, $LastName);			//Signin function
	if ($user_id=="69") 
	{
		$_SESSION['bad_login']= $user_id;			// code to SESSION
		redirect_to("login.php"); //Go back to first page if bad login.
		exit(69);
	} 
	else 
	{
		$_SESSION['user_id'] = $user_id;
	}
}

function signin($FirstName,$LastName)
{
	global $connection;
	$query = "SELECT * FROM players";
	$result = mysqli_query($connection, $query) or die(mysqli_error());

	while($row = mysqli_fetch_array($result))
	{ 
		if (($row['LAST_NAME'] == $LastName) && ($row['FIRST_NAME'] == $FirstName)) 
		{	
			$_SESSION['user_id'] = $row['id'];
			//return $row['id']; 	//Return the id of member
			redirect_to("play1.php");
		}
	}
	return "69";		//Invalid name
}

?>
<!DOCTYPE html>
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

<!--  This prevents the Return Key from submitting the form  -->
<script language="javascript" type="text/javascript">
function stopRKey(evt) {
	var evt  = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if ((evt.keyCode == 13) && (node.type=="text")) { return false; }
}
document.onkeypress = stopRKey;
</script>
</head>

<body onLoad="document.input.FirstName.focus()">
	<div id="bg">
		<div id="login">
			<h1>CR-IFAD LOGIN</h1>
	    	<form action="index.php" method="post" >
	    		<input class="form" type="text" id="FIRST_NAME" name="FIRST_NAME" placeholder="First Name" required="required" maxlength="20" value = "" />
	        	<input class="form" type="text" id="LAST_NAME" name="LAST_NAME" placeholder="Last Name" required="required" maxlength="20" value = "" />
	        	<input type="submit" value="submit" name="submit" class="btn btn-primary btn-block btn-large" />
	    	</form>
	    	<?php echo message(); ?>
	    	<?php echo form_errors($errors); ?>
	    </div>
	</div>
</body>
</html>