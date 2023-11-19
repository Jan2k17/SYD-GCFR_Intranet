<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(getrang($_SESSION['dienstnummer']) < 7){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	?>
		<div class="row row-sm">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
				<div class="card custom-card">
					<div class="card-header border-bottom-0 pb-0">
						<div class="d-flex justify-content-between">
							<label class="main-content-label mb-0 pt-1">Ausbildungen</label>
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
															<a href="?aus=users&name=<?php echo $row['mitarbeiter']; ?>" class="btn btn-sm btn-info">
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