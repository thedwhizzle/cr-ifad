<?php 

function redirect_to($new_location) 
{
	header("Location: " . $new_location);
	exit;
}

function confirm_query($result_set) 
{
	if (!$result_set) 
	{
		die("Database query failed.");
	}
}

function form_errors($errors=array()) 
{
	$output = "";
	if (!empty($errors)) 
	{
	  $output .= "<div class=\"error\">";
	  $output .= "Please fix the following errors:";
	  $output .= "<ul>";
	  foreach ($errors as $key => $error) 
	  {
		$output .= "<li>";
		$output .= htmlentities($error);
		$output .= "</li>";
	  }
	  $output .= "</ul>";
	  $output .= "</div>";
	}
	return $output;
}

function table_date() 
{
	global $connection;
		//Get the date for the header
		$query = "SELECT * FROM play_date";
		$result = mysqli_query($connection, $query) or die(mysqli_error());
		$row = mysqli_fetch_array($result);
		$currwkof=$row['day1'];

		echo "<div id=\"table_date\"><h2 id=\"weekof\"> WEEK OF: ".$currwkof;
		echo"</h2></div>";
}

function table_date2() 
{
	global $connection;
		//Get the date for the header
		$query = "SELECT * FROM nxt_play_date";
		$result = mysqli_query($connection, $query) or die(mysqli_error());
		$row = mysqli_fetch_array($result);
		$currwkof=$row['day1'];

		echo "<div id=\"table_date\"><h2 id=\"weekof\"> WEEK OF: ".$currwkof;
		echo"</h2></div>";
}

function table_date3() 
{

	global $connection;
		//Get the date for the header
		$query = "SELECT * FROM play_date2";
		$result = mysqli_query($connection, $query) or die(mysqli_error());
		$row = mysqli_fetch_array($result);
		$currwkof=$row['day1'];

		echo "<div id=\"table_date\"><h2 id=\"weekof\"> WEEK OF: ".$currwkof;
		echo"</h2></div>";
}

function table_date4() 
{
	global $connection;
		//Get the date for the header
		$query = "SELECT * FROM play_date3";
		$result = mysqli_query($connection, $query) or die(mysqli_error());
		$row = mysqli_fetch_array($result);
		$currwkof=$row['day1'];

		echo "<div id=\"table_date\"><h2 id=\"weekof\"> WEEK OF: ".$currwkof;
		echo"</h2></div>";
}
//End of Table Date functions

