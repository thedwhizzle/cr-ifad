<?php



//--------------------------------------------
function connectDB()
{
if ($_SERVER['HTTP_HOST']=='localhost'){
$username="root";			
$password="larry1";			//Local DB
$database="golfers";
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
$EST= (time() +7200);
$timestamp = date("m/d/y : H:i:s", $EST);
$Lname = "zeitgeist";

connectDB();

mysql_query("INSERT INTO log (name,time_stamp)
VALUES ('$Lname','$timestamp')")or die(mysql_error());		
?>