<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="header">
	<div class="left">
	<h1>Patient erstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ PATIENTEN / 
			<li><a href="#" class="active">Patient erstellen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<?php
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$geburtstag = $_POST['geburtstag'];
			$wohnort = $_POST['wohnort'];
			
			$sql = "INSERT INTO patienten (name, geburtstag, wohnort)
			VALUES ('".$name."', '".$geburtstag."', '".$wohnort."')";

			if ($conn->query($sql) === TRUE) {
				echo "Patient wurde erstellt!<br />";
			} else {
				echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
			}
		}
	?>
	<div class="orders">
	<form action="index.php?p=addPatient" method="POST">
		<div class="fin">
			<div class="form-input">
				<select name="name">
					
					<?php
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
									//if($decoded_response[$row]["playerid"] == $steamid){
										?>
											<option value="<?php echo $decoded_response[$row]["name"]; ?>" selected><?php echo $decoded_response[$row]["name"]; ?></option>
										<?php
									//}
								}
							} else {
								echo 'Ungültige JSON-Antwort vom Server: ' . $response;
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="fin">
			<div class="form-input">
				Geburtstag: <input type="date" name="geburtstag" placeholder="bday" required>
			</div>
			<div class="form-input">
				Wohnort: <input type="text" name="wohnort">
			</div>
		</div>
		
		<div class="form-input">
			<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
		</div>
	</form>
	</div>
</div>

<?php
	// Die API-Endpunkt-URL
	/**/
?>