<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>wk4</title>

<style type="text/css">
#Container {

  width: 1000px ;
  height:700;
  margin-left: auto ;
  margin-right: auto ;
}

#Head
{
float:left;
vertical-align:middle:
font-style:italic;
font-size:40px;
width:900px;
top:5px;
height:170px;
color:#ffcc00;
background-image:url('timber.jpg');
border-style:solid;
border-width:5px;


}

#menu
{
position:relative;
background-color:#ffffcc;
float:left;
color:#0000ff;
width:300px;
height:565px;
padding:10px;
border-top-style:solid;
border-bottom-style:solid;
border-left-style:solid;
border-width:5px;
border-color:blue;
overflow:auto;

}
#next_wk_head
{
position:relative;
float:left;
background-color:#addbe6;
width:562px;
height:180px;
padding:1px 10px 5px 3px;
border-top-style:solid;
border-left-style:solid;
border-right-style:solid;
border-width:5px;
border-color:blue;
overflow:hidden;
}
#next_wk_scroll
{
position:relative;
float:left;
background-color:#addbe6;
width:550px;
height:383px;
padding:0px 8px 16px 17px;
border-right-style:solid;
border-left-style:solid;
border-bottom-style:solid;
border-width:5px;
border-color:blue;
overflow:auto;
}
TD{font-family:Verdana; font-size:9pt;height:12pt;}




</style>
</head>
<body bgcolor=#999999>

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
//--------------------------------------------------------
//This code determines if we are before or after the cron run





//-------------------------------------------------------------
if(isset($_POST['playdaz'])) {

if ( $_POST["MON"]=="YES") {
$mon="YES";}
else {$mon="NO";}

if ( $_POST["WED"]=="YES") {
$wed="YES";}
else {$wed="NO";}

if ( $_POST["FRI"]=="YES") {
$fri="YES";}
else {$fri="NO";}

$Lname=$_SESSION['Lname'];
connectDB();

mysql_query("UPDATE players3 SET MON='$mon',WED='$wed',FRI='$fri' WHERE LAST_NAME='$Lname'");
}
if (isset($_POST['goback'])){
echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n";
exit(96);
}
//*************************************************************
?>

<div ID="Container">


<div ID="Head" >
<p align="center"> CR-IFAD</p>
</div>

<div ID="menu">
<h4> 
When you click SUBMIT all days are submitted so, each day should be appropriately checked.</h4>
<hr size="5" noshade="noshade">   

<h2>Put a check-mark by the days you want to play!</h2>

<div align="right" size="80"><br>
<form name="input" action="wk4.php" method="post"><br>

MON <input type="checkbox" name="MON" value="YES" /><br>
WED <input type="checkbox" name="WED" value="YES" /><br>
FRI <input type="checkbox" name="FRI" value="YES" /><br>

<br><input type="submit" name="playdaz"value="SUBMIT!"><br>
<hr size="5" noshade="noshade">
<form name="input" action="wk4.php" method="post">
<br><input type="submit" name="goback" value="GO BACK TO PREVIOUS SCREEN!"><br/><br/>
</form>

</div>
</div>
<div ID="next_wk_head" >
<?php
Nxt_Table();

function Nxt_Table()
{
//-----------------------------Start of SQL code------------------------------------
//This code counts the number of players each day----------------------------------------
$mon_cnt=0;
$wed_cnt=0;
$fri_cnt=0;
connectDB();
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON']=="YES") {
$mon_cnt++;}
}

$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$wed_cnt++;}
}
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$fri_cnt++;}
}

$Fname = $_SESSION['Fname'];
$Lname = $_SESSION['Lname'];
 connectDB();

//Store the count in the table-------------------------------------------------
mysql_query("UPDATE player_count SET day1='$mon_cnt',day2='$wed_cnt',day3='$fri_cnt'");//Update db
//End of player count------------------------------------------------------------------------------------------------

//Get the date for the header---------------------------------------------
$result = mysql_query("SELECT * FROM play_date3") or die(mysql_error());
$row = mysql_fetch_array($result);
$nxtwkof=$row['day1'];

echo "<p align=\"center\">";
echo "FOR WEEK OF: ".$nxtwkof;
echo "</p>";
//Start of day row-------------------------------------------

$result = mysql_query("SELECT * FROM playdays") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['day']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";	
echo "</table>";
//End of day row------------------------------------------------------------
//Start of course row-------------------------------------------------------	

$result = mysql_query("SELECT * FROM course3") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['course']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of course row--------------------------------------------
//Start of date row--------------------------------------------------
$result = mysql_query("SELECT * FROM play_date3") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['date']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//Start of Teetime row--------------------------------------------------
$result = mysql_query("SELECT * FROM teetime3") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['teetimes']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of Teetime row----------------------------------------------------------


//Start of count row----------------------------------------------------------
$result = mysql_query("SELECT * FROM player_count") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['row_label']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";

}       //End of function
?>
</div>
<div ID="next_wk_scroll">
<?php
$result = mysql_query("SELECT * FROM players3 ORDER BY LAST_NAME") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
echo "<table border=1
 ALIGN=center bgcolor=#ffff99><tr><td width=120>";
	echo $row['LAST_NAME']."</td><td width=100>"; 
	echo $row['MON']."</td><td width=100>";
	echo $row['WED']."</td><td width=100>";
	echo $row['FRI']."</td></tr>";
}

echo "</table>";


?>
</div>      <!--End of next_wk_scroll div-->
</div>      <!--End container div-->

</body>
</html>




