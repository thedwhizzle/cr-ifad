<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>ABCDEFGHmonth</title>

<style type="text/css">
#Container {

  width: 1000px ;
  height:700;
  margin-left: auto ;
  margin-right: auto ;
}
</style>
</head>
<div ID="Container">

<?php
//--------------------------------------------
function connectDB()
{
if ($_SERVER['HTTP_HOST']=='localhost'){
$servername="localhost";
$username="root";			
$password="root";			//Local DB
$database="crifadne_golfers";
mysql_connect($servername,$username,$password);
mysql_select_db($database) or die( "Unable to select database");

} else {
$username="crifadne_larry";			
$password="larry1";			//Host DB
$database="crifadne_golfers";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database");
}
}

if (isset($_POST['goback'])){

connectDB();		//See if it is Admin who is logged in
$result = mysql_query("SELECT * FROM admin_pw") or die(mysql_error());
$row = mysql_fetch_array($result);
$Admin=$row['password'];
if($_SESSION['Lname']==$Admin) {
echo "<meta http-equiv='refresh' content='1;url=/play3.php'>\n"; //If admin go back to play3

}

else{
echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n"; // Must be a user so go back to play1
	}
}
 
 connectDB();
//Start of date row-------------------------------------------------------------

$result = mysql_query("SELECT * FROM play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr style=\"background-color:aqua;font-size:12px;\"><td width=120 >";
	echo $row['date']."</td><td width=56>"; 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";	
	echo $row['day4']."</td><td width=56>";	
$result = mysql_query("SELECT * FROM nxt_play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['day1']."</td><td width=56>"; 
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
$result = mysql_query("SELECT * FROM play_date2") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['day1']."</td><td width=56>"; 
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
$result = mysql_query("SELECT * FROM play_date3") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['day1']."</td><td width=56>"; 
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td></tr>";
	echo "</table>";


$result = mysql_query("SELECT * FROM playdays") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr style=\"background-color:GOLD;font-size:10px;\"><td width=110 >";
	echo $row['day']."</td><td width=56>";
 	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
 	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td></tr>";	
echo "</table>";
//End of day row------------------------------------
$result = mysql_query("SELECT * FROM course") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#ffcc99><tr style=\"background-color:cornsilk;font-size:11px;\"><td width=104 >";
	echo $row['course']."</td><td width=56>"; 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
	
$result = mysql_query("SELECT * FROM course1") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>"; 

	
$result = mysql_query("SELECT * FROM course2") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>"; 

$result = mysql_query("SELECT * FROM course3") or die(mysql_error());
$row = mysql_fetch_array($result);
 	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td></tr>";
	echo "</table>";
//--------------Start of Tee time display
$result = mysql_query("SELECT * FROM teetime") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr style=\"background-color:grey;color:white;font-size:12px;\"><td width=104 >";
	echo $row['teetimes']."</td><td width=56>"; 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
    
$result = mysql_query("SELECT * FROM teetime1") or die(mysql_error());
$row = mysql_fetch_array($result); 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
    echo $row['day4']."</td><td width=56>";
$result = mysql_query("SELECT * FROM teetime2") or die(mysql_error());
$row = mysql_fetch_array($result); 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
    echo $row['day3']."</td><td width=56>";
	echo $row['day4']."</td><td width=56>";
$result = mysql_query("SELECT * FROM teetime3") or die(mysql_error());
$row = mysql_fetch_array($result); 
	echo $row['day1']."</td><td width=56>";
	echo $row['day2']."</td><td width=56>";
	echo $row['day3']."</td><td width=56>";
    echo $row['day4']."</td></tr>";
echo "</table>";

 //----------------------Get the count of players for week1

$result = mysql_query("SELECT * FROM players") or die(mysql_error());

$day1_cnt = null;
$day2_cnt = null;
$day3_cnt = null;
$day4_cnt = null;
$day5_cnt = null;
$day6_cnt = null;
$day7_cnt = null;
$day8_cnt = null;
$day9_cnt = null;
$day10_cnt = null;
$day11_cnt = null;
$day12_cnt = null;
$day13_cnt = null;
$day14_cnt = null;
$day15_cnt = null;
$day16_cnt = null;

while($row = mysql_fetch_array($result)){
if ($row['MON_PRI']=="YES") {
$day1_cnt++;}
}
while($row = mysql_fetch_array($result)){
if ($row['MON_ALT']=="YES") {
$day2_cnt++;}
}
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$day3_cnt++;}
}
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$day4_cnt++;}
}
//-----------------------Get the count of players for week2