function current_table() 
{
global $connection;

	//This code counts the number of players each day 
	$monpri_cnt=$monalt_cnt=$wed_cnt=$fri_cnt=0;

	$query = "SELECT * ";
	$query .= "FROM players";
	$result = mysqli_query($connection, $query);
	if (!$result) 
	{
		die("Database query failed.");
	}

	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_PRI']=="YES") 
		{
			$monpri_cnt++;
		}
	}

	$query = "SELECT * ";
	$query .= "FROM players";
	$result = mysqli_query($connection, $query) or die(mysql_error());		//Needed for each one
	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_ALT']=="YES")
		{
			$monalt_cnt++;
		}
	}

	$query = "SELECT * FROM players";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['WED']=="YES") 
		{
			$wed_cnt++;
		}
	}

	$query = "SELECT * FROM players";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['FRI']=="YES") 
		{
			$fri_cnt++;
		}
	}

	//Store the count in the table
	$query = "UPDATE player_count SET day1='$monpri_cnt',day2='$monalt_cnt',day3='$wed_cnt',day4='$fri_cnt'";
	mysqli_query($connection, $query); 
	//End of player count

	$query = "SELECT * FROM playdays";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$day = mysqli_fetch_array($result);

	$query = "SELECT * FROM course";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$course = mysqli_fetch_array($result);

	$query = "SELECT * FROM play_date";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$date = mysqli_fetch_array($result);

	$query = "SELECT * FROM teetime";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$tee = mysqli_fetch_array($result);

	$query = "SELECT * FROM player_count";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$count = mysqli_fetch_array($result);

	$query = "SELECT * FROM players ORDER BY LAST_NAME";
	$result = mysqli_query($connection, $query) or die(mysql_error()); 

	$name = "";
	$mon1 = "";
	$mon2 = "";
	$wed = "";
	$fri = "";

	while($player = mysqli_fetch_assoc($result))
	{
		$name .= "<td>".$player['LAST_NAME']."</td>";
		$mon1 .= "<td>".$player['MON_PRI']."</td>";
		$mon2 .= "<td>".$player['MON_ALT']."</td>";
		$wed .= "<td>".$player['WED']."</td>";
		$fri .= "<td>".$player['FRI']."</td>";
	}	

	echo
		"<table class=\"responsive tableCol\">
			<tbody>
				<tr id=\"names\">
					<th>PLAYER</th>
					".$name ."
				</tr>
				<tr>	
					<th>".$day['day1']."</br>".$course['day1']."</br>".$date['day1']." @ ".$tee['day1']."</br>".$count['day1']." players"."</th>
					".$mon1 ."
				</tr>

				<tr>
					<th>".$day['day2']."</br>".$course['day2']."</br>".$date['day2']." @ ".$tee['day2']."</br>".$count['day2']." players"."</th>	
					".$mon2 ."
				</tr>	
	
				<tr>
					<th>".$day['day3']."</br>".$course['day3']."</br>".$date['day3']." @ ".$tee['day3']."</br>".$count['day3']." players"."</th>
					".$wed ."
				</tr>	
	
				<tr>
					<th>".$day['day4']."</br>".$course['day4']."</br>".$date['day4']." @ ".$tee['day4']."</br>".$count['day4']." players"."</th>
					".$fri ."
				</tr>
			</tbody>
		</table>";
} 

function week2_table() 
{
	global $connection;

	//This code counts the number of players each day 
	$monpri_cnt=$monalt_cnt=$wed_cnt=$fri_cnt=0;

	$query = "SELECT * ";
	$query .= "FROM players1";
	$result = mysqli_query($connection, $query);
	if (!$result) 
	{
		die("Database query failed.");
	}

	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_PRI']=="YES") 
		{
			$monpri_cnt++;
		}
	}

	$query = "SELECT * ";
	$query .= "FROM players1";
	$result = mysqli_query($connection, $query) or die(mysql_error());		//Needed for each one
	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_ALT']=="YES")
		{
			$monalt_cnt++;
		}
	}

	$query = "SELECT * FROM players1";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['WED']=="YES") 
		{
			$wed_cnt++;
		}
	}

	$query = "SELECT * FROM players1";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['FRI']=="YES") 
		{
			$fri_cnt++;
		}
	}

	//Store the count in the table
	$query = "UPDATE player_count SET day1='$monpri_cnt',day2='$monalt_cnt',day3='$wed_cnt',day4='$fri_cnt'";
	mysqli_query($connection, $query); 
	//End of player count

	$query = "SELECT * FROM playdays";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$day = mysqli_fetch_array($result);

	$query = "SELECT * FROM course1";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$course = mysqli_fetch_array($result);

	$query = "SELECT * FROM nxt_play_date";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$date = mysqli_fetch_array($result);

	$query = "SELECT * FROM teetime1";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$tee = mysqli_fetch_array($result);

	$query = "SELECT * FROM player_count";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$count = mysqli_fetch_array($result);

	$query = "SELECT * FROM players1 ORDER BY LAST_NAME";
	$result = mysqli_query($connection, $query) or die(mysql_error()); 

	$name = "";
	$mon1 = "";
	$mon2 = "";
	$wed = "";
	$fri = "";

	while($player = mysqli_fetch_assoc($result))
	{
		$name .= "<td>".$player['LAST_NAME']."</td>";
		$mon1 .= "<td>".$player['MON_PRI']."</td>";
		$mon2 .= "<td>".$player['MON_ALT']."</td>";
		$wed .= "<td>".$player['WED']."</td>";
		$fri .= "<td>".$player['FRI']."</td>";
	}	

	echo
		"<table class=\"responsive tableCol\">
			<tbody>
				<tr id=\"names\">
					<th>PLAYER</th>
					".$name ."
				</tr>
				<tr>	
					<th>".$day['day1']."</br>".$course['day1']."</br>".$date['day1']." @ ".$tee['day1']."</br>".$count['day1']." players"."</th>
					".$mon1 ."
				</tr>

				<tr>
					<th>".$day['day2']."</br>".$course['day2']."</br>".$date['day2']." @ ".$tee['day2']."</br>".$count['day2']." players"."</th>	
					".$mon2 ."
				</tr>	
	
				<tr>
					<th>".$day['day3']."</br>".$course['day3']."</br>".$date['day3']." @ ".$tee['day3']."</br>".$count['day3']." players"."</th>
					".$wed ."
				</tr>	
	
				<tr>
					<th>".$day['day4']."</br>".$course['day4']."</br>".$date['day4']." @ ".$tee['day4']."</br>".$count['day4']." players"."</th>
					".$fri ."
				</tr>
			</tbody>
		</table>";
} 

