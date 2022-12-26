<?php
session_start();
require("check_login.php");
require('header.php');
require('connection.php');

$query_show = "SELECT birthdate FROM tbl_customers cus";
$result_show = mysqli_query($db, $query_show);

$count12_24 = 0;
$count24_36 = 0;
$count36_48 = 0;
$count48_60 = 0;
$count60_72 = 0;
$count72_84 = 0;
$count84up = 0;


while ($list_show = mysqli_fetch_array($result_show)) {
	$birthday = $list_show["birthdate"];
	$parts = explode('-', $birthday);
	$birthyear = $parts[0] . '<br>';
	$now = 2022;
	$age = $now - intval($birthyear);
	if ($age < 25) {
		$count12_24 += 1;
	} elseif ($age < 37) {
		$count24_36 += 1;
	} elseif ($age < 49) {
		$count36_48 += 1;
	} elseif ($age < 61) {
		$count48_60 += 1;
	} elseif ($age < 73) {
		$count60_72 += 1;
	} elseif ($age < 85) {
		$count72_84 += 1;
	} else {
		$count84up += 1;
	}
	//echo $age.'<br>';
}

$dataPoints = array(
	array("label" => "Age:12-24", "y" => $count12_24),
	array("label" => "Age:24-36", "y" => $count24_36),
	array("label" => "Age:36-48", "y" => $count36_48),
	array("label" => "Age:48-60", "y" => $count48_60),
	array("label" => "Age:60-72", "y" => $count60_72),
	array("label" => "Age:72-84", "y" => $count72_84),
	array("label" => "etc", "y" => $count84up)
)

?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>stats</title>

	<style>
		table {
			border-collapse: collapse;
			width: 1000;
		}

		tr,
		td {
			background-color: whitesmoke;
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #DDD;
		}

		td:hover {
			background-color: maroon;
			color: white
		}
	</style>

	<fieldset>

	<legend>
		<h2> IE Night 2022 Statistics  </h2>
	</legend>

	<?php

	$query =
		"SELECT cus.intania as cus_year,count(cus.intania) as freq
		FROM tbl_customers cus
		GROUP BY cus.intania
		ORDER BY count(cus.intania) DESC
		LIMIT 10 ;";

		$result = mysqli_query($db, $query);
	?>

	<br>

		<script>
			window.onload = function() {


				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					title: {
						text: "IE Night 2022"
					},
					subtitles: [{
						text: "Member Registered"
					}],
					data: [{
						type: "pie",
						yValueFormatString: "#,##0.00\"%\"",
						indexLabel: "{label} ({y})",
						dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
					}]
				});
				chart.render();

			}
		</script>
</head>

<body>
	<br><br>

	<div id="chartContainer" style="height: 400px; width: 100%;"></div>
	<div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</div>

	<br>
	<br>

	<div>
		<h2 style='color: maroon' > * TOP MEMBER REGISTERED  *</h2>
		<table>
			<?php
			$ranking = 1;
			echo ("");
			while ($list_show = mysqli_fetch_array($result)) {
				$cus_year = $list_show["cus_year"];
				$cus_freq = $list_show["freq"];

				echo ("<td><center>
						<h2>  #$ranking </h2>
						<h4><I>INTANIA</I></h4>
						<h2>$cus_year</h2><br>
						</center>
					</td>"
				);
				$ranking += 1;
			}


			?>
		</table>
	</div>
	
	<br>
	<br>
	<h3><a  href='./ie_night_detail.php' style="color:blue;">Back</a>

</body>

</html>