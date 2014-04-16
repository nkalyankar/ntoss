<?php
include ('config.php');
?>
<?php
session_start();
//checks if the login session is true
if (!isset($_SESSION['username']))
{
    header("location:index.php");
}
$username = $_SESSION['username'];
?>
<!-- Le styles -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<?php
//List of state codes
$states = array(
    "ALABAMA" => "AL",
    "ALASKA" => "AK",
    "ARIZONA" => "AZ",
    "ARKANSAS" => "AR",
    "CALIFORNIA" => "CA",
    "COLORADO" => "CO",
    "CONNECTICUT" => "CT",
    "DELAWARE" => "DE",
    "DISTRICT OF COLUMBIA" => "DC",
    "FLORIDA" => "FL",
    "GEORGIA" => "GA",
    "HAWAII" => "HI",
    "IDAHO" => "ID",
    "ILLINOIS" => "IL",
    "INDIANA" => "IN",
    "IOWA" => "IA",
    "KANSAS" => "KS",
    "KENTUCKY" => "KY",
    "LOUISIANA" => "LA",
    "MAINE" => "ME",
    "MONTANA" => "MT",
    "NEBRASKA" => "NE",
    "NEVADA" => "NV",
    "NEW HAMPSHIRE" => "NH",
    "NEW JERSEY" => "NJ",
    "NEW MEXICO" => "NM",
    "NEW YORK" => "NY",
    "NORTH CAROLINA" => "NC",
    "NORTH DAKOTA" => "ND",
    "OHIO" => "OH",
    "OKLAHOMA" => "OK",
    "OREGON" => "OR",
    "MARYLAND" => "MD",
    "MASSACHUSETTS" => "MA",
    "MICHIGAN" => "MI",
    "MINNESOTA" => "MN",
    "MISSISSIPPI" => "MS",
    "MISSOURI" => "MO",
    "PENNSYLVANIA" => "PA",
    "RHODE ISLAND" => "RI",
    "SOUTH CAROLINA" => "SC",
    "SOUTH DAKOTA" => "SD",
    "TENNESSEE" => "TN",
    "TEXAS" => "TX",
    "UTAH" => "UT",
    "VEMONT" => "VT",
    "VIRGINIA" => "VA",
    "WASHINGTON" => "WA",
    "WEST VIRGINIA" => "WV",
    "WISCONSIN" => "WI",
    "WYOMING" => "WY"
);
$state = $_GET['state'];
$state = strtoupper($state);
echo $state . " - " . $states[$state];
$output = "<table class=\"table table-striped\">";
$query = mysql_query("SELECT vendor.vendor_name, address.city, address.zipcode FROM address LEFT JOIN vendor ON vendor.DUNS = address.DUNS where address.state=\"" . $states[$state] . "\" ORDER BY vendor.vendor_name");

for ($x = 0; $x < mysql_num_rows($query); $x++)
{
    $match = mysql_fetch_array($query);
    $output = $output . "<tr><td>" . $match['vendor_name'] . "<//td><td>" . $match['city'] . "<//td><td>" . $state . "<//td><td>" . $match['zipcode'] . "<//td><//tr>";
}
$output = $output . "<//table>";
echo $output;
?>