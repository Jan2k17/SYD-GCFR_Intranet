<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="bottom-data">
	<div class="orders">
		<div class="header">
			<i class='bx bx-receipt'></i>
			<h3>Mitarbeiter</h3>
			<form action="#">
				<div class="form-input">
					<input type="search" id="myInput" onkeyup="search()" placeholder="Suchen...">
				</div>
			</form>
		</div>
		<table id="myTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Rang</th>
					<!-- <th>Qualifikation</th>
					<th>Ausbilder</th>
					<th>Telefon</th>
					<th>Einstellung</th> -->
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
								//echo "STOP<br />";
								//return $decoded_response[$row]["mediclevel"];
								if($decoded_response[$row]["mediclevel"] > 0){
									?>
										<tr>
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