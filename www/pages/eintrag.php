<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
	if(!isset($_GET['eid'])){
		header('Location: index.php?p=patienten');
	}
?>
<div class="header">
	<div class="left">
	<h1>Eintrag erstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ PATIENTEN / 
			<li><a href="#" class="active">Eintrag ansehen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<div class="orders">
		<!--<div class="header">
			<i class="bx bx-receipt"></i>
			<h3>-</h3>
			<i class="bx bx-filter"></i>
			<i class="bx bx-search"></i>
		</div>-->
		<?php
			$sql = "SELECT * FROM patienten_eintragungen WHERE id = '".$_GET['eid']."';";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					?>
						<table>
							<thead>
								<tr>
									<th>Sachbearbeiter</th>
									<th>Beh&ouml;rde</th>
									<th>Aufnahmedatum u. -zeit</th>
									<th>Berichtart</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['ersteller']; ?></td>
									<td>GCFR</td>
									<td><?php echo $row['aufnahmezeit']; ?></td>
									<td><?php echo $row['berichtart']; ?></td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th>Einsatzbeginn</th>
									<th>Einsatzende</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['einsatzbeginn']; ?></td>
									<td><?php echo $row['einsatzende']; ?></td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th>Patient</th>
									<th>Einsatzort</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['patient']; ?></td>
									<td><?php echo $row['einsatzort']; ?></td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th>Einsatzmittel</th>
									<th>Einsatzkräfte</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['einsatzmittel']; ?></td>
									<td><?php echo $row['einsatzkrafte']; ?></td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Art der Verletzung</th>
									<th>K&ouml;rperteil</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo "<span class='status pending'>".$row['ak1']."x</span> ".$row['k1_0_0']; ?></td>
									<td><?php echo $row['k1_1_0']; ?></td>
									<td><?php echo $row['k1_1_1']; ?></td>
								</tr>
								<tr>
									<td><?php echo "<span class='status pending'>".$row['ak2']."x</span> ".$row['k2_0_0']; ?></td>
									<td><?php echo $row['k2_1_0']; ?></td>
									<td><?php echo $row['k2_1_1']; ?></td>
								</tr>
								<tr>
									<td><?php echo "<span class='status pending'>".$row['ak3']."x</span> ".$row['k3_0_0']; ?></td>
									<td><?php echo $row['k3_1_0']; ?></td>
									<td><?php echo $row['k3_1_1']; ?></td>
								</tr>
								<tr>
									<td><?php echo "<span class='status pending'>".$row['ak4']."x</span> ".$row['k4_0_0']; ?></td>
									<td><?php echo $row['k4_1_0']; ?></td>
									<td><?php echo $row['k4_1_1']; ?></td>
								</tr>
								<tr>
									<td><?php echo "<span class='status pending'>".$row['ak5']."x</span> ".$row['k5_0_0']; ?></td>
									<td><?php echo $row['k5_1_0']; ?></td>
									<td><?php echo $row['k5_1_1']; ?></td>
								</tr>
							</tbody>
						</table>
						<table>
							<thead>
								<tr>
									<th>Lagebild/Situationsbeschreibung</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo $row['situation']; ?></td>
								</tr>
							</tbody>
						</table>
					<?php
				}
			}
		?>
	</div>
</div>