function week3_table() 
{
	global $connection;

	//This code counts the number of players each day 
	$monpri_cnt=$monalt_cnt=$wed_cnt=$fri_cnt=0;

	$query = "SELECT * ";
	$query .= "FROM players2";
	$result = mysqli_query($connection, $query);
	if (!$result) 
	{
		die("Database query failed.");
	}

	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_PRI']=="YES") 
		{
			$monpri_cnt++;
		}
	}

	$query = "SELECT * ";
	$query .= "FROM players2";
	$result = mysqli_query($connection, $query) or die(mysql_error());		//Needed for each one
	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_ALT']=="YES")
		{
			$monalt_cnt++;
		}
	}

	$query = "SELECT * FROM players2";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['WED']=="YES") 
		{
			$wed_cnt++;
		}
	}

	$query = "SELECT * FROM players2";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['FRI']=="YES") 
		{
			$fri_cnt++;
		}
	}

	//Store the count in the table
	$query = "UPDATE player_count SET day1='$monpri_cnt',day2='$monalt_cnt',day3='$wed_cnt',day4='$fri_cnt'";
	mysqli_query($connection, $query); 
	//End of player count

	$query = "SELECT * FROM playdays";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$day = mysqli_fetch_array($result);

	$query = "SELECT * FROM course2";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$course = mysqli_fetch_array($result);

	$query = "SELECT * FROM play_date2";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$date = mysqli_fetch_array($result);

	$query = "SELECT * FROM teetime2";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$tee = mysqli_fetch_array($result);

	$query = "SELECT * FROM player_count";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$count = mysqli_fetch_array($result);

	$query = "SELECT * FROM players2 ORDER BY LAST_NAME";
	$result = mysqli_query($connection, $query) or die(mysql_error()); 

	$name = "";
	$mon1 = "";
	$mon2 = "";
	$wed = "";
	$fri = "";

	while($player = mysqli_fetch_assoc($result))
	{
		$name .= "<td>".$player['LAST_NAME']."</td>";
		$mon1 .= "<td>".$player['MON_PRI']."</td>";
		$mon2 .= "<td>".$player['MON_ALT']."</td>";
		$wed .= "<td>".$player['WED']."</td>";
		$fri .= "<td>".$player['FRI']."</td>";
	}	

	echo
		"<table class=\"responsive tableCol\">
			<tbody>
				<tr id=\"names\">
					<th>PLAYER</th>
					".$name ."
				</tr>
				<tr>	
					<th>".$day['day1']."</br>".$course['day1']."</br>".$date['day1']." @ ".$tee['day1']."</br>".$count['day1']." players"."</th>
					".$mon1 ."
				</tr>

				<tr>
					<th>".$day['day2']."</br>".$course['day2']."</br>".$date['day2']." @ ".$tee['day2']."</br>".$count['day2']." players"."</th>	
					".$mon2 ."
				</tr>	
	
				<tr>
					<th>".$day['day3']."</br>".$course['day3']."</br>".$date['day3']." @ ".$tee['day3']."</br>".$count['day3']." players"."</th>
					".$wed ."
				</tr>	
	
				<tr>
					<th>".$day['day4']."</br>".$course['day4']."</br>".$date['day4']." @ ".$tee['day4']."</br>".$count['day4']." players"."</th>
					".$fri ."
				</tr>
			</tbody>
		</table>";
} 

