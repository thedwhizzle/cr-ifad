<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>play4</title>

<style type="text/css">
#Container {

  width: 1000px ;
  height:700;
  margin-left: auto ;
  margin-right: auto ;
}

#Head
{
float: left;
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
$servername="localhost";
$username="root";			
$password="root";			//Local DB
$database="crifadne_golfers";
mysqli_connect($servername,$username,$password);
mysqli_select_db($database) or die( "Unable to select database");

} else {
$username="crifadne_larry";			
$password="larry1";			//Host DB
$database="crifadne_golfers";
mysql_connect(localhost,$username,$password);
mysql_select_db($database) or die( "Unable to select database");
}
}

//--------------------------------------------------------
connectDB();			//Get the table pointers
$result = mysql_query("SELECT * FROM hooks") or die(mysql_error());
$row = mysql_fetch_array($result); 
$course=$row['coursex'];
$players=$row['playersx'];
$teetime=$row['teetimex'];
$play_date=$row['play_datex'];


//((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((

function getid($Lname)
{
connectDB();
$result = mysql_query("SELECT * FROM players") or die(mysql_error());
while($row = mysql_fetch_array($result)){ 
if ($row['LAST_NAME']== $Lname) {
$_SESSION['user_id'] =$row['id'];
return $row['id']; 	//Return the id of member
}
}
return "69";		//Invalid name

}

//(((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((
function getid1($Lname)
{

connectDB();
$result = mysql_query("SELECT * FROM players1") or die(mysql_error());
while($row = mysql_fetch_array($result)){ 
if ($row['LAST_NAME']== $Lname) {
$_SESSION['user_id'] =$row['id'];
return $row['id']; 	//Return the id of member
}
}
return "69";		//Invalid name

}
//))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))
function getid2($Lname)
{

connectDB();
$result = mysql_query("SELECT * FROM players2") or die(mysql_error());
while($row = mysql_fetch_array($result)){ 
if ($row['LAST_NAME']== $Lname) {
$_SESSION['user_id'] =$row['id'];
return $row['id']; 	//Return the id of member
}
}
return "69";		//Invalid name

}
//))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))

function getid3($Lname)
{

connectDB();
$result = mysql_query("SELECT * FROM players3") or die(mysql_error());
while($row = mysql_fetch_array($result)){ 
if ($row['LAST_NAME']== $Lname) {
$_SESSION['user_id'] =$row['id'];
return $row['id']; 	//Return the id of member
}
}
return "69";		//Invalid name

}

//ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ


