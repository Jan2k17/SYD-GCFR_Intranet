<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(!isset($_GET['id'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php?p=patienten">';
		exit;
	}
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO patienten_eintragungen 
			(patient,ersteller,aufnahmezeit,einsatzbeginn,einsatzende,einsatzort,einsatzmittel,einsatzkrafte,ak1,k1_0_0,k1_1_0,k1_1_1,ak2,k2_0_0,k2_1_0,k2_1_1,ak3,k3_0_0,k3_1_0,k3_1_1,ak4,k4_0_0,k4_1_0,k4_1_1,ak5,k5_0_0,k5_1_0,k5_1_1,ak6,k6_0_0,k6_1_0,k6_1_1,ak7,k7_0_0,k7_1_0,k7_1_1,ak8,k8_0_0,k8_1_0,k8_1_1,ak9,k9_0_0,k9_1_0,k9_1_1,ak10,k10_0_0,k10_1_0,k10_1_1,ak11,k11_0_0,k11_1_0,k11_1_1,ak12,k12_0_0,k12_1_0,k12_1_1,ak13,k13_0_0,k13_1_0,k13_1_1,ak14,k14_0_0,k14_1_0,k14_1_1,ak15,k15_0_0,k15_1_0,k15_1_1,situation) 
			VALUES 
			(
				'".$_GET['id']."',
				'".$_SESSION['dienstnummer']." - ".$_SESSION['name']."',
				'".$_POST['aufnahmezeit']."',
				'".$_POST['einsatzbeginn']."',
				'".$_POST['einsatzende']."',
				'".$_POST['einsatzort']."',
				'".$_POST['einsatzmittel']."',
				'".$_POST['einsatzkrafte']."',
				'".$_POST['ak1']."',
				'".$_POST['k1_0_0']."',
				'".$_POST['k1_1_0']."',
				'".$_POST['k1_1_1']."',
				'".$_POST['ak2']."',
				'".$_POST['k2_0_0']."',
				'".$_POST['k2_1_0']."',
				'".$_POST['k2_1_1']."',
				'".$_POST['ak3']."',
				'".$_POST['k3_0_0']."',
				'".$_POST['k3_1_0']."',
				'".$_POST['k3_1_1']."',
				'".$_POST['ak4']."',
				'".$_POST['k4_0_0']."',
				'".$_POST['k4_1_0']."',
				'".$_POST['k4_1_1']."',
				'".$_POST['ak5']."',
				'".$_POST['k5_0_0']."',
				'".$_POST['k5_1_0']."',
				'".$_POST['k5_1_1']."',
				'".$_POST['ak6']."',
				'".$_POST['k6_0_0']."',
				'".$_POST['k6_1_0']."',
				'".$_POST['k6_1_1']."',
				'".$_POST['ak7']."',
				'".$_POST['k7_0_0']."',
				'".$_POST['k7_1_0']."',
				'".$_POST['k7_1_1']."',
				'".$_POST['ak8']."',
				'".$_POST['k8_0_0']."',
				'".$_POST['k8_1_0']."',
				'".$_POST['k8_1_1']."',
				'".$_POST['ak9']."',
				'".$_POST['k9_0_0']."',
				'".$_POST['k9_1_0']."',
				'".$_POST['k9_1_1']."',
				'".$_POST['ak10']."',
				'".$_POST['k10_0_0']."',
				'".$_POST['k10_1_0']."',
				'".$_POST['k10_1_1']."',
				'".$_POST['ak11']."',
				'".$_POST['k11_0_0']."',
				'".$_POST['k11_1_0']."',
				'".$_POST['k11_1_1']."',
				'".$_POST['ak12']."',
				'".$_POST['k12_0_0']."',
				'".$_POST['k12_1_0']."',
				'".$_POST['k12_1_1']."',
				'".$_POST['ak13']."',
				'".$_POST['k13_0_0']."',
				'".$_POST['k13_1_0']."',
				'".$_POST['k13_1_1']."',
				'".$_POST['ak14']."',
				'".$_POST['k14_0_0']."',
				'".$_POST['k14_1_0']."',
				'".$_POST['k14_1_1']."',
				'".$_POST['ak15']."',
				'".$_POST['k15_0_0']."',
				'".$_POST['k15_1_0']."',
				'".$_POST['k15_1_1']."',
				'".$_POST['situation']."'
			);";
		if ($conn->query($sql) === TRUE) {
			?>
				<div class="alert alert-outline-success mg-b-0" role="alert">
					<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>Well done!</strong> Eintrag wurde angelegt.
				</div>
			<?php
		} else {
			?>
				<div class="alert alert-outline-danger mg-b-0" role="alert">
					<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
					<span aria-hidden="true">&times;</span></button>
					<strong>Oh snap!</strong> <?php echo "Error: " . $sql . "<br>" . $conn->error; ?>
				</div>
			<?php
		}
	}
?>
<div class="card custom-card">
	<div class="card-body">
		<form class="form-horizontal" action="?p=addEintrag&id=<?php echo $_GET['id']; ?>" method="POST">
			<div class="d-flex flex-row">
				<div class="col-xl-4">
					<div class="form-group">
						<label>Sachbearbeiter</label>
						<input type="text" class="form-control" placeholder="Dienstnummer, Vorname Nachname" name="ersteller" value="<?php echo $_SESSION['dienstnummer']." - ".$_SESSION['name']; ?>" disabled>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="form-group">
						<label>Beh&ouml;rde</label>
						<input type="text" class="form-control" name="behorde" value="GCFR" disabled>
					</div>
				</div>
				<div class="col-xl-4">
					<div class="form-group">
						<label>Aufnahmedatum</label>
						<input type="date" class="form-control" name="aufnahmezeit" required>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-6">
					<div class="form-group">
						<label>Einsatzbeginn (Uhrzeit)</label>
						<input type="time" class="form-control" name="einsatzbeginn" required>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="form-group">
						<label>Einsatzende (Uhrzeit)</label>
						<input type="time" class="form-control" name="einsatzende" required>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-12">
					<div class="form-group">
						<label>Einsatzort (Gel&auml;nde/Koordinaten etc)</label>
						<input type="text" class="form-control" name="einsatzort" required>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-6">
					<div class="form-group">
						<label>Eingesetzte Einsatzmittel</label>
						<input type="text" class="form-control" name="einsatzmittel" placeholder="z.B. Hawk, Shark, Ambulance, Engine, etc..." required>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="form-group">
						<label>Einsatzkräfte vor Ort</label>
						<input type="text" class="form-control" name="einsatzkrafte" placeholder="Nur Dienstnummern" required>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-12">
					<div class="form-group">
						<label>Verletzungen (Körperteil inkl. Anzahl)</label>
					</div>
				</div>
			</div>
			<?php
				$i = 1;
				while($i <= 15){
					?>
						<div class="d-flex flex-row">
							<div class="col-xl-3">
								<div class="form-group">
									<label>Anzahl</label>
									<input type="number" min="0" max="20" value="0" class="form-control" name="ak<?php echo $i; ?>" required>
								</div>
							</div>
							<div class="col-xl-3">
								<div class="form-group">
									<label>Größe</label>
									<select class="form-control select2" name="k<?php echo $i; ?>_0_0">
										<option label="-" selected>-/-</option>
										<option value="klein">
											Klein
										</option>
										<option value="mittel">
											Mittel
										</option>
										<option value="groß">
											Groß
										</option>
									</select>
								</div>
							</div>
							<div class="col-xl-3">
								<div class="form-group">
									<label>Art der Verletzung</label>
									<select class="form-control select2" name="k<?php echo $i; ?>_1_0">
										<option label="-" selected>
											-/-
										</option>
										<option value="prellung">
											Prellung
										</option>
										<option value="quetschung">
											Quetschung
										</option>
										<option value="kratzer">
											Kratzer
										</option>
										<option value="schnittwunde">
											Schnittwunde
										</option>
										<option value="stichwunde">
											Stichwunde
										</option>
										<option value="risswunde">
											Risswunde
										</option>
										<option value="avulsion">
											Avulsion
										</option>
										<option value="balltraume">
											Ballistisches Trauma
										</option>
										<option value="fraktur">
											Fraktur
										</option>
									</select>
								</div>
							</div>
							<div class="col-xl-3">
								<div class="form-group">
									<label>Körperteil</label>
									<select class="form-control select2" name="k<?php echo $i; ?>_1_1">
										<option label="-" selected>
											-/-
										</option>
										<option value="Kopf">
											Kopf
										</option>
										<option value="Torso">
											Torso
										</option>
										<option value="linker Arm">
											linker Arm
										</option>
										<option value="rechter Arm">
											rechter Arm
										</option>
										<option value="linkes Bein">
											linkes Bein
										</option>
										<option value="rechtes Bein">
											rechtes Beim
										</option>
									</select>
								</div>
							</div>
						</div>
					<?php
					$i += 1;
				}
			?>
			
			<div class="d-flex flex-row">
				<div class="col-xl-12">
					<div class="form-group">
						<label>Lagebild/Situationsbeschreibung</label>
						<textarea class="content5" name="situation"></textarea>
					</div>
				</div>
			</div>
			
			<div class="d-flex flex-row">
				<div class="col-xl-2">
					<button name="submit" class="btn ripple btn-main-primary btn-block">Anlegen</button>
				</div>
			</div>
		</form>
	</div>
</div>