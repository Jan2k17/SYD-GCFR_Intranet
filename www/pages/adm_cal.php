<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="header">
	<div class="left">
	<h1>Kalender</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ ADMIN / 
			<li><a href="#" class="active">Kalender</a></li>
		</ul>
	</div>
</div>
<?php
	if($_GET['addEvent'] == "y"){
		
		if(isset($_POST['submit'])){
			$evt_start = $_POST['evt_start'];
			$evt_dur = $_POST['evt_dur'];
			$evt_text = $_POST['evt_text'];
			$evt_desc = $_POST['evt_desc'];
			$evt_color = $_POST['evt_color'];
			
			$sql = "INSERT INTO events (evt_start,evt_dur,evt_text,evt_desc,evt_color)
			VALUES ('".$evt_start."','".$evt_dur."','".$evt_text."','".$evt_desc."','".$evt_color."')";

			if ($conn->query($sql) === TRUE) {
				//echo "Kalendereintrag wurde erstellt!<br />";
				?>
					<div class="bottom-data">
						<div class="orders">
							Kalendereintrag wurde erstellt!<br />
							Du wirst weitergeleitet zum <a href="index.php?p=calendar">Kalender</a>!
						</div>
					</div>
				<?php
				header('refresh:2,url=index.php?p=calendar');
			} else {
				//echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
				?>
					<div class="bottom-data">
						<div class="orders">
							<?php
								echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
							?>
						</div>
					</div>
				<?php
			}
		} else {
			?>
				<div class="bottom-data">
					<div class="orders">
						<form action="index.php?p=adm_cal&addEvent=y" method="POST">
							<div class="fin">
								<div class="form-input">
									<div class="title">Event-Titel</div>
									<input type="text" name="evt_text" required>
								</div>
								<div class="form-input">
									<div class="title">Datum</div>
									<input type="date" value="<?php echo date('Y-m-d'); ?>" name="evt_start" required>
								</div>
								<div class="form-input">
									<div class="title">Dauer (Tage)</div>
									<input type="number" value="1" name="evt_dur" required>
								</div>
							</div>
							<div class="fin">
								<div class="form-input">
									<div class="title">Beschreibung</div>
									<input type="text" name="evt_desc" required>
								</div>
								<div class="form-input">
									<div class="title">Farbe</div>
									<select name="evt_color">
										<option value="red">Rot</option>
										<option value="blue">Blau</option>
										<option value="green">Gr&uuml;n</option>
									</select>
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
		
	} else if($_GET['delEvent'] == "y" && $_GET['eventID'] != ""){
		$sql = "DELETE FROM events WHERE `id`='".$_GET['eventID']."';";
		
		if ($conn->query($sql) === TRUE) {
			?>
				<div class="bottom-data">
					<div class="orders">
						Kalendereintrag wurde entfernt!<br />
					</div>
				</div>
			<?php
			//echo "Kalendereintrag wurde entfernt!<br />";
		} else {
			?>
				<div class="bottom-data">
					<div class="orders">
						<?php
							echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
						?>
					</div>
				</div>
			<?php
		}
	} else {
		?>
			<div class="bottom-data">
				<div class="orders">
					<div class="header">
						<i class='bx bx-receipt'></i>
						<h3>Kalender</h3>
						<div class="tooltip">
							<a href="?p=adm_cal&addEvent=y"><i class='bx bx-plus'></i></a>
							<span class="tooltiptext">Eintrag erstellen</span>
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
								<th>Event</th>
								<th>Datum</th>
								<th>Dauer (Tage)</th>
								<th>Beschreibung</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM events";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
										?>
											<tr>
												<td>
													<p><a href="?p=adm_cal&delEvent=y&eventID=<?php echo $row['id']; ?>"><i class='bx bx-trash'></i></a></p>
												</td>
												<td>
													<p><?php echo $row['evt_text']; ?></p>
												</td>
												<td>
													<p><?php echo $row['evt_start']; ?></p>
												</td>
												<td>
													<p><?php echo $row['evt_dur']; ?></p>
												</td>
												<td>
													<p><?php echo $row['evt_desc']; ?></p>
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