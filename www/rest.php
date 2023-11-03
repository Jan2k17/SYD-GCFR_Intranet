<?php
//echo get_mediclevel("76561198118324527");

function get_mediclevel($steamid){
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
				if($decoded_response[$row]["playerid"] == $steamid){
					//echo "STOP<br />";
					return $decoded_response[$row]["mediclevel"];
				}
			}
		} else {
			echo 'Ungültige JSON-Antwort vom Server: ' . $response;
		}
	}
}
?>