$result = mysql_query("SELECT * FROM players1") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON_PRI']=="YES") {
$day5_cnt++;}
}
while($row = mysql_fetch_array($result)){
if ($row['MON_ALT']=="YES") {
$day6_cnt++;}
}
$result = mysql_query("SELECT * FROM players1") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$day7_cnt++;}
}
$result = mysql_query("SELECT * FROM players1") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$day8_cnt++;}
}
//-----------------------Get the count of players for week3
$result = mysql_query("SELECT * FROM players2") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON_PRI']=="YES") {
$day9_cnt++;}
}
while($row = mysql_fetch_array($result)){
if ($row['MON_ALT']=="YES") {
$day10_cnt++;}
}
$result = mysql_query("SELECT * FROM players2") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$day11_cnt++;}
}
$result = mysql_query("SELECT * FROM players2") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$day12_cnt++;}
}
//-----------------------Get the count of players for week4
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON_PRI']=="YES") {
$day13_cnt++;}
}
while($row = mysql_fetch_array($result)){
if ($row['MON_ALT']=="YES") {
$day14_cnt++;}
}
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$day15_cnt++;}
}
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$day16_cnt++;}
}
//--Display player count------------------------------------------------
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr style=\"background-color:firebrick;color:white;font-size:12px;\"><td width=104 >";
	echo "PLAYER COUNT"."</td><td width=70>";
	echo $day1_cnt."</td><td width=56>";
 	echo $day2_cnt."</td><td width=56>";
	echo $day3_cnt."</td><td width=56>";
	echo $day4_cnt."</td><td width=56>";
 	echo $day5_cnt."</td><td width=56>";
	echo $day6_cnt."</td><td width=56>";
	echo $day7_cnt."</td><td width=56>";
	echo $day8_cnt."</td><td width=56>";
	echo $day9_cnt."</td><td width=56>";
	echo $day10_cnt."</td><td width=56>";
	echo $day11_cnt."</td><td width=56>";
	echo $day12_cnt."</td><td width=56>";
	echo $day13_cnt."</td><td width=56>";
	echo $day14_cnt."</td><td width=56>";
	echo $day15_cnt."</td><td width=56>";
	echo $day16_cnt."</td><tr>";
		
echo "</table>";





//----------------Display players---------------------------------------
$index=0;
$result = mysql_query("SELECT * FROM players ORDER BY LAST_NAME") or die(mysql_error());
while($row = mysql_fetch_array($result)){
$IDarray[$index]=$row['id'];
$index++;

}
$limit=sizeof($IDarray);

for ($index=0;$index <$limit;$index++) {
$result = mysql_query("SELECT * FROM players where id=$IDarray[$index]") or die(mysql_error());

$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=beige><tr style=\"background-color:kaki;color:black;font-size:11px;font-weight:bold;\"><td  width=104>";
	echo $row['LAST_NAME']."</td><td  width=56>"; 
	echo $row['MON_PRI']."</td><td width=56>";
	echo $row['MON_ALT']."</td><td width=56>";
	echo $row['WED']."</td><td width=56>";
	echo $row['FRI']."</td><td width=56>";
$result = mysql_query("SELECT * FROM players1 where id=$IDarray[$index]") or die(mysql_error());
$row = mysql_fetch_array($result);
    echo $row['MON_PRI']."</td><td width=56>";
	echo $row['MON_ALT']."</td><td width=56>";
	echo $row['WED']."</td><td width=56>";
	echo $row['FRI']."</td><td width=56>";
	$result = mysql_query("SELECT * FROM players2 where id=$IDarray[$index]") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['MON_PRI']."</td><td width=56>";
	echo $row['MON_ALT']."</td><td width=56>";
	echo $row['WED']."</td><td width=56>";
	echo $row['FRI']."</td><td width=56>";
$result = mysql_query("SELECT * FROM players3 where id=$IDarray[$index]") or die(mysql_error());
$row = mysql_fetch_array($result);
	echo $row['MON_PRI']."</td><td width=56>";
	echo $row['MON_ALT']."</td><td width=56>";
	echo $row['WED']."</td><td width=56>";
	echo $row['FRI']."</td></tr>";
}
echo "</table>";
?>
<form name="input" action="month.php" method="post">
<br><input type="submit" name="goback" value="GO BACK TO PREVIOUS SCREEN!"><br/><br/>
</form>

</div>      <!--End container div-->


</html>

