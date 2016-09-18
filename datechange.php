

<?php
function connectDB()
{
if ($_SERVER['HTTP_HOST']=='localhost'){
$username="root";			
$password="larry1";			//Local DB
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
$oneDay=86400;
$twoDay=172800;
$threeDay=259200;
$oneWeek=604800;
$Ts=0;
$today= date("D");
if ($today=="Fri") {		//for testing		//This got to be fixed for the long run

connectDB();

$result = mysql_query("SELECT * FROM date_change_ts") or die(mysql_error());
$row = mysql_fetch_array($result);
$Ts= $row['date_change_ts'];
$Ts1 = $Ts+$oneWeek;		
if ($Ts1 < strtotime("now")){
$D= strtotime("next Monday");
$D0= date("m/d", $D);		//Format month and day for Mon
$D= $D +$twoDay;
$D1= date("m/d", $D);		//Same for Wed
$D= $D +$twoDay;		// Same for Fri
$D2= date("m/d", $D);

mysql_query("UPDATE play_date SET	
day1='$D0', day2='$D0',day3='$D1',day4='$D2'");//Update next weeks dates

//One week-----------------------------------
$D= $D + $threeDay;		// Do 2nd week
$D10 =date("m/d",$D);
$D= $D +$twoDay;
$D11= date("m/d", $D);
$D= $D +$twoDay;
$D12= date("m/d", $D);

mysql_query("UPDATE nxt_play_date SET
day1='$D10', day2='$D10',day3='$D11',day4='$D12'");//Update 2nd weeks dates
//Two week---------------------------------------
$D= $D + $threeDay;		//Do 3rd week
$D20 =date("m/d",$D);
$D= $D +$twoDay;
$D21= date("m/d", $D);
$D= $D +$twoDay;
$D22= date("m/d", $D);

mysql_query("UPDATE play_date2 SET
 day1='$D20',day2='$D20',day3='$D21',day4='$D22'");//Update 3rd weeks dates
//Three week--------------------------------------------
$D= $D + $threeDay;		//Do 4th week
$D30 =date("m/d",$D);
$D= $D +$twoDay;
$D31= date("m/d", $D);
$D= $D +$twoDay;
$D32= date("m/d", $D);

mysql_query("UPDATE play_date3 SET
day1='$D30', day2='$D30',day3='$D31',day4='$D32'");//Update 4th weeks dates

//Now shift the tables around--------------------------------
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
mysql_query("TRUNCATE TABLE log");
$Today= strtotime("today");	//Today must be Fri if we are here
$Today= ($Today + 28000);	// Make it  8am Fri svr 2hrs behind
mysql_query("UPDATE date_change_ts SET date_change_ts='$Today'");	

$EST= (time() +7200);
$timestamp = date("m/d/y : H:i:s", $EST);
$Lname = "cron_run";

connectDB();

mysql_query("INSERT INTO log (name,time_stamp)
VALUES ('$Lname','$timestamp')")or die(mysql_error());		

}
}		//End of psudo_cron
//rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr


?>
		