<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(!nav_granted("addmitar", $_SESSION['dienstnummer'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	
	if(isset($_GET['id']) or isset($_GET['name'])) {
		if(isset($_GET['verwarnung'])){
			$sql = "INSERT INTO verwarnungen (name,ersteller,gultigbis,notiz1,notiz2) 
				VALUES
				('".getNameByID($_GET['id'])."','".$_SESSION['dienstnummer']." - ".$_SESSION['name']."','".$_POST['gultigbis']."', '".$_POST['note2crew']."', '".$_POST['note']."')";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="alert alert-outline-success mg-b-0" role="alert">
						<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Well done!</strong> Verwarnung wurde angelegt.
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
												<a class="nav-link" data-bs-toggle="tab" href="#verwarnung">Verwarnen</a>
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
															<!-- VERWARNUNGEN ANZEIGEN -->
															<?php
																$sql_v = "";
																if(isset($_GET['id'])){
																	$sql_v = "SELECT * FROM verwarnungen WHERE name = '".getNameByID($_GET['id'])."' ORDER BY `id` DESC;";
																} else {
																	$sql_v = "SELECT * FROM verwarnungen WHERE name = '".$_GET['name']."' ORDER BY `id` DESC;";
																}
																$result_v = $conn->query($sql_v);
																
																if ($result_v->num_rows > 0) {
																	while($row_v = $result_v->fetch_assoc()) {
																		?>
																			<div class="card border">
																				<div class="card-header p-4">
																					<div class="media">
																						<div class="media-user me-2">
																							<div class="main-img-user avatar-md">
																								<?php
																									$date1 = new DateTime($row_v['gultigbis']);
																									$date2 = new DateTime();
																									if ($date1 > $date2) {
																										echo '<i class="mdi mdi-alarm"></i>';
																									} else {
																										echo '<i class="fe fe-slash"></i>';
																									}
																								?>
																							</div>
																						</div>
																						<div class="media-body">
																							<h6 class="mb-0 ms-2 mg-t-3">
																								<?php
																									$date1 = new DateTime($row_v['gultigbis']);
																									$date2 = new DateTime();
																									if ($date1 > $date2) {
																										echo 'aktive Verwarnung';
																									} else {
																										echo 'inaktive Verwarnung';
																									}
																								?>
																							</h6><span class="text-muted ms-2"><?php echo $row_v['angelegt']; ?></span>
																						</div>
																					</div>
																				</div>
																				<div class="card-body h-100">
																					<p class="mg-t-0"><?php echo $row_v['notiz2']; ?></p>
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
																							keine Verwarnungen vorhanden
																						</h6><span class="text-muted ms-2">0000-00-00 00:00:00</span>
																					</div>
																				</div>
																			</div>
																			<div class="card-body h-100">
																				<p class="mg-t-0">Du hast bisher keine Verwarnungen erhalten!</p>
																			</div>
																		</div>
																	<?php
																}
															?>
															<!-- VERWARNUNGEN ANZEIGEN -->
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
												<form class="form-horizontal" data-select2-id="11" action="?adm=users&<?php echo $user; ?>&ausbildungen=y" method="POST">
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
										<div class="main-content-body  tab-pane border-top-0" id="verwarnung">
											<div class="main-content-body main-content-body-profile">
												<div class="main-profile-body p-0">
													<div class="row row-sm">
														<div class="col-12">
															<!-- VERWARNUNGEN ERSTELLEN -->
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
															<form class="form-horizontal" data-select2-id="11" action="?adm=users&<?php echo $user; ?>&verwarnung=y" method="POST">
																<div class="mb-4 main-content-label">Verwarnung erstellen</div>
																<div class="form-group ">
																	<div class="row row-sm">
																		<div class="col-md-3">
																			<label class="form-label">G&uuml;ltig bis</label>
																		</div>
																		<div class="col-md-9">
																			<input type="date" class="form-control" name="gultigbis">
																		</div>
																	</div>
																</div>
																<div class="form-group ">
																	<div class="row row-sm">
																		<div class="col-md-3">
																			<label class="form-label">Notiz an Mitarbeiter</label>
																		</div>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="note2crew">
																		</div>
																	</div>
																</div>
																<div class="form-group ">
																	<div class="row row-sm">
																		<div class="col-md-3">
																			<label class="form-label">Interne Notiz (Diese Notiz sieht der Mitarbeiter nicht)</label>
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
															
															<!-- VERWARNUNGEN ERSTELLEN-->
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
	} elseif(isset($_GET['create'])) {
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$dienstnummer = $_POST['dienstnummer'];
			$rang = $_POST['rang'];
			$passwort = md5("syd-gcfr");
			
			$sql = "INSERT INTO mitarbeiter (dienstnummer,name,rang,passwort) VALUES ('$dienstnummer','$name','$rang','$passwort');";
			if ($conn->query($sql) === TRUE) {
				$sql2 = "INSERT INTO ausbildungen (mitarbeiter) VALUES ('$name');";
				if ($conn->query($sql2) === TRUE) {
					?>
						<div class="alert alert-outline-success mg-b-0" role="alert">
							<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Well done!</strong> Mitarbeiter wurde angelegt.
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
						<form action="?adm=users&create=y" method="POST">
							<div id="wizard1">
								<h3>Mitarbeiter erstellen</h3>
								<div class="d-flex flex-row">
									<div class="col-xl-3">
									</div>
									<div class="col-xl-2">
										<div class="form-group">
											<label>Dienstnummer</label>
											<input type="number" min="1" max="99" value="10" class="form-control" name="dienstnummer">
										</div>
									</div>
									<div class="col-xl-2">
										<div class="form-group">
											<label>Vorname Nachname</label>
											<input type="text" class="form-control" placeholder="Max Mustermann" name="name">
										</div>
									</div>
									<div class="col-xl-2">
										<div class="form-group">
											<label>Rang</label>
											<input type="number" min="1" max="99" class="form-control" value="1" name="rang">
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
	} elseif(isset($_GET['resetpw'])) {
		reset_password($_GET['resetpw']);
		?>
			<div class="col-md-7 mx-auto">
				<div class="card alert-message">
					<div class="card-body">
						<div class="text-center text-white">
							<svg class="alert-icons" enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
									<path d="m491.38 157.66c-13.15-30.297-31.856-57.697-55.598-81.439s-51.142-42.448-81.439-55.598c-31.529-13.686-64.615-20.625-98.338-20.625s-66.809 6.939-98.338 20.625c-30.297 13.15-57.697 31.856-81.439 55.598s-42.448 51.142-55.598 81.439c-13.686 31.529-20.625 64.615-20.625 98.338s6.939 66.809 20.625 98.338c13.149 30.297 31.855 57.697 55.598 81.439 23.742 23.742 51.142 42.448 81.439 55.598 31.529 13.686 64.615 20.625 98.338 20.625s66.809-6.939 98.338-20.625c30.297-13.15 57.697-31.856 81.439-55.598s42.448-51.142 55.598-81.439c13.686-31.529 20.625-64.615 20.625-98.338s-6.939-66.809-20.625-98.338zm-235.38 334.34c-127.92 0-236-108.08-236-236s108.08-236 236-236 236 108.08 236 236-108.08 236-236 236z"></path>
									<path d="m451.98 173.8c-10.87-25.256-26.363-48.044-46.049-67.729-19.686-19.686-42.473-35.179-67.729-46.049-26.249-11.298-53.904-17.026-82.197-17.026-38.462 0-78.555 13.134-115.94 37.981-4.6 3.057-5.851 9.264-2.794 13.863 3.057 4.6 9.264 5.85 13.863 2.794 34.1-22.66 70.365-34.638 104.88-34.638 104.62 0 193 88.383 193 193s-88.383 193-193 193-193-88.383-193-193c0-34.504 11.975-70.771 34.629-104.88 3.056-4.601 1.804-10.807-2.796-13.863-4.602-3.056-10.807-1.803-13.863 2.797-24.84 37.397-37.97 77.489-37.97 115.94 0 28.293 5.728 55.948 17.025 82.196 10.87 25.256 26.363 48.044 46.049 67.729 19.686 19.687 42.473 35.179 67.73 46.05 26.248 11.297 53.903 17.025 82.196 17.025s55.948-5.728 82.196-17.025c25.256-10.87 48.044-26.363 67.729-46.049 19.686-19.686 35.179-42.473 46.049-67.729 11.298-26.249 17.026-53.904 17.026-82.197s-5.728-55.948-17.025-82.196z"></path>
									<path d="m115 105c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10z"></path>
									<path d="m374.28 177.72c-7.557-7.557-17.6-11.719-28.281-11.719s-20.724 4.162-28.281 11.719l-91.719 91.719-31.719-31.719c-7.557-7.557-17.6-11.719-28.281-11.719s-20.724 4.162-28.278 11.716c-7.559 7.553-11.722 17.597-11.722 28.284s4.163 20.731 11.719 28.281l60 60c7.557 7.557 17.601 11.719 28.281 11.719s20.724-4.162 28.281-11.719l120-120c7.559-7.553 11.722-17.597 11.722-28.284s-4.163-20.731-11.719-28.281zm-14.142 42.42-120 120c-3.78 3.779-8.801 5.861-14.139 5.861s-10.359-2.082-14.139-5.861l-60.003-60.003c-3.777-3.775-5.858-8.795-5.858-14.136s2.081-10.361 5.861-14.139c3.78-3.779 8.801-5.861 14.139-5.861s10.359 2.082 14.139 5.861l45.861 45.861 105.86-105.86c3.78-3.779 8.801-5.861 14.139-5.861s10.359 2.082 14.142 5.864c3.777 3.775 5.858 8.795 5.858 14.136s-2.081 10.361-5.861 14.139z"></path>
							</svg>
							<h3 class="mt-4 mb-3">Success</h3>
							<p class="tx-18 text-white-50">Wow!! Du has das Passwort vom Mitarbeiter wieder auf 'syd-gcfr' gesetzt.</p>
							<a href="index.php?adm=users" class="btn btn-success">zur&uuml;ck</a>
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
								<label class="main-content-label mb-0 pt-1">Mitarbeiterliste</label>
								<div class="ms-auto float-end">
										<div class="">
											<a href="?adm=users&create=y" class="btn btn-sm btn-success"><i class="fe fe-plus"></i></a>
										</div>
									</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive border userlist-table">
								<table class="table card-table table-striped table-vcenter text-nowrap mb-0">
									<thead>
										<tr>
											<th class="wd-lg-20p"><span>Dienstnummer</span></th>
											<th class="wd-lg-20p"><span>Name</span></th>
											<th class="wd-lg-20p"><span>Rang</span></th>
											<th class="wd-lg-20p"><span>Eingestellt</span></th>
											<th class="wd-lg-8p"><span></span></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sql = "SELECT * FROM mitarbeiter";
											$result = $conn->query($sql);
											
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													// SELECT * FROM patienten ORDER BY `name` DESC; // ORDER A-Z
													?>
														<tr>
															<td>
																<?php echo $row['dienstnummer']; ?>
															</td>
															<td>
																<?php echo $row['name']; ?>
															</td>
															<td>
																<?php echo $row['rang']; ?>
															</td>
															<td>
																<?php echo $row['eingestellt']; ?>
															</td>
															<td>
																<a href="?adm=users&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
																	<i class="fe fe-search"></i>
																</a>
																<a href="#" onclick="reset_password(<?php echo $row['id']; ?>)" class="btn btn-sm btn-warning">
																	<i class="pe-7s-key"></i>
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
<script>
	function reset_password(id) {
		swal(
			{
				title: "Bist du dir sicher?",
				text: "Du bist dabei das Passwort von dem Mitarbeiter zurück zu setzen!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn btn-danger",
				confirmButtonText: "Ja, zurücksetzen!",
				closeOnConfirm: false
			},
			function(){
				window.location.href = "index.php?adm=users&resetpw="+id;
			}
		);
	}
</script>