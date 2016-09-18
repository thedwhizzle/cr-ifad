
<?php
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
//---------------------------------------------------------
//Now shift the tables around--------------------------------
connectDB();
mysql_query("TRUNCATE TABLE players");
mysql_query("INSERT INTO players SELECT * FROM players1");	//Shift tables forward one week
mysql_query("TRUNCATE TABLE players1");
mysql_query("INSERT INTO players1 SELECT * FROM players2");
mysql_query("TRUNCATE TABLE players2");
mysql_query("INSERT INTO players2 SELECT * FROM players3");
mysql_query("TRUNCATE TABLE course");
mysql_query("INSERT INTO course SELECT * FROM course1");
mysql_query("TRUNCATE TABLE course1");
mysql_query("INSERT INTO course1 SELECT * FROM course2");
mysql_query("TRUNCATE TABLE course2");
mysql_query("INSERT INTO course2 SELECT * FROM course3");
mysql_query("TRUNCATE TABLE teetime");
mysql_query("INSERT INTO teetime SELECT * FROM teetime1");
mysql_query("TRUNCATE TABLE teetime1");
mysql_query("INSERT INTO teetime1 SELECT * FROM teetime2");
mysql_query("TRUNCATE TABLE teetime2");
mysql_query("INSERT INTO teetime2 SELECT * FROM teetime3");
mysql_query("TRUNCATE TABLE log");  //Clear the log table 



		
//rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr


?>
		