function week4_table() 
{
	global $connection;

	//This code counts the number of players each day 
	$monpri_cnt=$monalt_cnt=$wed_cnt=$fri_cnt=0;

	$query = "SELECT * ";
	$query .= "FROM players3";
	$result = mysqli_query($connection, $query);
	if (!$result) 
	{
		die("Database query failed.");
	}

	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_PRI']=="YES") 
		{
			$monpri_cnt++;
		}
	}

	$query = "SELECT * ";
	$query .= "FROM players3";
	$result = mysqli_query($connection, $query) or die(mysql_error());		//Needed for each one
	while($row = mysqli_fetch_array($result))
	{
		if ($row['MON_ALT']=="YES")
		{
			$monalt_cnt++;
		}
	}

	$query = "SELECT * FROM players3";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['WED']=="YES") 
		{
			$wed_cnt++;
		}
	}

	$query = "SELECT * FROM players3";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	while($row = mysqli_fetch_array($result))
	{
		if ($row['FRI']=="YES") 
		{
			$fri_cnt++;
		}
	}

	//Store the count in the table
	$query = "UPDATE player_count SET day1='$monpri_cnt',day2='$monalt_cnt',day3='$wed_cnt',day4='$fri_cnt'";
	mysqli_query($connection, $query); 
	//End of player count

	$query = "SELECT * FROM playdays";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$day = mysqli_fetch_array($result);

	$query = "SELECT * FROM course3";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$course = mysqli_fetch_array($result);

	$query = "SELECT * FROM play_date3";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$date = mysqli_fetch_array($result);

	$query = "SELECT * FROM teetime3";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$tee = mysqli_fetch_array($result);

	$query = "SELECT * FROM player_count";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$count = mysqli_fetch_array($result);

	$query = "SELECT * FROM players3 ORDER BY LAST_NAME";
	$result = mysqli_query($connection, $query) or die(mysql_error()); 

	$name = "";
	$mon1 = "";
	$mon2 = "";
	$wed = "";
	$fri = "";

	while($player = mysqli_fetch_assoc($result))
	{
		$name .= "<td>".$player['LAST_NAME']."</td>";
		$mon1 .= "<td>".$player['MON_PRI']."</td>";
		$mon2 .= "<td>".$player['MON_ALT']."</td>";
		$wed .= "<td>".$player['WED']."</td>";
		$fri .= "<td>".$player['FRI']."</td>";
	}	

	echo
		"<table class=\"responsive tableCol\">
			<tbody>
				<tr id=\"names\">
					<th>PLAYER</th>
					".$name ."
				</tr>
				<tr>	
					<th>".$day['day1']."</br>".$course['day1']."</br>".$date['day1']." @ ".$tee['day1']."</br>".$count['day1']." players"."</th>
					".$mon1 ."
				</tr>

				<tr>
					<th>".$day['day2']."</br>".$course['day2']."</br>".$date['day2']." @ ".$tee['day2']."</br>".$count['day2']." players"."</th>	
					".$mon2 ."
				</tr>	
	
				<tr>
					<th>".$day['day3']."</br>".$course['day3']."</br>".$date['day3']." @ ".$tee['day3']."</br>".$count['day3']." players"."</th>
					".$wed ."
				</tr>	
	
				<tr>
					<th>".$day['day4']."</br>".$course['day4']."</br>".$date['day4']." @ ".$tee['day4']."</br>".$count['day4']." players"."</th>
					".$fri ."
				</tr>
			</tbody>
		</table>";
} 

