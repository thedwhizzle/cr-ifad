<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>Page1</title>

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
background-image:url('portnoo.jpg');
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
#current_wk_head
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
#current_wk_scroll
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
overflow-y:auto;
}
TD{font-family:Verdana; font-size:9pt;height:12pt;}

</style>
</head>
<body bgcolor="silver">



<?php

 connectDB();

$result = mysql_query("SELECT * FROM admin_pw") or die(mysql_error());
$row = mysql_fetch_array($result);

$Admin=$row['password'];
 if (isset($_GET['mysubmit'])) {
$_SESSION['Firstname']=$_REQUEST['FirstName'];
$_SESSION['Lastname']=$_REQUEST['LastName'];		//Save name as it was typed

$Fname= trim($_REQUEST["FirstName"]);
$Lname= trim($_REQUEST["LastName"]);
$_REQUEST["LastName"]= "NONO";		//This is to stop people from returning via previous

if ($Lname==$Admin){			//Check for Admin login------------------------------------
$_SESSION['Lname']=$Lname;
echo "<meta http-equiv='refresh' content='1;url=/play3.php'>\n";	//Go to Admin page
exit;
}


$Fname= strtoupper($Fname);	//Needed when names come from user
$Lname= strtoupper($Lname);
$_SESSION['Fname']=$Fname;
$_SESSION['Lname']=$Lname;
$EST= (time() +3600);
$timestamp = date("m/d/y : H:i:s", $EST);
connectDB();
mysql_query("INSERT INTO log (name,time_stamp)
VALUES ('$Lname','$timestamp')")or die(mysql_error());		//Keep a log in DB of who is logging in

$_SESSION['bad_login']='NULL';
$user_id=signin($Fname,$Lname);			//Signin function
if ($user_id=="69") {
$_SESSION['bad_login']=$user_id;			// code to SESSION
echo "<meta http-equiv='refresh' content='1;url=/index.php'/>\n"; //Go back to first page if bad login.
exit(69);
} else {
$_SESSION['user_id'] =$user_id;
}
}

 
elseif(isset($_POST["schedule1"])) {		//Is next weeks schedule selected ?
echo "<meta http-equiv='refresh' content='1;url=/play2.php'>\n";
exit(96);
}
elseif(isset($_POST["schedule2"])) {		//Is next weeks schedule selected ?
echo "<meta http-equiv='refresh' content='1;url=/wk3.php'>\n";
exit(95);
}
elseif(isset($_POST["schedule3"])) {		//Is next weeks schedule selected ?
echo "<meta http-equiv='refresh' content='1;url=/wk4.php'>\n";
exit(94);
}
elseif(isset($_POST["schedule0"])) {		//Is next weeks schedule selected ?
echo "<meta http-equiv='refresh' content='1;url=/wk1.php'>\n";
exit(93);
}
elseif(isset($_POST["forum"])) {		//Is msg forum selected ?
session_destroy();				//Wipe out login if we are leaving
echo "<meta http-equiv='refresh' content='1;url=/board/mboard.php'>\n";
exit(99);
}
elseif(isset($_POST["monthview"])) {		//The month at a glance
echo "<meta http-equiv='refresh' content='1;url=/month.php'>\n";
exit(99);
}
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

//*************************************************************
?>
<div ID="Container">
<div ID="Head" >
<p align="center"> CRIFAD</p>
</div>

<div ID="menu">
<?php
connectDB();

$CZARS= mysql_query("SELECT * FROM czarnames") or die(mysql_error());
$row=mysql_fetch_array($CZARS);
$czar=$row['czar'];
$czar1=$row['czar1'];

echo "<font color=\"red\">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Czar:&nbsp;&nbsp; $czar  </font><br>";
echo "<font color=\"red\"> Ass't Czar:&nbsp;&nbsp;  $czar1  </font>";

?>
  
<hr size="3" noshade="noshade">
<?php
echo "<font color=\"green\"> WELCOME .$Fname </font>";
?>
<hr size="3" noshade="noshade">
<h5>  View and change your golf schedule for next 4 weeks.</h5>

<form name="input" action="play1.php" method="post">
<br><input type="submit" name="schedule0"value="ADJUST SCHEDULE FOR THIS WEEK!"><br>
</form>
<form name="input" action="play1.php" method="post">
<br><input type="submit" name="schedule1"value="ADJUST SCHEDULE FOR NEXT WEEK!"><br>
</form>
<form name="input" action="play1.php" method="post">
<br><input type="submit" name="schedule2"value="ADJUST SCHEDULE FOR 2 WEEKS AHEAD!"><br>
</form>
<form name="input" action="play1.php" method="post">
<br><input type="submit" name="schedule3"value="ADJUST SCHEDULE FOR 3 WEEKS AHEAD!"><br>
</form>
<hr size="3" noshade="noshade">

<form name="input" action="play1.php" method="post">
<br><input type="submit" name="monthview" value="THE MONTH AT A GLANCE!"><br/>
</form>
<form name="input" action="play1.php" method="post">
<br><input type="submit" name="forum"value="GO TO MESSAGE FORUM!"><br>
</form>


<hr size="3" noshade="noshade">
<a href="/RULES.htm">  2015 RULES OF PLAY</a> &nbsp;

 <a href="http://www.weather.com/weather/tenday/27312" target="_blank"> 10 DAY WEATHER </a> &nbsp;&nbsp;

 <a href="/IFAD_Payout.pdf">  IFAD PAYOUT</a> &nbsp;
</div>   <!-- End of menu div-->



<div ID="current_wk_head" >
<?php
Curr_Table();
?>


</div>    <!-- End of current_wk_hd div-->

<?php
//--------------------------------------------

function signin($Fname,$Lname)
{
 connectDB();
$result = mysql_query("SELECT * FROM players") or die(mysql_error());

while($row = mysql_fetch_array($result)){ 
if (($row['LAST_NAME']== $Lname) && ($row['FIRST_NAME']==$Fname)) {
$_SESSION['user_id'] =$row['id'];
return $row['id']; 	//Return the id of member
}
}
return "69";		//Invalid name

}

//Need to call new page here++++++++++++++++++++++++++++++++++++++++++++
//-------------------------------------------


function Curr_Table()

{
//This code counts the number of players each day----------------------------------------
$mon_cnt=0;
$wed_cnt=0;

$fri_cnt=0;

 connectDB();
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON']=="YES") {
$mon_cnt++;}
}
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$wed_cnt++;}
}
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$fri_cnt++;}
}

