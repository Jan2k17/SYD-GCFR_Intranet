<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
	if($_GET['pid'] != ""){
		?>
			<div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Patient - <u><?php echo $_GET['name']; ?></u></h3>
						<div class="tooltip">
							<a href="?p=addEintrag&pid=<?php echo $_GET['pid']; ?>"><i class='bx bx-plus'></i></a>
							<span class="tooltiptext">Eintrag erstellen</span>
						</div>
                    </div>
					<table>
						<thead>
							<tr>
								<th></th>
								<th>Eingetragen</th>
								<th>Sachbearbeiter</th>
								<th>Berichtart</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM patienten_eintragungen WHERE patient = '".$_GET['pid']."';";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
											<tr>
												<td>
													<p><a href="?p=eintrag&eid=<?php echo $row['id']; ?>"><i class='bx bx-search-alt'></i></a></p>
												</td>
												<td>
													<p><?php echo $row['eingetragen']; ?></p>
												</td>
												<td>
													<p><?php echo $row['ersteller']; ?></p>
												</td>
												<td>
													<p>
														<?php
															if($row['art'] == "medgut"){
																echo '<span class="status completed">Medizinisches Gutachten</span>';
															} if($row['art'] == "tod"){
																echo '<span class="status pending">Todesbescheinigung</span>';
															} else {
																echo '<span class="status pending">Einsatzbericht</span>';
															}
														?>
													</p>
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
		<?php
	} else {
		?>
			<div class="bottom-data">
				<div class="orders">
					<div class="header">
						<i class='bx bx-receipt'></i>
						<h3>Patienten</h3>
						<div class="tooltip">
							<a href="?p=addPatient"><i class='bx bx-plus'></i></a>
							<span class="tooltiptext">Patient erstellen</span>
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
								<th>Geburtstag</th>
								<th>Wohnort</th>
								<th>EX</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM patienten";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
											<tr>
												<td>
													<p><a href="?p=patienten&pid=<?php echo $row['id']; ?>&name=<?php echo $row['name']; ?>"><i class='bx bx-search-alt'></i></a></p>
												</td>
												<td>
													<p><?php echo $row['name']; ?></p>
												</td>
												<td>
													<p><?php echo $row['geburtstag']; ?></p>
												</td>
												<td>
													<p><?php echo $row['wohnort']; ?></p>
												</td>
												<td>
													<?php
														if($row['ex'] == 1){
															echo '<span class="status pending">JA</span>';
														} else {
															echo '<span class="status completed">NEIN</span>';
														}
													?>
												</td>
											</tr>
										<?php
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
							td = tr[i].getElementsByTagName("td")[1];
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