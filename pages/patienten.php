<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_GET['id'])) {
		if(isset($_GET['akte'])){
			?>
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card custom-card">
							<div class="card-body">
								<?php
									$sql = "SELECT * FROM patienten_eintragungen WHERE id = '".$_GET['akte']."'";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											?>
												<div class="d-flex">
													<div class="col-md-4 border">
														<b>Sachbearbeiter</b><br />
														<?php echo $row['ersteller']; ?>
													</div>
													<div class="col-md-4 border">
														<b>Beh&ouml;rde</b><br />
														GCFR
													</div>
													<div class="col-md-4 border">
														<b>Aufnahmedatum</b><br />
														<?php echo $row['aufnahmezeit']; ?>
													</div>
												</div>
												<div class="d-flex">
													<div class="col-md-4 border">
														<b>Einsatzort</b><br />
														<?php echo $row['einsatzort']; ?>
													</div>
													<div class="col-md-4 border">
														<b>Einsatzbeginn</b><br />
														<?php echo $row['einsatzbeginn']; ?>
													</div>
													<div class="col-md-4 border">
														<b>Einsatzende</b><br />
														<?php echo $row['einsatzende']; ?>
													</div>
												</div>
												<div class="d-flex">
													<div class="col-md-6 border">
														<b>Eingesetzte Einsatzmittel</b><br />
														<?php echo $row['einsatzmittel']; ?>
													</div>
													<div class="col-md-6 border">
														<b>Eingesetzte Einsatzkr&auml;fte</b><br />
														<?php echo $row['einsatzkrafte']; ?>
													</div>
												</div>
												<div class="d-flex">
													<div class="col-md-12">
														<b>&nbsp;</b>
													</div>
												</div>
												<div class="d-flex">
													<div class="col-md-12">
														<b>Verletzungen (Körperteil inkl. Anzahl)</b>
													</div>
												</div>
												<?php
													$i = 1;
													while($i <= 15){
														if($row['ak'.$i] > 0){
															?>
																<div class="d-flex">
																	<div class="col-md-3 border">
																		<b>Anzahl</b><br />
																		<?php echo $row['ak'.$i]; ?>
																	</div>
																	<div class="col-md-3 border">
																		<b>Gr&ouml;ße</b><br />
																		<?php echo $row['k'.$i.'_0_0']; ?>
																	</div>
																	<div class="col-md-3 border">
																		<b>Art der Verletzungen</b><br />
																		<?php echo $row['k'.$i.'_1_0']; ?>
																	</div>
																	<div class="col-md-3 border">
																		<b>K&ouml;rperteil</b><br />
																		<?php echo $row['k'.$i.'_1_1']; ?>
																	</div>
																</div>
															<?php
														}
														$i += 1;
													}
												?>
												<div class="d-flex">
													<div class="col-md-12 border">
														<b>Lagebild/Situationsbeschreibung</b><br />
														<br />
														<?php echo $row['situation']; ?>
													</div>
												</div>
											<?php
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php
		} else {
			?>
				<div class="row row-sm">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
						<div class="card custom-card">
							<div class="card-header border-bottom-0 pb-0">
								<div class="d-flex justify-content-between">
									<label class="main-content-label mb-0 pt-1">Patientenliste</label>
									<div class="ms-auto float-end">
										<div class="">
											<?php if(nav_granted("addpateintrag", $_SESSION['dienstnummer'])){ echo '<a href="?p=addEintrag&id='.$_GET['id'].'" class="btn btn-sm btn-success"><i class="fe fe-plus"></i></a>'; } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive border userlist-table">
									<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
										<thead>
											<tr>
												<th class="wd-lg-20p"><span>Ersteller</span></th>
												<th class="wd-lg-20p"><span>eingetragen</span></th>
												<th class="wd-lg-20p"><span>Aufnahmezeit</span></th>
												<th class="wd-lg-20p"><span>Einsatzort</span></th>
												<th class="wd-lg-8p"><span></span></th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sql = "SELECT * FROM patienten_eintragungen WHERE patient = '".$_GET['id']."' ORDER BY `id` ASC";
												$result = $conn->query($sql);
												
												if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														?>
															<tr>
																<td>
																	<?php echo $row['ersteller']; ?>
																</td>
																<td>
																	<?php echo $row['eingetragen']; ?>
																</td>
																<td>
																	<?php echo $row['aufnahmezeit']; ?>
																</td>
																<td>
																	<?php echo $row['einsatzort']; ?>
																</td>
																<td>
																	<a href="?p=patienten&id=<?php echo $_GET['id']."&akte=".$row['id']; ?>" class="btn btn-sm btn-primary">
																		<i class="fe fe-search"></i>
																	</a>
																</td>
															</tr>
														<?php
													}
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div><!-- COL END -->
				</div>
			<?php
		}
	} elseif(isset($_GET['edit'])) {
		if(isset($_POST['submit'])){
			$sql = "UPDATE patienten SET `notes`='".$_POST['notes']."', `name`='".$_POST['name']."',`geburtstag`='".$_POST['geburtstag']."',`vk`='".$_POST['vk']."',`medikation`='".$_POST['medikation']."' WHERE  `id`='".$_GET['edit']."';";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-outline-success mg-b-0" role="alert">
						<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Well done!</strong> Patient wurde bearbeitet.
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
		$sql = "SELECT * FROM patienten WHERE id = '".$_GET['edit']."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				?>
					<div class="card custom-card">
						<div class="card-body">
							<form class="form-horizontal" action="?p=patienten&edit=<?php echo $_GET['edit']; ?>" method="POST">
								<div class="d-flex flex-row">
									<div class="col-xl-6">
										<div class="form-group">
											<label>Vorname Nachname</label>
											<input type="text" class="form-control" placeholder="Vorname Nachname" value="<?php echo $row['name']; ?>" name="name" required>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label>Geburtsdatum</label>
											<input type="date" class="form-control" name="geburtstag" value="<?php echo $row['geburtstag']; ?>" required>
										</div>
									</div>
								</div>
								<div class="d-flex flex-row">
									<div class="col-xl-6">
										<div class="form-group">
											<label>Vorerkrankungen</label>
											<input type="text" class="form-control" placeholder="Asthma, Hepatitis A/B/C, etc..." value="<?php echo $row['vk']; ?>" name="vk">
										</div>
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label>Medikamente</label>
											<input type="text" class="form-control" placeholder="ASS, Levetiracetam" value="<?php echo $row['medikation']; ?>" name="medikation">
										</div>
									</div>
								</div>
								<div class="d-flex flex-row">
									<div class="col-xl-12">
										<div class="form-group">
											<label>Sonstige Bemerkungen</label>
											<input type="text" class="form-control" value="<?php echo $row['notes']; ?>" name="notes">
										</div>
									</div>
								</div>
								<div class="d-flex flex-row">
									<div class="col-xl-2">
										<button name="submit" class="btn ripple btn-main-primary btn-block">Speichern</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				<?php
			}
		}
	} else {
		?>
			<div class="row row-sm">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
					<div class="card custom-card">
						<div class="card-header border-bottom-0 pb-0">
							<div class="d-flex justify-content-between">
								<label class="main-content-label mb-0 pt-1">Patientenliste</label>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive border userlist-table">
								<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
									<thead>
										<tr>
											<th class="wd-lg-20p"><span>Name</span></th>
											<th class="wd-lg-20p"><span>Geburtstag</span></th>
											<th class="wd-lg-20p"><span>Vorerkrankungen</span></th>
											<th class="wd-lg-8p"><span></span></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SELECT * FROM patienten";
											$result = $conn->query($sql);
											
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													// SELECT * FROM patienten ORDER BY `name` DESC; // ORDER A-Z
													?>
														<tr>
															<td>
																<?php echo $row['name']; ?>
															</td>
															<td>
																<?php echo $row['geburtstag']; ?>
															</td>
															<td>
																<?php echo $row['vk']; ?>
															</td>
															<td>
																<a href="?p=patienten&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
																	<i class="fe fe-search"></i>
																</a>
																<?php if(nav_granted("addpatient", $_SESSION['dienstnummer'])){ echo '<a href="?p=patienten&edit='.$row['id'].'" class="btn btn-sm btn-info"><i class="fe fe-edit-2"></i></a>'; } ?>
															</td>
														</tr>
													<?php
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- COL END -->
			</div>
		<?php
	}
?>