//End of Curr_Table function

function czarnames()
{
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM czarnames";
		$result = mysqli_query($connection, $query) or die(mysql_error());
		$czars = mysqli_fetch_assoc($result);

echo 
	
	"<h2>Current Czars</h2>
		<div class=\"half-column\">
			<h3>".$czars['czar1']."</h3>
			<h3>".$czars['czar2']."</h3>
			<h3>".$czars['czar3']."</h3>
		</div>
		<div class=\"half-column\">
			<h3>".$czars['czar4']."</h3>
			<h3>".$czars['czar5']."</h3>
			<h3>".$czars['czar6']."</h3>
		</div>";
}

//End of czarnames function

function week1_changes() 
{


	global $connection;

	//This piece of code is to allow schedule changes on Fri after cron
	$Halfday=43200;
	$query = "SELECT * FROM date_change_ts";
	$result = mysqli_query($connection, $query) or die(mysql_error());
	$row = mysqli_fetch_array($result);
	$Ts = $row['date_change_ts'];
	if (($Ts +$Halfday)> (strtotime("now")))
	{
		$hd_flag = "yes";
	}
	else {
		$hd_flag = "no";
	}

	$today = date("D");

	//This code makes sure that only 1 day ahead play days can be selected
	if (($today=="Fri") && ($hd_flag=="yes"))
	{		
		//Friday after the cron run
		echo "<div id=\"checkboxes\">
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_PRI\" value=\"YES\" class=\"regular-checkbox\"/>MON_PRI</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_ALT\" value=\"YES\" class=\"regular-checkbox\"/>MON_ALT</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";
	}
	elseif ($today=="Sat")
	{
		echo "<div id=\"checkboxes\">
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_PRI\" value=\"YES\" class=\"regular-checkbox\"/>MON_PRI</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_ALT\" value=\"YES\" class=\"regular-checkbox\"/>MON_ALT</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";
	}
	elseif (($today=="Mon") || ($today=="Sun")) 
	{
		echo "<div id=\"checkboxes\">
					<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";
	}
	elseif (($today=="Tue") || ($today=="Wed")) 
	{
	echo "<div id=\"checkboxes\"> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";
	} 

	if(isset($_POST['playdaz'])) 
	{

		$LastName=$_SESSION['LAST_NAME'];	

		$monpri = (isset($_POST['MON_PRI'])) ? "YES" :"NO";
		$monalt = (isset($_POST['MON_ALT'])) ? "YES" :"NO";
		$wed = (isset($_POST['WED'])) ? "YES" :"NO";
		$fri = (isset($_POST['FRI'])) ? "YES" :"NO";

		//Cannot select 2 courses on the same day
		if (($monpri =="NO") || ($monalt=="NO"))
		{		
			$LastName=$_SESSION['LAST_NAME'];		

			if (($today=="Fri") && ($hd_flag=="yes"))
			{	
				//Friday after the cron runs
				$query = "UPDATE players SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
				mysqli_query($connection, $query);
			}
			elseif ($today=="Sat")
			{
				$query = "UPDATE players SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
				mysqli_query($connection, $query);
			}
			elseif (($today=="Mon")||($today=="Sun"))
			{
				$query = "UPDATE players SET WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
				mysqli_query($connection, $query);
			}
			elseif (($today=="Tue")||($today=="Wed"))
			{
				$query = "UPDATE players SET FRI='$fri' WHERE LAST_NAME='$LastName'";
				mysqli_query($connection, $query);
			}
		}
	}

	if (isset($_POST['goback']))
	{
		echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n";
		exit(96);
	}
}

