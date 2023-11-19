<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_GET['edit'])){
		if(isset($_POST['submit'])){
			$pwold = md5($_POST['pwold']);
			$pwnew = md5($_POST['pwnew']);
			$pwnew2 = md5($_POST['pwnew2']);
			
			if($pwnew == $pwnew2){
				$sql = "SELECT * FROM mitarbeiter WHERE dienstnummer = '".$_SESSION['dienstnummer']."';";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						if($row['passwort'] == $pwold){
							$sql2 = "UPDATE mitarbeiter SET `passwort`='".$pwnew."' WHERE `dienstnummer`='".$_SESSION['dienstnummer']."';";
							
							if ($conn->query($sql2) === TRUE) {
								?>
									<div class="row square">
										<div class="col-lg-12 col-md-12">
											<div class="card custom-card">
												<div class="card-body">
													<div class="alert alert-outline-success mg-b-0" role="alert">
														<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
															<span aria-hidden="true">&times;</span>
														</button>
														<strong>Well done!</strong> Dein Passwort wurde ge&auml;ndert.
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
							} else {
								?>
									<div class="row square">
										<div class="col-lg-12 col-md-12">
											<div class="card custom-card">
												<div class="card-body">
													<div class="alert alert-outline-danger mg-b-0" role="alert">
														<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
														<span aria-hidden="true">&times;</span></button>
														<strong>Oh snap!</strong> Dein Passwort konnte nicht ge&auml;ndert werden!<br />
														<?php echo "Error: " . $sql2 . "<br>" . $conn->error; ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
							}
						} else {
							?>
								<div class="row square">
									<div class="col-lg-12 col-md-12">
										<div class="card custom-card">
											<div class="card-body">
												<div class="alert alert-outline-danger mg-b-0" role="alert">
													<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
													<span aria-hidden="true">&times;</span></button>
													<strong>Oh snap!</strong> Dein Passwort konnte nicht ge&auml;ndert werden! Bitte &uuml;berpr&uuml;fe dein aktuelles Passwort!
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
						}
					}
				} else {
					?>
						<div class="row square">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="alert alert-outline-danger mg-b-0" role="alert">
											<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
											<span aria-hidden="true">&times;</span></button>
											<strong>Oh snap!</strong> Da ist leider ein Fehler aufgetreten!
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
			} else {
				?>
					<div class="row square">
						<div class="col-lg-12 col-md-12">
							<div class="card custom-card">
								<div class="card-body">
									<div class="alert alert-outline-danger mg-b-0" role="alert">
										<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
											<span aria-hidden="true">&times;</span>
										</button>
										<strong>Well done!</strong> Die neuen Passw&ouml;rter stimmen nicht &uuml;berein!
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		}
	}
?>
						<div class="row square" id="content">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<div class="panel profile-cover">
											<div class="profile-cover__img">
												<img src="../GCFRLogo.png" alt="img">
												<h3 class="h3"><?php echo $_SESSION['dienstnummer']." - ".$_SESSION['name']; ?></h3>
											</div>
											<div class="profile-cover__action bg-img"></div>
											<div class="profile-cover__info">
												<ul class="nav">
													<li><strong>
														<?php
															echo getCountPE_id(getByName($_SESSION['name']));
														?>
													</strong>Medizinische Gutachten</li>
													<!-- <li><strong>X</strong>Einsatzberichte</li> -->
												</ul>
											</div>
                                        </div>
										<div class="profile-tab tab-menu-heading">
											<nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
												<a class="nav-link active" data-bs-toggle="tab" href="#allgemein">Allgemein</a>
												<a class="nav-link" data-bs-toggle="tab" href="#settings">Einstellungen</a>
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
															<!-- AUSBILDUNGEN -->
															<!-- AUSBILDUNGEN -->
															<!-- VERWARNUNGEN -->
															<!-- max. 5 -->
															<!-- aktive = <i class="fe fe-slash"></i> -->
															<!-- inaktive = <i class="mdi mdi-alarm"></i> -->
															<?php
																updateWarns($_SESSION['name']);
																$sql_v = "SELECT * FROM verwarnungen WHERE name = '".$_SESSION['name']."' ORDER BY `id` DESC LIMIT 5;";
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
																					<p class="mg-t-0"><?php echo $row_v['notiz1']; ?></p>
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
															<!-- VERWARNUNGEN -->
														</div>
													</div>
												</div>
												<!-- main-profile-body -->
											</div>
										</div>
										<div class="main-content-body tab-pane p-4 border-top-0" id="settings">
											<div class="card-body border" data-select2-id="12">
												<form class="form-horizontal" data-select2-id="11" action="?p=profile&edit=password" method="POST">
													<div class="mb-4 main-content-label">Account</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">aktuelles Passwort</label>
															</div>
															<div class="col-md-9">
																<input type="password" class="form-control" placeholder="aktuelles Passwort" name="pwold"> </div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">neues Passwort</label>
															</div>
															<div class="col-md-9">
																<input type="password" class="form-control" placeholder="neues Passwort" name="pwnew"> </div>
														</div>
													</div>
													<div class="form-group ">
														<div class="row row-sm">
															<div class="col-md-3">
																<label class="form-label">neues Passwort wiederholen</label>
															</div>
															<div class="col-md-9">
																<input type="password" class="form-control" placeholder="neues Passwort wiederholen" name="pwnew2"> </div>
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
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>