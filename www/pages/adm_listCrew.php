<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
	if($_GET['crew'] != ""){
		if($_GET['edit'] == "y"){
			?>
				<div class="bottom-data">
					<div class="orders">
						<div class="header">
							<i class='bx bx-receipt'></i>
							<h3>Ausbildungsstand - <a href="?p=adm_listCrew&crew=<?php echo $_GET['crew']; ?>"><u><?php echo $_GET['crew']; ?></u></a></h3>
						</div>
						<?php
							if(isset($_POST['submit'])){
								foreach ($_POST as $key => $value) {
									if($key != "submit"){
										$sql = "UPDATE ausbildungen SET `".$key."`='".$value."' WHERE  `mitarbeiter`='".$_GET['crew']."'";
										if ($conn->query($sql) === TRUE) {
											echo "<br /><u>".$key."</u> wurde auf ".$value." gesetzt!<br />";
										} else {
											echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
										}
									}
								}
							} else {
								?>
									<form action="index.php?p=adm_listCrew&edit=y&crew=<?php echo $_GET['crew']; ?>" method="POST">
										<div class="fin">
											<?php
												$sql = "SELECT * FROM ausbildungen WHERE mitarbeiter = '".$_GET['crew']."';";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {
														?>
															<div class="form-input">
																<div class="title">Basic</div>
																<select name="basic">
																	<?php
																		if($row['basic'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">Drive</div>
																<select name="drive">
																	<?php
																		if($row['drive'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">EMT</div>
																<select name="emt">
																	<?php
																		if($row['emt'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">PM</div>
																<select name="pm">
																	<?php
																		if($row['pm'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">CCP</div>
																<select name="ccp">
																	<?php
																		if($row['ccp'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">Doctor</div>
																<select name="doctor">
																	<?php
																		if($row['doctor'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">Dispatch</div>
																<select name="dispatch">
																	<?php
																		if($row['dispatch'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">SAR</div>
																<select name="sar">
																	<?php
																		if($row['sar'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">SAR-P</div>
																<select name="sar_p">
																	<?php
																		if($row['sar_p'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">EL</div>
																<select name="el">
																	<?php
																		if($row['el'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">FF</div>
																<select name="ff">
																	<?php
																		if($row['ff'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">ENG</div>
																<select name="eng">
																	<?php
																		if($row['eng'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">CBRN</div>
																<select name="cbrn">
																	<?php
																		if($row['cbrn'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">FO</div>
																<select name="fo">
																	<?php
																		if($row['fo'] == "1"){
																			echo '<option value="1" selected>Ja</option> <option value="0">Nein</option>';
																		} else {
																			echo '<option value="1">Ja</option> <option value="0" selected>Nein</option>';
																		}
																	?>
																</select>
															</div>
															<div class="form-input">
																<div class="title">TR</div>
																<select name="tr">
																	<?php
																		if($row['tr'] == "1"){
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
											?>
										</div>
										
										<div class="fin">
											<div class="form-input">
												<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
											</div>
										</div>
									</form>
								<?php
							}
						?>
					</div>
				</div>
			<?php
		} else {
			?>
				<div class="bottom-data">
					<div class="orders">
						<div class="header">
							<i class='bx bx-receipt'></i>
							<h3>Ausbildungsstand - <u><?php echo $_GET['crew']; ?></u></h3>
							<a href="?p=adm_listCrew&edit=y&crew=<?php echo $_GET['crew']; ?>"><i class='bx bxs-pen' ></i></a>
						</div>
						<table>
							<thead>
								<tr>
									<?php
										$sql = "SHOW COLUMNS FROM ausbildungen WHERE `Field` != 'id' AND `Field` != 'mitarbeiter';";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
												echo "<th>".$row['Field']."</th>";
											}
										}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql2 = "SELECT * FROM ausbildungen WHERE mitarbeiter = '".$_GET['crew']."';";
									$result2 = $conn->query($sql2);

									if ($result2->num_rows > 0) {
										echo "<tr>";
										while($row = $result2->fetch_assoc()) {
											foreach($row as $key => $value){
												if($key != "id" && $key != "mitarbeiter"){
													?>
														<td>
															<p>
																<?php
																	if($value == 1){
																		echo '<span class="status completed">JA</span>';
																	} else {
																		echo '<span class="status pending">NEIN</span>';
																	}
																?>
															</p>
														</td>
													<?php
												}
											}
										}
										echo "</tr>";
									}
								?>
								<tr>
									<td>
										<p></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			<?php
		}
	} else if($_GET['AusAdd'] == "y"){
		if(isset($_POST['submit'])){
			$ausbildung = $_POST['ausbildung'];
			
			$sql = "ALTER TABLE `ausbildungen` ADD `".$ausbildung."` TINYINT(4) NOT NULL DEFAULT '0';";
			if ($conn->query($sql) === TRUE) {
				?>
					<div class="bottom-data">
						<div class="orders">
							Ausbildung <b></b> wurde erstellt!
						</div>
					</div>
				<?php
			} else {
				echo '<div class="bottom-data">
						<div class="orders">
							Error: '.$sql.'<br />'.$conn->error.'<br />
						</div>
					</div>';
			}
		} else {
			?>
				<div class="bottom-data">
					<div class="orders">
						<form action="index.php?p=adm_listCrew&AusAdd=y" method="POST">
							<div class="title">Ausbildung erstellen | <b>Bitte nur den K&uuml;rzel der neuen Ausbildung eingeben</b></div>
							<div class="fin">
								<div class="form-input">
									<input type="text" name="ausbildung" required>
								</div>
							</div>
							
							<div class="fin">
								<div class="form-input">
									<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php
		}
	} else if($_GET['addAus'] == "y" && $_GET['name'] != "") {
		$name = $_GET['name'];
			
		$sql = "INSERT INTO ausbildungen (mitarbeiter)
		VALUES ('".$name."')";
		
		if ($conn->query($sql) === TRUE) {
			?>
				<div class="bottom-data">
					<div class="orders">
						Eintrag wurde erstellt!
					</div>
				</div>
			<?php
		} else {
			?>
				<div class="bottom-data">
					<div class="orders">
						<?php echo "Error: " . $sql . "<br />" . $conn->error . "<br />"; ?>
					</div>
				</div>
			<?php
		}
	} else if($_GET['listAus'] == "y") {
		if($_GET['delete'] != ""){
			?>
				<div class="bottom-data">
					<div class="orders">
						<?php
							$sql = "ALTER TABLE `ausbildungen` DROP COLUMN `".$_GET['delete']."`;";
							if ($conn->query($sql) === TRUE) {
								echo "Die Ausbildung <u>".$_GET['delete']."</u> wurde gel&ouml;scht!<br />";
							} else {
								echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
							}
						?>
					</div>
				</div>
			<?php
		}
		?>
			<div class="bottom-data">
				<div class="orders">
					<div class="header">
						<i class='bx bx-receipt'></i>
						<h3>Ausbildungen</h3>
						<div class="tooltip">
							<a href="?p=adm_listCrew&AusAdd=y"><i class='bx bx-list-plus' ></i></a>
							<span class="tooltiptext">neue Ausbildung erstellen</span>
						</div>
					</div>
					<table>
						<thead>
							<tr>
								<th>Löschen</th>
								<th>Ausbildung</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SHOW COLUMNS FROM ausbildungen WHERE `Field` != 'id' AND `Field` != 'mitarbeiter';";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
											<tr>
												<td><a href="?p=adm_listCrew&listAus=y&delete=<?php echo $row['Field']; ?>"><i class='bx bx-trash' ></i></a></td>
												<td><?php echo $row['Field']; ?></td>
											</tr>
										<?php
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
	} else {
		?>
			<div class="bottom-data">
				<div class="orders">
					<div class="header">
						<i class='bx bx-receipt'></i>
						<h3>Mitarbeiter</h3>
						<div class="tooltip">
							<a href="?p=adm_listCrew&listAus=y"><i class='bx bx-list-ul'></i></a>
							<span class="tooltiptext">verf&uuml;gbare Ausbildungen auflisten</span>
						</div>
						<div class="tooltip">
							<a href="?p=adm_listCrew&AusAdd=y"><i class='bx bx-list-plus' ></i></a>
							<span class="tooltiptext">neue Ausbildung erstellen</span>
						</div>
						<form action="#">
							<div class="form-input">
								<input type="search" id="myInput" onkeyup="search()" placeholder="Suchen...">
							</div>
						</form>
					</div>
					<table id="myTable">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Rang</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// Die API-Endpunkt-URL
								$api_url = 'https://switchyourdream.de/syd/api/v1/server/get-players/';
								
								// Ihr Bearer-Token
								$token = '---';
								
								// Erstellen Sie den Kontext, um die Header festzulegen
								$context = stream_context_create(array(
									'http' => array(
										'header' => "Authorization: Bearer $token\r\n",
										'method' => 'GET',
									),
									'ssl' => array(
										'verify_peer' => false,
										'verify_peer_name' => false,
									),
								));
								
								// Führen Sie die API-Anfrage aus und speichern Sie die Antwort in $response
								$response = file_get_contents($api_url, false, $context);
								
								// Überprüfen Sie auf Fehler
								if ($response === false) {
									echo 'Fehler beim Abrufen der API-Daten.';
								} else {
									// Verarbeiten Sie die API-Antwort
									$decoded_response = json_decode($response, true);
									if ($decoded_response) {
										for($row = 0; $row < count($decoded_response); $row++){
											if($decoded_response[$row]["mediclevel"] > 0){
												?>
													<tr>
														<td>
															<?php
																$sql = "SELECT * FROM ausbildungen WHERE mitarbeiter = '".$decoded_response[$row]["name"]."';";
																$result = $conn->query($sql);
																
																if ($result->num_rows > 0) {
																	while($row2 = $result->fetch_assoc()) {
																			echo '<a href="?p=adm_listCrew&crew='.$row2['mitarbeiter'].'"><i class="bx bx-search-alt"></i></a>';
																	}
																} else {
																		echo '<a href="?p=adm_listCrew&addAus=y&name='.$decoded_response[$row]["name"].'"><i class="bx bx-plus-circle"></i></a>';
																}
															?>
														</td>
														<td><?php echo $decoded_response[$row]["name"]; ?></td>
														<td><?php echo $decoded_response[$row]["mediclevel"]; ?></td>
													</tr>
												<?php
											}
										}
									} else {
										echo 'Ungültige JSON-Antwort vom Server: ' . $response;
									}
								}
							?>
						</tbody>
					</table>
					
					<script>
						function search() {
						  var input, filter, table, tr, td, i, txtValue;
						  input = document.getElementById("myInput");
						  filter = input.value.toUpperCase();
						  table = document.getElementById("myTable");
						  tr = table.getElementsByTagName("tr");
						  for (i = 0; i < tr.length; i++) {
							td = tr[i].getElementsByTagName("td")[0];
							if (td) {
							  txtValue = td.textContent || td.innerText;
							  if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							  } else {
								tr[i].style.display = "none";
							  }
							}       
						  }
						}
					</script>
				</div>
			</div>
		<?php
	}
?>