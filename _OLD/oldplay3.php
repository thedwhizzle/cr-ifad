<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html><head>

<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type"><title>CR-IFAD>NET</title>

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
height:120px;
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
height:615px;
padding:10px;
border-top-style:solid;
border-bottom-style:solid;
border-left-style:solid;
border-width:5px;
border-color:blue;
overflow:hidden;

}
#current_wk
{
position:relative;
float:left;
background-color:#ffffcc;
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
height:433px;
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
<body bgcolor="silver">
<?php
//---------------------------------------------------
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
//--Get the week vars from db------------------------------------------------------
connectDB();
$result = mysql_query("SELECT * FROM hooks") or die(mysql_error());
$row = mysql_fetch_array($result); 
$course=$row['coursex'];
$players=$row['playersx'];
$teetime=$row['teetimex'];
$play_date=$row['play_datex'];
//--------------------------------------------------------------------
//Store the vars for the week selected


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


// The following code sets the COURSE, the TEETIMES, and the NUMBER OF TEETIMES-from input-------------------------
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
if (isset($_POST['larry'])) {

$Ncourse=strtoupper($_POST['course']);
$Nteetime=$_POST['teetime'];		//Get the course and tt from input

if ($_POST['but']=="day1") {

connectDB();
mysql_query("UPDATE $course SET day1='$Ncourse'");
mysql_query("UPDATE $teetime SET day1='$Nteetime'");	//Do Mon course and tt
} elseif ($_POST['but']=="day2"){
connectDB();
mysql_query("UPDATE $course SET day2='$Ncourse'");
mysql_query("UPDATE $teetime SET day2='$Nteetime'");	//Do Tue course and tt

} elseif ($_POST['but']=="day3"){
connectDB();
mysql_query("UPDATE $course SET day3='$Ncourse'");
mysql_query("UPDATE $teetime SET day3='$Nteetime'");	//Do FRi course and tt
}










}

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&


//------------------------This code adds a player to all  player tables 
elseif (isset($_POST['addone'])) {
$Fname=trim($_POST['first_name']);
$Fname=strtoupper($Fname);
$Lname=trim($_POST['last_name']);
$Lname=strtoupper($Lname);
$user_id= getid($Lname);		//Call function to get a user_id for the name
$_SESSION['user_id']=$user_id;		//Check for duplicate name
if (($user_id=="69")&&(strlen($Lname)!=0)) {	//If duplicate name or no name skip updating DB

$NO="NO";

connectDB();
mysql_query("INSERT INTO players (LAST_NAME,FIRST_NAME,MON,WED,FRI)
VALUES ('$Lname','$Fname','$NO','$NO','$NO')")or die(mysql_error());	//Add name to players table
mysql_query("INSERT INTO players1 (LAST_NAME,FIRST_NAME,MON,WED,FRI)
VALUES ('$Lname','$Fname','$NO','$NO','$NO')")or die(mysql_error());	//Add name to players1 table
mysql_query("INSERT INTO players2 (LAST_NAME,FIRST_NAME,MON,WED,FRI)
VALUES ('$Lname','$Fname','$NO','$NO','$NO')")or die(mysql_error());	//Add name to players2 table
mysql_query("INSERT INTO players3 (LAST_NAME,FIRST_NAME,MON,WED,FRI)
VALUES ('$Lname','$Fname','$NO','$NO','$NO')")or die(mysql_error());	//Add name to players3 table

}
}

//--------------------------------------This code deletes a player from the appro. table
elseif (isset($_POST['minusone'])) {

$Fname=trim($_POST['first_name']);
$Fname=strtoupper($Fname);
$Lname=trim($_POST['last_name']);
$Lname=strtoupper($Lname);
$user_id= getid($Lname);		//Call function to get a user_id for the name
$user_id1= getid1($Lname);
$user_id2= getid2($Lname);
$user_id3= getid3($Lname);					
$_SESSION['user_id']=$user_id;		
if ($user_id!="69") {			//Must be valid id to delete
connectDB();
mysql_query("DELETE FROM players WHERE id='$user_id'") or die(mysql_error());		//Delete a row
mysql_query("DELETE FROM players1 WHERE id='$user_id1'") or die(mysql_error());
mysql_query("DELETE FROM players2 WHERE id='$user_id2'") or die(mysql_error());
mysql_query("DELETE FROM players3 WHERE id='$user_id3'") or die(mysql_error()); 
}

}

elseif(isset($_POST["czarstuff"])) {		//Is additional CZAR stuff to be done ?
echo "<meta http-equiv='refresh' content='1;url=/play4.php'>\n";
exit(96);
}
elseif(isset($_POST["monthview"])) {		//The month at a glance
echo "<meta http-equiv='refresh' content='1;url=/month.php'>\n";
exit(96);
}


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
?>

<div ID="Container">
<div ID="Head" >
<p align="center"> CR-IFAD</p>
</div>

<div ID="menu">
<!--//--------------------------Week and day selection---------------------------->
<h4 style="color:red">  FOR THE ADMIN USE ONLY!</h4>

<!--<h5>  Select a <i> DAY</i> and enter the relevant information.-->
<h5>You can omly select <i> ONE</i> week and <i>ONE</i> day at a time. Select a week first </h5>
<form action="play3.php" method="post">
<div align="right" size="70">
WK1: <input type="radio" name="week" value="wk1" />
WK2: <input type="radio" name="week" value="wk2" />
WK3: <input type="radio" name="week" value="wk3" />
WK4: <input type="radio" name="week" value="wk4" /><br/><br/>
<input type="submit"name="weeks" value="SUBMIT YOUR SELECTION" /><br/><br/>
</form>
</div>

<form action="play3.php" method="post">
<div align="right" size="70">
MON: <input type="radio" name="but" value="day1" />
WED: <input type="radio" name="but" value="day2" />
FRI: <input type="radio" name="but" value="day3" /><br/>



COURSE: <input type="test" size="15" maxlength="15" name="course"/><br/>
TIME: <input type="text" size="8" maxlength="8" name="teetime" /><br/>
<input type="submit"name="larry" value="SUBMIT" />
<hr size="5" noshade="noshade">
</form>
</div>


<!--//-----------------------End of set tee time menu---------------------------------->



<!--//----------------------End of play days menu--------------------------------------->

<!--//----------------------Start of new member menu------------------------------------>
<h5> Add or remove a players  <i>NAME</i>. .</h5>
<div align="right" size="70">
<form action="play3.php" method="post">
FIRST NAME: <input type="text" size="15" maxlength="15" name="first_name"/><br/>
LAST NAME: <input type="text" size="15" maxlength="15" name="last_name"/><br/>
<input type="submit" name="addone"value="ADD NAME!">&nbsp &nbsp
<input type="submit" name="minusone"value="DELETE NAME!!">
<hr size="5" noshade="noshade">
</form>
</div>
<div align="right" size="80">
<form name="input" action="play3.php" method="post">
<br><input type="submit" name="monthview" value="THE MONTH AT A GLANCE!"><br/><br/>
<form name="input" action="play3.php" method="post">
<br><input type="submit" name="czarstuff" value="MORE ADMIN TOOLS!"><br/><br/>
</form>
</div>

<!--//-------------------End of new member menu----------------------------------------->
</div>		<!--End of menu div---------------->



<div ID="current_wk" >
<?php
Curr_Table();
?>


</div>

<?php
//))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))

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

//ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ

//((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((((

function Curr_Table()

{

global $play_date;
global $players;
global $course;
global $teetime;

//This code counts the number of players each day----------------------------------------
$mon_cnt=0;
$wed_cnt=0;
$fri_cnt=0;
global $players;
connectDB();
$result = mysql_query("SELECT * FROM $players") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
if ($row['MON']=="YES") {
$mon_cnt++;}
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
//Store the count in the table-------------------------------------------------
mysql_query("UPDATE player_count SET day1='$mon_cnt',day2='$wed_cnt',day3='$fri_cnt'");//Update db
//End of player count------------------------------------------------------------------------------------------------

//Get the date for the header---------------------------------------------







//-----------------------------Start of SQL code------------------------------------
//Get the date for the header-----------------------------------------------------
connectDB();

$result = mysql_query("SELECT * FROM $play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
$currwkof=$row['day1'];

echo "<p align=\"center\">";
echo "WEEK OF: ".$currwkof;
echo "</p>";
//Start of day row-------------------------------------------

$result = mysql_query("SELECT * FROM playdays") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=2 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['day']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";	
echo "</table>";
//End of day row------------------------------------------------------------
//Start of course row-------------------------------------------------------	

$result = mysql_query("SELECT * FROM $course") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=2 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['course']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of course row------------------------------------------------------------
//Start of date row-------------------------------------------------------------

$result = mysql_query("SELECT * FROM $play_date") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=2 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['date']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of date row-----------------------------------------------------
//Start of Teetime row--------------------------------------------------
$result = mysql_query("SELECT * FROM $teetime") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=2 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['teetimes']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
//End of Teetime row----------------------------------------------------------



//Start of count row----------------------------------------------------------
$result = mysql_query("SELECT * FROM player_count") or die(mysql_error());
$row = mysql_fetch_array($result);
echo "<table border=2 ALIGN=center bgcolor=#99cc99><tr><td width=140 >";
	echo $row['row_label']."</td><td width=100>"; 
	echo $row['day1']."</td><td width=100>";
	echo $row['day2']."</td><td width=100>";
	echo $row['day3']."</td></tr>";
echo "</table>";
}       //End of function
?>
</div>
<div ID="current_wk_scroll" >
<?php
$result = mysql_query("SELECT * FROM $players ORDER BY LAST_NAME") or die(mysql_error());
  
while($row = mysql_fetch_array($result)){
echo "<table border=2 ALIGN=center bgcolor=#ffff99><tr><td width=140>";
	echo $row['LAST_NAME']."</td><td width=100>"; 
	echo $row['MON']."</td><td width=100>";
	echo $row['WED']."</td><td width=100>";
	echo $row['FRI']."</td></tr>";
}
echo "</table>";
?>
</div>		<!--End of current_wk_scroll div-->
</div>		<!--End container div-->


</body>
</html>