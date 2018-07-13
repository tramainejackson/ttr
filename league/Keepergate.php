<?php

function display_func($leagues)
{
	include ('../court.php');
	$my_leagues = $leagues;
	$connect = mysqli_connect($host, $db_username, $db_password, $db) or die("Unable to connect to server");
	$query3 = "SELECT * FROM `leagues_profile` WHERE `leagues_name` = '$my_leagues'";
	$results3 = mysqli_query($connect, $query3) or die ("Unable to run query results 3 ".mysql_error($connect));
	$row_cnt = mysqli_num_rows($results3);
			while($row3 = mysqli_fetch_assoc($results3))
			{
				$no_site = "None";
				echo "<div class=leagues_page_div>";
				echo "<ul id='league_stats'><li><a class='league_li schedule'>Schedule</a></li><li><a class='league_li standings'>Standings</a></li><li><a class='league_li stats'>Player Stats</a></li></ul>";
				echo "<table class=leagues_page_table>";
				echo "<tr><th>".$row3['leagues_name']."</th></tr>";
				if($row3['ttr_league'] == 'Y')
				{
					echo "<tr><td><button>Continue to leagues site</button></td></tr>";	
				}
				echo "<tr><td><b>League Owner:</b> ".$row3['leagues_commish']."</td></tr>";
				echo "<tr><td><b>Competition Level:</b> ".str_ireplace("_", "-", str_ireplace(" ", ", ", ucwords($row3['leagues_comp'])))."</td></tr>";
				echo "<tr><td><b>Leagues Age:</b> ".str_ireplace("_", " ", str_ireplace(" ", ", ", ucwords($row3['leagues_age'])))."</td></tr>";
				if($row3['leagues_fee'] > 0)
				{
					echo "<tr><td><b>Entry Fee:</b> $".$row3['leagues_fee']."</td></tr>";
				}
				else
				{
					echo "<tr><td><b>Entry Fee:</b> Call for more information</td></tr>";
				}
				if($row3['ref_fee'] > 0)
				{
					echo "<tr><td><b>Ref Fees per/g:</b> $".$row3['ref_fee']."</td></tr>";					
				}
				else
				{
					echo "<tr><td><b>Ref Fees per/g:</b> Call for more information</td></tr>";					
				}				
				
				if($row3['leagues_website'] == "")
				{
					echo "<tr><td><b>Website:</b> ".$no_site."</a></td></tr>";
				}
				else 
				{
					echo "<tr><td><b>Website:</b> <a href=http://".$row3['leagues_website']." target=_blank>".$row3['leagues_website']."</a></td></tr>";
				}
				
				echo "<tr><td><b>More Info:</b> ".$row3['leagues_phone']."</td></tr>";									
				echo "<tr><td><b>League Address:</b> ".$row3['leagues_address']."</td></tr>";	
				echo "</table>";
				if($row3['leagues_picture'] != "")
				{
					echo "<img id='my_leagues_photo' src=/images/".$row3['leagues_picture']."></div>";
				}	
			}
}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<title>My League</title>
<meta charset="UTF-8"/><meta name="keywords" content="Philly Basketball, Philadelphia Basketball, Rec Centers, Basketball, Philly Hoops"/>
<meta name="description" content="Philadelphia Basketball Players, Leagues and Rec Centers"/>
<meta name="description" content="Where to play basketball in philly"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="author" content="Guru"/>
<link rel="stylesheet" type="text/css" href="/css/style.css"/>
</head>
<body>
<?php include('../modal.php');
$league_name = "Keepergate";
display_func($league_name);
?>
</div>
<script src='/scripts/jquery-2.1.1.js'>
</script><script src='/scripts/totherec_leagues.js'></script>
</body>
</html>