if (isset($_POST['weeks'])) {	//Set the variables for the week selected
if ($_POST['week']=="wk1") {

connectDB();
mysql_query("TRUNCATE TABLE hooks");
mysql_query("INSERT INTO hooks (id,coursex,playersx,teetimex,play_datex)
VALUES ('1','course','players','teetime','play_date')")or die(mysql_error());
}
if ($_POST['week']=="wk2") {
connectDB();
mysql_query("TRUNCATE TABLE hooks");
mysql_query("INSERT INTO hooks (id,coursex,playersx,teetimex,play_datex)
VALUES ('1','course1','players1','teetime1','nxt_play_date')")or die(mysql_error());
}

if ($_POST['week']=="wk3") {
connectDB();
mysql_query("TRUNCATE TABLE hooks");
mysql_query("INSERT INTO hooks (id,coursex,playersx,teetimex,play_datex)
VALUES ('1','course2','players2','teetime2','play_date2')")or die(mysql_error());
}

if ($_POST['week']=="wk4") {
connectDB();
mysql_query("TRUNCATE TABLE hooks");
mysql_query("INSERT INTO hooks (id,coursex,playersx,teetimex,play_datex)
VALUES ('1','course3','players3','teetime3','play_date3')")or die(mysql_error());
}
connectDB();
$result = mysql_query("SELECT * FROM hooks") or die(mysql_error());
$row = mysql_fetch_array($result); 
$course=$row['coursex'];
$players=$row['playersx'];
$teetime=$row['teetimex'];
$play_date=$row['play_datex'];
}


//-------------------------------------------------------------
if(isset($_POST['playdaz'])) {

$monpri= (isset($_POST['MON_PRI'])) ? "YES" :"NO";
$monalt= (isset($_POST['MON_ALT'])) ? "YES" :"NO";
$wed= (isset($_POST['WED'])) ? "YES" :"NO";
$fri= (isset($_POST['FRI'])) ? "YES" :"NO";


$Lname=trim($_POST["lastname"]);
$Lname=strtoupper($Lname);

$user_id= getid($Lname);		//Call function to get a user_id for the name
$_SESSION['user_id']=$user_id;
$user_id=$_SESSION['user_id'];

if (($monpri =="NO")|| ($monalt=="NO")){		//If pri and alt selected don't store

mysql_query("UPDATE $players SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE id='$user_id'");
}
}				//This updates the play days



if (isset($_POST['goback'])){
echo "<meta http-equiv='refresh' content='1;url=/play3.php'>\n";
exit(96);
}
//*************************************************************
?>

<div ID="Container">


<div ID="Head" >
<p align="center"> CR-IFAD</p>
</div>

<div ID="menu">

<h5>Select a week first! </h5>
<form action="play4.php" method="post">
<div align="right" size="70">
WK1: <input type="radio" name="week" value="wk1" />
WK2: <input type="radio" name="week" value="wk2" />
WK3: <input type="radio" name="week" value="wk3" />
WK4: <input type="radio" name="week" value="wk4" /><br/><br/>
<input type="submit"name="weeks" value="SELECT A WEEK" /><br/><br/>
</form>
</div>


<hr size="3" noshade="noshade">   
<h4> Change players status for the week selected </h4>

<div align="right" size="80"><br>
<form name="input" action="play4.php" method="post"><br>
LAST NAME <input type="text" name="lastname"> <br/>
MON_P <input type="checkbox" name="MON_PRI" value="YES" />
MON_A <input type="checkbox" name="MON_ALT" value="YES" />
WED <input type="checkbox" name="WED" value="YES" />
FRI <input type="checkbox" name="FRI" value="YES" /><br>
<input type="submit" name="playdaz"value="SUBMIT!"><br>
<br/><br/>
CZAR 1: <input type="text" size="24" maxlength="24" name="czar1"/><br/>
CZAR 2: <input type="text" size="24" maxlength="24" name="czar2"/><br/>
CZAR 3: <input type="text" size="24" maxlength="24" name="czar3"/><br/>
CZAR 4: <input type="text" size="24" maxlength="24" name="czar4"/><br/>
CZAR 5: <input type="text" size="24" maxlength="24" name="czar5"/><br/>
CZAR 6: <input type="text" size="24" maxlength="24" name="czar6"/><br/>
<input type="submit" name="addone" value="ADD NAMES!">&nbsp &nbsp

<?php 
if(isset($_POST['addone'])) {

	connectDB();

	$czar1 = $_POST['czar1'];
	$czar2 = $_POST['czar2'];
	$czar3 = $_POST['czar3'];
	$czar4 = $_POST['czar4'];
	$czar5 = $_POST['czar5'];
	$czar6 = $_POST['czar6'];

	$query = "UPDATE czarnames ";
	$query .= "SET czar1 = COALESCE(NULLIF('$czar1' ,''),czar1), ";
	$query .= "czar2 = COALESCE(NULLIF('$czar2' ,''),czar2), ";
	$query .= "czar3 = COALESCE(NULLIF('$czar3' ,''),czar3), ";
	$query .= "czar4 = COALESCE(NULLIF('$czar4' ,''),czar4), ";
	$query .= "czar5 = COALESCE(NULLIF('$czar5' ,''),czar5), ";
	$query .= "czar6 = COALESCE(NULLIF('$czar6' ,''),czar6) ";
	$query .= "WHERE id = 1";
	mysql_query($query);
}
?>

<hr size="3" noshade="noshade">
<form name="input" action="play3.php" method="post">
<br><input type="submit" name="goback" value="GO BACK TO PREVIOUS SCREEN!"><br/><br/>


</form>

</div>
</div>
<div ID="next_wk_head" >
<?php
Nxt_Table();

//zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz
function Nxt_Table()
{
connectDB();
$result = mysql_query("SELECT * FROM hooks") or die(mysql_error());
$row = mysql_fetch_array($result); 
$course=$row['coursex'];
$players=$row['playersx'];
$teetime=$row['teetimex'];
$play_date=$row['play_datex'];
$monpri_cnt=$monalt_cnt=$wed_cnt=$fri_cnt=0;
connectDB();
$result = mysql_query("SELECT * FROM $players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['MON_PRI']=="YES") {
$monpri_cnt++;}
}
$result = mysql_query("SELECT * FROM $players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['MON_ALT']=="YES") {
$monalt_cnt++;}
}
$result = mysql_query("SELECT * FROM $players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['WED']=="YES") {
$wed_cnt++;}
}
$result = mysql_query("SELECT * FROM $players") or die(mysql_error());
while($row = mysql_fetch_array($result)){
if ($row['FRI']=="YES") {
$fri_cnt++;}
}

 connectDB();
//Store the count in the table-------------------------------------------------
   mysql_query("UPDATE player_count SET day1='$monpri_cnt',day2='$monalt_cnt',day3='$wed_cnt',day4='$fri_cnt'");  //Update db  

//End of player count------------------------------------------------------------------------------------------------

//Get the date for the header---------------------------------------------
$result = mysql_query("SELECT * FROM $play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
$nxtwkof=$row['day1'];

echo "<p align=\"center\">";
echo "FOR WEEK OF: ".$nxtwkof;
echo "</p>";
//Start of day row-------------------------------------------

$result = mysql_query("SELECT * FROM playdays") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['day']."</td><td width=75>"; 
	echo $row['day1']."</td><td width=75>";
	echo $row['day2']."</td><td width=75>";
	echo $row['day3']."</td><td width=75>";
	echo $row['day4']."</td></tr>";	
echo "</table>";

//End of day row-----------------------------------------------------------
//Start of course row-------------------------------------------------------	

$result = mysql_query("SELECT * FROM $course") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['course']."</td><td width=75>"; 
	echo $row['day1']."</td><td width=75>";
	echo $row['day2']."</td><td width=75>";	
	echo $row['day3']."</td><td width=75>";
	echo $row['day4']."</td></tr>";
echo "</table>";
//End of course row------------------------------------------
//Start of date row--------------------------------------------------
$result = mysql_query("SELECT * FROM $play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['date']."</td><td width=75>"; 
	echo $row['day1']."</td><td width=75>";
	echo $row['day2']."</td><td width=75>";
	echo $row['day3']."</td><td width=75>";
	echo $row['day4']."</td></tr>";
echo "</table>";
//Start of Teetime row--------------------------------------------------
$result = mysql_query("SELECT * FROM $teetime") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['teetimes']."</td><td width=75>"; 
	echo $row['day1']."</td><td width=75>";
	echo $row['day2']."</td><td width=75>";
	echo $row['day3']."</td><td width=75>";
	echo $row['day4']."</td></tr>";
echo "</table>";
//End of Teetime row----------------------------------------------------------
//Start of count row----------------------------------------------------------
$result = mysql_query("SELECT * FROM player_count") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=1 ALIGN=center bgcolor=#99cc99><tr><td width=120 >";
	echo $row['row_label']."</td><td width=75>"; 
	echo $row['day1']."</td><td width=75>";
	echo $row['day2']."</td><td width=75>";
	echo $row['day3']."</td><td width=75>";
	echo $row['day4']."</td></tr>";
echo "</table>";

}       //End of  Nxt_Table function



?>
</div>
<div ID="next_wk_scroll">
<?php
$result = mysql_query("SELECT * FROM $players ORDER BY LAST_NAME") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
echo "<table border=1
 ALIGN=center bgcolor=#ffff99><tr><td width=120>";
	echo $row['LAST_NAME']."</td><td width=75>"; 
	echo $row['MON_PRI']."</td><td width=75>";
	echo $row['MON_ALT']."</td><td width=75>";
	echo $row['WED']."</td><td width=75>";
	echo $row['FRI']."</td></tr>";
}

echo "</table>";
?>
</div>      <!--End of next_wk_scroll div-->
</div>      <!--End container div-->

</body>
</html>




