<?php
include 'Calendar.php';
$calendar = new Calendar('2023-11-01');
$calendar->add_event('Penis', '2023-11-01', 30, 'red');
//$calendar->add_event('Doctors', '2023-05-04', 1, 'red');
//$calendar->add_event('Holiday', '2023-05-16', 7);-
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Kalender</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>
