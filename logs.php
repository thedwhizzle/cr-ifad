<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>LOGS</title>
</head>
<body>
<?php
//--------------------------------------------
function connectDB()
{
if ($_SERVER['HTTP_HOST']=='localhost'){
$username="root";			
$password="root";			//Local DB
$database="crifadne_golfers";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database");

} else {
$username="crifadne_larry";			
$password="larry1";			//Host DB
$database="crifadne_golfers";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database");
}
}



//--------------------------------------------

//--------------------------------------------------------

 connectDB();
$result = mysql_query("SELECT * FROM log ORDER BY time_stamp DESC") or die(mysql_error());
//$row = mysql_fetch_array($result);
//echo "Log size is: ".$row['id'];
for ($i=1;$i <=25;$i++) {
$row = mysql_fetch_array($result);
echo "<pre>";
printf("%-15s%20s\n" ,$row['name'],$row['time_stamp']);
echo "</pre>";
}
echo "Finished";


?>
</body>
</html>