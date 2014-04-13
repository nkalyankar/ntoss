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
$query1 = mysql_query("SELECT * FROM users WHERE username='$username'");
$match_value = mysql_fetch_array($query1);
$firstname = $match_value['firstname'];
$lastname = $match_value['lastname'];
$email = $match_value['email'];

$states = "AL,AK,AZ,AR,CA,CO,CT,DE,DC,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,MD,MA,MI,MN,MS,MO,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY";
//retrieve state information and create json
$query = mysql_query("SELECT COUNT(duns) AS count,state FROM address GROUP BY state");
$match_value = mysql_fetch_array($query);
$data = array();

for ($x = 0; $x < mysql_num_rows($query); $x++) {
	$match = mysql_fetch_array($query);
	if (strpos($states, $match['state']) === false) {

	} else {

		$count = array("fillKey" => "Republican", "count" => intval($match['count']));
		$state = array($match['state'] => $count);
		$data[] = $state;
	}
}
?>
<br/>
<div style="float:right"> <a class="btn btn-info" href="settings.php" > Settings </a>  <a class="btn btn-danger logout" href="logout.php" > Logout</a> </div>


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
			'High' : '#FFA60D',
			'Low' : '#E8540C',
			'Very Low' : '#FF0000',
			'Very High' : '#5B0DFF',
			defaultFill : '#EDDC4E'
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
							//							$counter = array("fillKey" => "Republican", "count" => intval($match['count']));
							//							$state = array($match['state'] => $counter);
							//echo "\"" . $match['state'] . "\":" . "{\"fillKey\": \"Republican\",\"count\": " . intval($match['count']) . "}";
							if(intval($match['count'])<20)
							{
								$fill = $verylow;
							}
							elseif (intval($match['count'])>=20 & intval($match['count'])<60) {
								$fill = $low;
							}
							elseif (intval($match['count'])>=60 & intval($match['count'])<150) {
								$fill = $high;
							}
							else {
								$fill = $veryhigh;
							}
							$outputjson = "\"" . $match['state'] . "\":" . "{\"fillKey\": \"" . $fill . "\",\"count\": " . intval($match['count']) . "}";
							echo $outputjson;
							//							$data[] = $state;
							$var = 2;
						} else {
							//							$counter = array("fillKey" => "Republican", "count" => intval($match['count']));
							//							$state = array($match['state'] => $counter);
							if(intval($match['count'])<20)
							{
								$fill = $verylow;
							}
							elseif (intval($match['count'])>=20 & intval($match['count'])<60) {
								$fill = $low;
							}
							elseif (intval($match['count'])>=60 & intval($match['count'])<150) {
								$fill = $high;
							}
							else {
								$fill = $veryhigh;
							}
							$outputjson = "," . "\"" . $match['state'] . "\":" . "{\"fillKey\": \"" . $fill . "\",\"count\": " . intval($match['count']) . "}";
							echo $outputjson;
							//							$data[] = $state;
						}
					}
				}
	?>
		}});
		ntoss.labels();
</script>
<?php
include ('footer.php');
 ?> 