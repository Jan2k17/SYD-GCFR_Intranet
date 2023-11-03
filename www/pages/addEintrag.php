<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
	if(!isset($_GET['pid'])){
		header('Location: index.php?p=patienten');
	}
?>
<div class="header">
	<div class="left">
	<h1>Eintrag erstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ PATIENTEN / 
			<li><a href="#" class="active">Eintrag erstellen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<?php
		if(isset($_POST['submit'])){
			$patient = $_GET['pid'];
			$ersteller = $_POST['crew'];
			$aufnahmezeit = $_POST['aufnahmezeit'];
			$berichtart = $_POST['berichtart'];
			$einsatzbeginn = $_POST['einsatzbeginn'];
			$einsatzende = $_POST['einsatzende'];
			$einsatzort = $_POST['einsatzort'];
			$einsatzmittel = $_POST['einsatzmittel'];
			$einsatzkrafte = $_POST['einsatzkrafte'];
			$ak1 = $_POST['ak1'];
			$ak2 = $_POST['ak2'];
			$ak3 = $_POST['ak3'];
			$ak4 = $_POST['ak4'];
			$ak5 = $_POST['ak5'];
			$k1_0_0 = $_POST['k1_0_0'];
			$k1_1_0 = $_POST['k1_1_0'];
			$k1_1_1 = $_POST['k1_1_1'];
			$k2_0_0 = $_POST['k2_0_0'];
			$k2_1_0 = $_POST['k2_1_0'];
			$k2_1_1 = $_POST['k2_1_1'];
			$k3_0_0 = $_POST['k3_0_0'];
			$k3_1_0 = $_POST['k3_1_0'];
			$k3_1_1 = $_POST['k3_1_1'];
			$k4_0_0 = $_POST['k4_0_0'];
			$k4_1_0 = $_POST['k4_1_0'];
			$k4_1_1 = $_POST['k4_1_1'];
			$k5_0_0 = $_POST['k5_0_0'];
			$k5_1_0 = $_POST['k5_1_0'];
			$k5_1_1 = $_POST['k5_1_1'];
			$situation = $_POST['editordata'];
			
			$sql = "INSERT INTO patienten_eintragungen (patient,ersteller,aufnahmezeit,berichtart,einsatzbeginn,einsatzende,einsatzort,einsatzmittel,einsatzkrafte,ak1,ak2,ak3,ak4,ak5,k1_0_0,k1_1_0,k1_1_1,k2_0_0,k2_1_0,k2_1_1,k3_0_0,k3_1_0,k3_1_1,k4_0_0,k4_1_0,k4_1_1,k5_0_0,k5_1_0,k5_1_1,situation)
			VALUES ('".$patient."', '".$ersteller."', '".$aufnahmezeit."', '".$berichtart."', '".$einsatzbeginn."', '".$einsatzende."', '".$einsatzort."', '".$einsatzmittel."', '".$einsatzkrafte."', '".$ak1."', '".$ak2."', '".$ak3."', '".$ak4."', '".$ak5."', '".$k1_0_0."', '".$k1_1_0."', '".$k1_1_1."', '".$k2_0_0."', '".$k2_1_0."', '".$k2_1_1."', '".$k3_0_0."', '".$k3_1_0."', '".$k3_1_1."', '".$k4_0_0."', '".$k4_1_0."', '".$k4_1_1."', '".$k5_0_0."', '".$k5_1_0."', '".$k5_1_1."', '".$situation."')";

			if ($conn->query($sql) === TRUE) {
				echo "Eintrag wurde erstellt!<br />";
			} else {
				echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
			}
		} else {
			?>
				<div class="orders">
					<form action="index.php?p=addEintrag&pid=<?php echo $_GET['pid']; ?>" method="POST">
						<div class="fin">
							<div class="form-input">
								<div class="title">Sachbearbeiter (Dienstnummer & Name)</div>
								<input type="text" name="crew" required>
							</div>
							<div class="form-input">
								<div class="title">Beh&ouml;rde</div>
								<input type="text" value="GCFR" required>
							</div>
							<div class="form-input">
								<div class="title">Aufnahmedatum u. -zeit</div>
								<input type="datetime-local" name="aufnahmezeit" required>
							</div>
						</div>
						<div class="fin2">
							<div class="form-input">
								<div class="title">Art des Berichts</div>
								<select name="berichtart">
									<option value="einsatz" selected>Einsatzbericht</option>
									<option value="medgut">Medizinisches Gutachten</option>
									<option value="tod">Todesbescheinigung</option>
								</select>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Einsatzbeginn</div>
								<input type="time" name="einsatzbeginn" required>
							</div>
							<div class="form-input">
								<div class="title">Einsatzende</div>
								<input type="time" name="einsatzende" required>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Einsatzort (ggf. Koordinaten)</div>
								<input type="text" name="einsatzort" required>
							</div>
							<div class="form-input">
								<div class="title"><center>Eingesetzte Einsatzmittel</center></div>
								<input type="text" name="einsatzmittel" required>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Weitere Rettungskräfte (Dienstnummer & Name)</div>
								<input type="text" name="einsatzkrafte" required>
							</div>
						</div>
						
						<div class="fin">
							<center>Verletzungen (K&ouml;rperteile inkl. Anzahl)</center>
						</div>
						
						<div class="fin">
							<div class="form-input">
								<div class="title">Anzahl</div>
								<input type="number" min="0" max="50" value="0" name="ak1" required>
							</div>
							<div class="form-input">
								<div class="title">Gr&ouml;ße</div>
								<select name="k1_0_0">
									<option value="klein">klein</option>
									<option value="mittel">mittel</option>
									<option value="gross">groß</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">Art der Verletzung</div>
								<select name="k1_1_0">
									<option value="prellung">Prellung</option>
									<option value="quetschung">Quetschung</option>
									<option value="kratzer">Kratzer</option>
									<option value="schnittwunde">Schnittwunde</option>
									<option value="stichwunde">Stichwunde</option>
									<option value="risswunde">Risswunde</option>
									<option value="avulsion">Avulsion</option>
									<option value="balltrauma">Ballistisches Trauma</option>
									<option value="fraktur">Fraktur</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">K&ouml;rperteil</div>
								<select name="k1_1_1">
									<option value="kopf">Kopf</option>
									<option value="torso">Torso</option>
									<option value="rarm">Rechter Arm</option>
									<option value="larm">Linker Arm</option>
									<option value="rbein">Rechtes Bein</option>
									<option value="lbein">Linkes Bein</option>
								</select>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Anzahl</div>
								<input type="number" min="0" max="50" value="0" name="ak2" required>
							</div>
							<div class="form-input">
								<div class="title">Gr&ouml;ße</div>
								<select name="k2_0_0">
									<option value="klein">klein</option>
									<option value="mittel">mittel</option>
									<option value="gross">groß</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">Art der Verletzung</div>
								<select name="k2_1_0">
									<option value="prellung">Prellung</option>
									<option value="quetschung">Quetschung</option>
									<option value="kratzer">Kratzer</option>
									<option value="schnittwunde">Schnittwunde</option>
									<option value="stichwunde">Stichwunde</option>
									<option value="risswunde">Risswunde</option>
									<option value="avulsion">Avulsion</option>
									<option value="balltrauma">Ballistisches Trauma</option>
									<option value="fraktur">Fraktur</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">K&ouml;rperteil</div>
								<select name="k2_1_1">
									<option value="kopf">Kopf</option>
									<option value="torso">Torso</option>
									<option value="rarm">Rechter Arm</option>
									<option value="larm">Linker Arm</option>
									<option value="rbein">Rechtes Bein</option>
									<option value="lbein">Linkes Bein</option>
								</select>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Anzahl</div>
								<input type="number" min="0" max="50" value="0" name="ak3" required>
							</div>
							<div class="form-input">
								<div class="title">Gr&ouml;ße</div>
								<select name="k3_0_0">
									<option value="klein">klein</option>
									<option value="mittel">mittel</option>
									<option value="gross">groß</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">Art der Verletzung</div>
								<select name="k3_1_0">
									<option value="prellung">Prellung</option>
									<option value="quetschung">Quetschung</option>
									<option value="kratzer">Kratzer</option>
									<option value="schnittwunde">Schnittwunde</option>
									<option value="stichwunde">Stichwunde</option>
									<option value="risswunde">Risswunde</option>
									<option value="avulsion">Avulsion</option>
									<option value="balltrauma">Ballistisches Trauma</option>
									<option value="fraktur">Fraktur</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">K&ouml;rperteil</div>
								<select name="k3_1_1">
									<option value="kopf">Kopf</option>
									<option value="torso">Torso</option>
									<option value="rarm">Rechter Arm</option>
									<option value="larm">Linker Arm</option>
									<option value="rbein">Rechtes Bein</option>
									<option value="lbein">Linkes Bein</option>
								</select>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Anzahl</div>
								<input type="number" min="0" max="50" value="0" name="ak4" required>
							</div>
							<div class="form-input">
								<div class="title">Gr&ouml;ße</div>
								<select name="k4_0_0">
									<option value="klein">klein</option>
									<option value="mittel">mittel</option>
									<option value="gross">groß</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">Art der Verletzung</div>
								<select name="k4_1_0">
									<option value="prellung">Prellung</option>
									<option value="quetschung">Quetschung</option>
									<option value="kratzer">Kratzer</option>
									<option value="schnittwunde">Schnittwunde</option>
									<option value="stichwunde">Stichwunde</option>
									<option value="risswunde">Risswunde</option>
									<option value="avulsion">Avulsion</option>
									<option value="balltrauma">Ballistisches Trauma</option>
									<option value="fraktur">Fraktur</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">K&ouml;rperteil</div>
								<select name="k4_1_1">
									<option value="kopf">Kopf</option>
									<option value="torso">Torso</option>
									<option value="rarm">Rechter Arm</option>
									<option value="larm">Linker Arm</option>
									<option value="rbein">Rechtes Bein</option>
									<option value="lbein">Linkes Bein</option>
								</select>
							</div>
						</div>
						<div class="fin">
							<div class="form-input">
								<div class="title">Anzahl</div>
								<input type="number" min="0" max="50" value="0" name="ak5" required>
							</div>
							<div class="form-input">
								<div class="title">Gr&ouml;ße</div>
								<select name="k5_0_0">
									<option value="klein">klein</option>
									<option value="mittel">mittel</option>
									<option value="gross">groß</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">Art der Verletzung</div>
								<select name="k5_1_0">
									<option value="prellung">Prellung</option>
									<option value="quetschung">Quetschung</option>
									<option value="kratzer">Kratzer</option>
									<option value="schnittwunde">Schnittwunde</option>
									<option value="stichwunde">Stichwunde</option>
									<option value="risswunde">Risswunde</option>
									<option value="avulsion">Avulsion</option>
									<option value="balltrauma">Ballistisches Trauma</option>
									<option value="fraktur">Fraktur</option>
								</select>
							</div>
							<div class="form-input">
								<div class="title">K&ouml;rperteil</div>
								<select name="k5_1_1">
									<option value="kopf">Kopf</option>
									<option value="torso">Torso</option>
									<option value="rarm">Rechter Arm</option>
									<option value="larm">Linker Arm</option>
									<option value="rbein">Rechtes Bein</option>
									<option value="lbein">Linkes Bein</option>
								</select>
							</div>
						</div>
						
						<br />
						
						<textarea id="summernote" name="editordata" required></textarea>
						
						<div class="fin">
							<div class="form-input">
								<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
							</div>
						</div>
					</form>
				</div>
				<script>
						$(document).ready(function() {
							$('#summernote').summernote({
								placeholder: 'Situationsbeschreibung',
								tabsize: 2,
								height: 120,
								toolbar: [
								  ['style', ['style']],
								  ['font', ['bold', 'underline', 'clear']],
								  ['color', ['color']],
								  ['para', ['ul', 'ol', 'paragraph']],
								  ['table', ['table']],
								  ['insert', ['link', 'picture', 'video']],
								  ['view', ['fullscreen', 'codeview', 'help']]
								]
							  });
						});
					</script>
			<?php
		}
	?>
</div>