//Store the count in the table-------------------------------------------------
mysql_query("UPDATE player_count SET day1='$mon_cnt',day2='$wed_cnt',day3='$fri_cnt'");//Update db
//End of player count------------------------------------------------------------------------------------------------

//Get the date for the header---------------------------------------------







//-----------------------------Start of SQL code------------------------------------
//Get the date for the header-----------------------------------------------------
connectDB();
$result = mysql_query("SELECT * FROM play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
$currwkof=$row['day1'];

echo "<p align=\"center\">";
echo "WEEK OF: ".$currwkof;
echo "</p>";
//Start of day row-------------------------------------------

$result = mysql_query("SELECT * FROM playdays") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['day']."</td><td  width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";	
echo "</table>";
//End of day row------------------------------------------------------------
//Start of course row-------------------------------------------------------	

$result = mysql_query("SELECT * FROM course") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['course']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of course row------------------------------------------------------------
//Start of date row-------------------------------------------------------------

$result = mysql_query("SELECT * FROM play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['date']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of date row-----------------------------------------------------
//Start of Teetime row--------------------------------------------------
$result = mysql_query("SELECT * FROM teetime") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['teetimes']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of Teetime row----------------------------------------------------------



//Start of count row----------------------------------------------------------
$result = mysql_query("SELECT * FROM player_count") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['row_label']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
}       //End of function



?>

<div ID="current_wk_scroll">
<?php
$result = mysql_query("SELECT * FROM players ORDER BY LAST_NAME") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
echo "<table border=1 ALIGN=center bgcolor=#ffff99><tr><td  width=140>";
	echo $row['LAST_NAME']."</td><td  width=100>"; 
	echo $row['MON']."</td><td width=100>";
	echo $row['WED']."</td><td width=100>";
	echo $row['FRI']."</td></tr>";
}

echo "</table>";

?>
</div>      <!--End of current_wk_scroll div-->
</div>      <!--End container div-->

</body>
</html>