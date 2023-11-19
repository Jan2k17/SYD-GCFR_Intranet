<?php
	$host = "localhost";
	$user = "";
	$data = "";
	$pass = "";
	// Create connection
	$conn = new mysqli($host, $user, $pass, $data);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>