function week2_changes() 
{
	global $connection;
//Friday after the cron run
echo "<div id=\"checkboxes\">
		<label class=\"tag\"><input type=\"checkbox\" name=\"MON_PRI\" value=\"YES\" class=\"regular-checkbox\"/>MON_PRI</label> 
		<label class=\"tag\"><input type=\"checkbox\" name=\"MON_ALT\" value=\"YES\" class=\"regular-checkbox\"/>MON_ALT</label> 
		<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
		<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
	</div>";

	if(isset($_POST['playdaz'])) 
	{

		$LastName=$_SESSION['LAST_NAME'];	

		$monpri= (isset($_POST['MON_PRI'])) ? "YES" :"NO";
		$monalt= (isset($_POST['MON_ALT'])) ? "YES" :"NO";
		$wed= (isset($_POST['WED'])) ? "YES" :"NO";
		$fri= (isset($_POST['FRI'])) ? "YES" :"NO";

		//Cannot select 2 courses on the same day
		if (($monpri =="NO")|| ($monalt=="NO"))
		{		
			$LastName=$_SESSION['LAST_NAME'];	
			$query = "UPDATE players1 SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
			mysqli_query($connection, $query);	
		}	
	}

	if (isset($_POST['goback']))
	{
		echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n";
		exit(96);
	}

}

function week3_changes() 
{
		//Friday after the cron run
		echo "<div id=\"checkboxes\">
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_PRI\" value=\"YES\" class=\"regular-checkbox\"/>MON_PRI</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_ALT\" value=\"YES\" class=\"regular-checkbox\"/>MON_ALT</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";

	global $connection;

	if(isset($_POST['playdaz'])) 
	{
		$LastName=$_SESSION['LAST_NAME'];	

		$monpri= (isset($_POST['MON_PRI'])) ? "YES" :"NO";
		$monalt= (isset($_POST['MON_ALT'])) ? "YES" :"NO";
		$wed= (isset($_POST['WED'])) ? "YES" :"NO";
		$fri= (isset($_POST['FRI'])) ? "YES" :"NO";

		//Cannot select 2 courses on the same day
		if (($monpri =="NO")|| ($monalt=="NO"))
		{		
			$LastName=$_SESSION['LAST_NAME'];	
			$query = "UPDATE players2 SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
			mysqli_query($connection, $query);	
		}	
	}

	if (isset($_POST['goback']))
	{
		echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n";
		exit(96);
	}
}

function week4_changes() 
{

		//Friday after the cron run
		echo "<div id=\"checkboxes\">
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_PRI\" value=\"YES\" class=\"regular-checkbox\"/>MON_PRI</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"MON_ALT\" value=\"YES\" class=\"regular-checkbox\"/>MON_ALT</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"WED\" value=\"YES\" class=\"regular-checkbox\" />WED</label> 
					<label class=\"tag\"><input type=\"checkbox\" name=\"FRI\" value=\"YES\" class=\"regular-checkbox\" />FRI</label>
				</div>";
	global $connection;

	if(isset($_POST['playdaz'])) 
	{
		$LastName=$_SESSION['LAST_NAME'];	

		$monpri= (isset($_POST['MON_PRI'])) ? "YES" :"NO";
		$monalt= (isset($_POST['MON_ALT'])) ? "YES" :"NO";
		$wed= (isset($_POST['WED'])) ? "YES" :"NO";
		$fri= (isset($_POST['FRI'])) ? "YES" :"NO";

		//Cannot select 2 courses on the same day
		if (($monpri =="NO")|| ($monalt=="NO"))
		{		
			$LastName=$_SESSION['LAST_NAME'];	
			$query = "UPDATE players3 SET MON_PRI='$monpri',MON_ALT='$monalt',WED='$wed',FRI='$fri' WHERE LAST_NAME='$LastName'";
			mysqli_query($connection, $query);	
		}	
	}

	if (isset($_POST['goback']))
	{
		echo "<meta http-equiv='refresh' content='1;url=/play1.php'>\n";
		exit(96);
	}

}

