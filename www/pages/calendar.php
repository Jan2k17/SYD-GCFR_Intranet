<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
	include 'Calendar.php';
	
	$currentDate = date('Y-m-d');
	
	$calendar = new Calendar($currentDate);
	
	$sql = "SELECT * FROM events;";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$calendar->add_event($row["evt_text"], $row["evt_start"], $row["evt_dur"], $row["evt_color"], $row["evt_desc"]);
		}
	}
?>
<div class="header">
	<div class="left">
	<h1>Kalendar</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ 
			<li><a href="#" class="active">Kalendar</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<div class="orders">
		<?=$calendar?>
	</div>
</div>