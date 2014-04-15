<?php
//place this code on top of all the pages which you need to authenticate

//--- Authenticate code begins here ---
session_start();
//checks if the login session is true
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
$username = $_SESSION['username'];

// --- Authenticate code ends here ---
?>

<?php
include ('header.php');
?>

<?php
//List of state codes
$states = "AL,AK,AZ,AR,CA,CO,CT,DE,DC,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,MD,MA,MI,MN,MS,MO,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY";
?>
<br/>

<div class="masthead">

	<h3 class="muted">NTOSS</h3>
</div>
<h3>Map for Number of Vendors grouped by State</h3>
<h5 class="muted">The database contains information of 133485 contracts with 8669 global vendors having 9725 locations. NAICS descriptions (655) and Product/Service Descriptions (1200) also available for filtering</h5>
<hr>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://d3js.org/topojson.v1.min.js"></script>
<script src="http://datamaps.github.io/scripts/datamaps.all.js"></script>
<div class="map" id="ntoss" style="position: relative; width: 1000px; height: 600px;"></div>
<script>

	var ntoss = new Datamap({
scope : 'usa',
element : document.getElementById('ntoss'),
geographyConfig : {
highlightBorderColor : '#bada55',
popupTemplate : function(geography, data) {
return '<div class="hoverinfo"><strong>' + geography.properties.name + '</strong> <br />Vendors:' + data.count + ' </div>'
},
highlightBorderWidth : 3
},

fills : {
'Very Low' : '#CCBC21',
'Low' : '#FFB910',
'High' : '#50B1FF',
'Very High' : '#21ADCC',
defaultFill : '#919988'
},
data : {

<?php $query = mysql_query("SELECT COUNT(duns) AS count,state FROM address GROUP BY state");
	$match_value = mysql_fetch_array($query);
	//				$data = array();

	$high = "High";
	$low = "Low";
	$veryhigh = "Very High";
	$verylow = "Very Low";

	$fill = "";

	$var = 1;

	for ($x = 0; $x < mysql_num_rows($query); $x++) {
		$match = mysql_fetch_array($query);
		if (strpos($states, $match['state']) === false) {

		} else {
			if ($var === 1) {
				if (intval($match['count']) < 20) {
					$fill = $verylow;
				} elseif (intval($match['count']) >= 20 & intval($match['count']) < 60) {
					$fill = $low;
				} elseif (intval($match['count']) >= 60 & intval($match['count']) < 150) {
					$fill = $high;
				} else {
					$fill = $veryhigh;
				}
				$outputjson = "\"" . $match['state'] . "\":" . "{\"fillKey\": \"" . $fill . "\",\"count\": " . intval($match['count']) . "}";
				echo $outputjson;
				$var = 2;
			} else {
				if (intval($match['count']) < 20) {
					$fill = $verylow;
				} elseif (intval($match['count']) >= 20 & intval($match['count']) < 60) {
					$fill = $low;
				} elseif (intval($match['count']) >= 60 & intval($match['count']) < 150) {
					$fill = $high;
				} else {
					$fill = $veryhigh;
				}
				$outputjson = "," . "\"" . $match['state'] . "\":" . "{\"fillKey\": \"" . $fill . "\",\"count\": " . intval($match['count']) . "}";
				echo $outputjson;
			}
		}
	}
?>
	}});
	ntoss.labels(); 
	ntoss.legend();
</script>

<div style="float:right">
	<a class="btn btn-info" href="settings.php" > Settings </a><a class="btn btn-danger logout" href="logout.php" > Logout</a>
</div>

<?php
include ('footer.php');
?>
