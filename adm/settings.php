<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(!nav_granted("editsettings", $_SESSION['dienstnummer'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_POST['submit'])){
		foreach ($_POST as $key => $value) {
			if($key != "submit"){
				$sql = "UPDATE settings SET `value`='".$value."' WHERE  `setting`='".$key."'";
				if ($conn->query($sql) === TRUE) {
					echo "<br /><u>".$key."</u> wurde auf min. Mediclevel ".$value." gesetzt!<br />";
				} else {
					echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
				}
			}
		}
	} else {
		?>
			<div class="card custom-card">
				<div class="card-body">
					<form action="index.php?adm=settings" method="POST">
						<div class="row row-sm">
							<div class="col-lg-12 col-md-12">
								<div class="card custom-card">
									<div class="card-body">
										<?php
											$sql = "SELECT * FROM settings;";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													?>
														<div class="d-flex flex-row">
															<div class="col-xl-6">
																<div class="form-group">
																	<label><b><?php echo $row['setting']; ?></b><br /><sup><?php echo $row['desc']; ?></sup></label>
																	<input type="number" min="1" max="99" class="form-control" value="<?php echo $row['value']; ?>" name="<?php echo $row['setting']; ?>" required>
																</div>
															</div>
														</div>
													<?php
												}
												?>
													<div class="d-flex flex-row">
														<div class="col-xl-6">
															<div class="form-group">
																<button name="submit" class="btn ripple btn-main-primary btn-block">speichern</button>
															</div>
														</div>
													</div>
												<?php
											} else {
												echo 'Beim lesen der Einstellungen ist ein Fehler aufgetreten!';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php
	}
?>