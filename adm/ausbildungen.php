<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(!nav_granted("createausbildung", $_SESSION['dienstnummer'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	
	if(isset($_GET['create'])) {
		if(isset($_POST['submit'])){
			$ausbildung = $_POST['ausbildung'];
			
			$sql = "ALTER TABLE `ausbildungen` ADD `".$ausbildung."` TINYINT(4) NOT NULL DEFAULT '0';";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-outline-success mg-b-0" role="alert">
						<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Well done!</strong> Ausbildung wurde erstellt.
					</div>
				<?php
				echo '<meta http-equiv="refresh" content="2; URL=index.php?adm=ausbildungen">';
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
			<div class="row row-sm">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
					<div class="card custom-card">
						<form action="?adm=ausbildungen&create=y" method="POST">
							<div id="wizard1">
								<h3>Ausbildung erstellen</h3>
								<div class="d-flex flex-row">
									<div class="col-xl-3">
									</div>
									<div class="col-xl-6">
										<div class="form-group">
											<label>Ausbildung</label>
											<input type="text" class="form-control" name="ausbildung" placeholder="Bitte nur das Kürzel der Ausbildung verwenden">
										</div>
									</div>
									<div class="col-xl-3">
									</div>
								</div>
								<div class="d-flex flex-row">
									<div class="col-xl-3">
									</div>
									<div class="col-xl-1">
										<button name="submit" class="btn ripple btn-main-primary btn-block">ANLEGEN</button>
									</div>
									<div class="col-xl-8">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php
	} elseif (isset($_GET['list'])) {
		if (isset($_GET['delete'])) {
			$sql = "ALTER TABLE `ausbildungen` DROP COLUMN `".$_GET['delete']."`;";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-outline-success mg-b-0" role="alert">
						<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Well done!</strong> Ausbildung wurde gelöscht.
					</div>
				<?php
				echo '<meta http-equiv="refresh" content="2; URL=index.php?adm=ausbildungen">';
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
			<div class="row row-sm">
				<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
					<div class="card custom-card">
						<div class="card-header border-bottom-0 pb-0">
							<div class="d-flex justify-content-between">
								<label class="main-content-label mb-0 pt-1">Ausbildungen l&ouml;schen</label>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive border userlist-table">
								<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
									<thead>
										<tr>
											<th class="wd-lg-8p"><span>Löschen</span></th>
											<th class="wd-lg-8p"><span>Ausbildung</span></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SHOW COLUMNS FROM ausbildungen WHERE `Field` != 'id' AND `Field` != 'mitarbeiter';";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo '<tr>';
														echo '<td><a href="?adm=ausbildungen&list=y&delete='.$row['Field'].'"><i class="fe fe-trash-2"></i></a></th>';
														echo "<td>".$row['Field']."</th>";
													echo '<tr>';
												}
											}
										?>
									</tbody>
								</table>
							</div>
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
								<label class="main-content-label mb-0 pt-1">Ausbildungen</label>
								<div class="ms-auto float-end">
										<div class="">
											<!-- Ausbildung hinzufügen -->
											<a href="?adm=ausbildungen&create=y" class="btn btn-sm btn-success"><i class="fe fe-plus"></i></a>
											<!-- Ausbildungen auflisten -->
											<a href="?adm=ausbildungen&list=y" class="btn btn-sm btn-success"><i class="fe fe-list"></i></a>
										</div>
									</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive border userlist-table">
								<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
									<thead>
										<tr>
											<th class="wd-lg-8p"><span>Mitarbeiter</span></th>
											<?php
												$sql = "SHOW COLUMNS FROM ausbildungen WHERE `Field` != 'id' AND `Field` != 'mitarbeiter';";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														echo "<th class='wd-lg-8p'><span>".$row['Field']."</span></th>";
													}
												}
												
											?>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SELECT * FROM ausbildungen";
											$result = $conn->query($sql);
											
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													// SELECT * FROM patienten ORDER BY `name` DESC; // ORDER A-Z
													?>
														<tr>
															<td>
																<?php echo $row['mitarbeiter']; ?>
															</td>
															<?php
																foreach($row as $key => $value){
																	if($key != "id" && $key != "mitarbeiter"){
																		?>
																			<td>
																				<p>
																					<?php
																						if($value == 1){
																							echo '<span class="badge bg-success">Ja</span>';
																						} else {
																							echo '<span class="badge bg-secondary">Nein</span>';
																						}
																					?>
																				</p>
																			</td>
																		<?php
																	}
																}
															?>
															<td>
																<a href="?adm=users&name=<?php echo $row['mitarbeiter']; ?>" class="btn btn-sm btn-info">
																	<i class="fe fe-edit-2"></i>
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
?>