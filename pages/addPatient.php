<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO patienten (name,geburtstag,vk,medikation,notes,family) VALUES ('".$_POST['name']."','".$_POST['geburtstag']."','".$_POST['vk']."','".$_POST['medikation']."','".$_POST['notes']."','".$_POST['family']."');";
		if ($conn->query($sql) === TRUE) {
			?>
				<div class="alert alert-outline-success mg-b-0" role="alert">
					<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>Well done!</strong> Patient wurde angelegt.
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
		<form class="form-horizontal" action="?p=addPatient" method="POST">
			<div class="d-flex flex-row">
				<div class="col-xl-6">
					<div class="form-group">
						<label>Vorname Nachname</label>
						<input type="text" class="form-control" placeholder="Vorname Nachname" name="name" required>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="form-group">
						<label>Geburtsdatum</label>
						<input type="date" class="form-control" name="geburtstag" required>
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-6">
					<div class="form-group">
						<label>Vorerkrankungen</label>
						<input type="text" class="form-control" placeholder="Asthma, Hepatitis A/B/C, etc..." name="vk">
					</div>
				</div>
				<div class="col-xl-6">
					<div class="form-group">
						<label>Medikamente</label>
						<input type="text" class="form-control" placeholder="ASS, Levetiracetam" name="medikation">
					</div>
				</div>
			</div>
			<div class="d-flex flex-row">
				<div class="col-xl-6">
					<div class="form-group">
						<label>Zugehörigkeit</label>
						<input type="text" class="form-control" placeholder="Crips / Bloods / Cops / etc..." name="family">
					</div>
				</div>
				<div class="col-xl-6">
					<div class="form-group">
						<label>Sonstige Bemerkungen</label>
						<input type="text" class="form-control" name="notes">
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