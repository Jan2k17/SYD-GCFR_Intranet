<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	
	if(isset($_GET['id']) or isset($_GET['name'])) {
		if(isset($_GET['ausbildernotizen'])){
			$sql = "INSERT INTO ausbildernotizen (name,ersteller,notiz) 
				VALUES
				('".getNameByID($_GET['id'])."','".$_SESSION['dienstnummer']." - ".$_SESSION['name']."', '".$_POST['note']."')";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-outline-success mg-b-0" role="alert">
						<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Well done!</strong> Notiz wurde angelegt.
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
		if(isset($_GET['ausbildungen'])){
			?>
				<div class="row square">
					<div class="col-lg-12 col-md-12">
						<div class="card custom-card">
							<div class="card-body">
								<?php
									foreach ($_POST as $key => $value) {
										if($key != "submit"){
											$sql = "UPDATE ausbildungen SET `".$key."`='".$value."' WHERE  `mitarbeiter`='".$_GET['name']."'";
											if ($conn->query($sql) === TRUE) {
												echo "<br /><u>".$key."</u> wurde auf ".$value." gesetzt!<br />";
											} else {
												echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
											}
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php
		}
		$sql = "";
		if(isset($_GET['id'])){
			$sql = "SELECT * FROM mitarbeiter WHERE id = '".$_GET['id']."';";
		} else {
			$sql = "SELECT * FROM mitarbeiter WHERE name = '".$_GET['name']."';";
		}
		?>
						<div class="row square">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="panel profile-cover">
											<div class="profile-cover__img">
												<img src="../GCFRLogo.png" alt="img">
												<h3 class="h3">
													<?php
														if(isset($_GET['id'])){
															echo getByID($_GET['id']);
														} else {
															echo getByName($_GET['name']);
														}
													?>
												</h3>
											</div>
											<div class="profile-cover__action bg-img"></div>
											<div class="profile-cover__info">
												<ul class="nav">
													<li><strong>
														<?php
															if(isset($_GET['id'])){
																echo getCountPE_id(getByID($_GET['id']));
															} else {
																echo getCountPE_id(getByName($_GET['name']));
															}
														?>
													</strong>Medizinische Gutachten</li>
													<!-- <li><strong>X</strong>Einsatzberichte</li> -->
												</ul>
											</div>
                                        </div>
										<div class="profile-tab tab-menu-heading">
											<nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
												<a class="nav-link active" data-bs-toggle="tab" href="#allgemein">Allgemein</a>
												<a class="nav-link" data-bs-toggle="tab" href="#settings">Ausbildungen</a>
												<a class="nav-link" data-bs-toggle="tab" href="#ausbildernotizen">Ausbildernotiz erstellen</a>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card main-content-body-profile">
									<div class="tab-content">
										<div class="main-content-body  tab-pane border-top-0 active" id="allgemein">
											<div class="main-content-body main-content-body-profile">
												<div class="main-profile-body p-0">
													<div class="row row-sm">
														<div class="col-12">
															<!-- ausbildernotizen ANZEIGEN -->
															<?php
																$sql_v = "";
																if(isset($_GET['id'])){
																	$sql_v = "SELECT * FROM ausbildernotizen WHERE name = '".getNameByID($_GET['id'])."' ORDER BY `id` DESC;";
																} else {
																	$sql_v = "SELECT * FROM ausbildernotizen WHERE name = '".$_GET['name']."' ORDER BY `id` DESC;";
																}
																$result_v = $conn->query($sql_v);
																
																if ($result_v->num_rows > 0) {
																	while($row_v = $result_v->fetch_assoc()) {
																		?>
																			<div class="card border">
																				<div class="card-header p-4">
																					<div class="media">
																						<div class="media-user me-2">
																							<div class="main-img-user avatar-md"><img src="../GCFRLogo.png" alt="img"></div>
																						</div>
																						<div class="media-body">
																							<h6 class="mb-0 ms-2 mg-t-3">Erstellt von: <?php echo $row_v['ersteller']; ?></h6><span class="text-muted ms-2"><?php echo $row_v['angelegt']; ?></span>
																						</div>
																					</div>
																				</div>
																				<div class="card-body h-100">
																					<p class="mg-t-0"><?php echo $row_v['notiz']; ?></p>
																				</div>
																			</div>
																		<?php
																	}
																} else {
																	?>
																		<div class="card border">
																			<div class="card-header p-4">
																				<div class="media">
																					<div class="media-user me-2">
																						<div class="main-img-user avatar-md">
																							<i class="fe fe-slash"></i>
																						</div>
																					</div>
																					<div class="media-body">
																						<h6 class="mb-0 ms-2 mg-t-3">
																							keine Notizen vorhanden
																						</h6><span class="text-muted ms-2">0000-00-00 00:00:00</span>
																					</div>
																				</div>
																			</div>
																			<div class="card-body h-100">
																				<p class="mg-t-0">Keine Notizen vorhanden!</p>
																			</div>
																		</div>
																	<?php
																}
															?>
															<!-- ausbildernotizen ANZEIGEN -->
														</div>
													</div>
												</div>
												<!-- main-profile-body -->
											</div>
										</div>
										<div class="main-content-body tab-pane p-4 border-top-0" id="settings">
											<div class="card-body border" data-select2-id="12">
												<?php
													$user = "";
													if(isset($_GET['id'])){
														$user = "name=".getNameByID($_GET['id']);
													} else {
														$user = "name=".$_GET['name'];
													}
												?>
												<form class="form-horizontal" data-select2-id="11" action="?aus=users&<?php echo $user; ?>&ausbildungen=y" method="POST">
													<div class="mb-4 main-content-label">Ausbildungen bearbeiten</div>
													<?php
														$sql_aus = "";
														if(isset($_GET['id'])){
															$sql_aus = "SELECT * FROM ausbildungen WHERE mitarbeiter = '".getNameByID($_GET['id'])."';";
														} else {
															$sql_aus = "SELECT * FROM ausbildungen WHERE mitarbeiter = '".$_GET['name']."'";
														}
														$result_aus = $conn->query($sql_aus);
														if ($result_aus->num_rows > 0) {
															while($row_aus = $result_aus->fetch_assoc()) {
																foreach($row_aus as $key => $value){
																	if($key != "id" && $key != "mitarbeiter"){
																		?>
																			<div class="form-group">
																				<div class="title"><?php echo $key; ?></div>
																				<select name="<?php echo $key; ?>" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																					<?php
																						if($value == "1"){
																							echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																						} else {
																							echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																						}
																					?>
																				</select>
																			</div>
																		<?php
																	}
																}
															}
														}
													?>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-2"> </div>
															<div class="col-md-10">
																<button name="submit" class="btn ripple btn-main-primary btn-block">Speichern</button>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div class="main-content-body  tab-pane border-top-0" id="ausbildernotizen">
											<div class="main-content-body main-content-body-profile">
												<div class="main-profile-body p-0">
													<div class="row row-sm">
														<div class="col-12">
															<!-- ausbildernotizen ERSTELLEN -->
															<!-- max. 5 -->
															<!-- aktive = <i class="fe fe-slash"></i> -->
															<!-- inaktive = <i class="mdi mdi-alarm"></i> -->
															<?php
																$user = "";
																if(isset($_GET['id'])){
																	$user = "id=".$_GET['id'];
																} else {
																	$user = "id=".getUserID($_GET['name']);
																}
															?>
															<form class="form-horizontal" data-select2-id="11" action="?aus=users&<?php echo $user; ?>&ausbildernotizen=y" method="POST">
																<div class="mb-4 main-content-label">Ausbildernotiz erstellen</div>
																<div class="form-group ">
																	<div class="row row-sm">
																		<div class="col-md-3">
																			<label class="form-label">Notiz (Diese Notiz sieht der Mitarbeiter nicht)</label>
																		</div>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="note">
																		</div>
																	</div>
																</div>
																
																<div class="form-group ">
																	<div class="row row-sm">
																		<div class="col-md-2"> </div>
																		<div class="col-md-10">
																			<button name="submit" class="btn ripple btn-main-primary btn-block">Speichern</button>
																		</div>
																	</div>
																</div>
															</form>
															
															<!-- ausbildernotizen ERSTELLEN-->
														</div>
													</div>
												</div>
												<!-- main-profile-body -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
			
			
			
		<?php
	} else {}
?>