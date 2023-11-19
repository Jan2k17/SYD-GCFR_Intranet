<?php
	function getrang($dn){
		include('config.php');
		
		$sql = "SELECT * FROM mitarbeiter WHERE dienstnummer='$dn'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['rang'];
			}
		} else {
			return "1";
		}
	}
	
	function nav_granted($setting, $dn){
		include('config.php');
		
		$sql = "SELECT value FROM settings WHERE setting='$setting'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if(getrang($dn) >= $row['value']){
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
	
	function getNameByID($id){
		include('config.php');
		
		$sql = "SELECT * FROM mitarbeiter WHERE id='$id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['name'];
			}
		} else {
			return "XX XXX";
		}
	}
	
	function getByID($id){
		include('config.php');
		
		$sql = "SELECT * FROM mitarbeiter WHERE id='$id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['dienstnummer']." - ".$row['name'];
			}
		} else {
			return "XX - XX XXX";
		}
	}
	
	function getByName($name){
		include('config.php');
		
		$sql = "SELECT * FROM mitarbeiter WHERE name='$name'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['dienstnummer']." - ".$row['name'];
			}
		} else {
			return "XX - XX XXX";
		}
	}
	
	function getUserID($name){
		include('config.php');
		
		$sql = "SELECT * FROM mitarbeiter WHERE name='$name'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['id'];
			}
		} else {
			return "XX";
		}
	}
	
	//Patienten Eintragungen
	function getCountPE_id($rn){
		include('config.php');
		
		$sql = "SELECT COUNT(id) AS counted FROM patienten_eintragungen WHERE ersteller = '$rn';";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['counted'];
			}
		} else {
			return "0";
		}
	}
	
	function checkpw($dn,$pw){
		include('config.php');
		$sql = "SELECT * FROM mitarbeiter WHERE dienstnummer = '$dn' AND passwort = '$pw';";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return 1;
			}
		} else {
			return 0;
		}
	}
	
	function setpw($dn,$pw){
		include('config.php');
		$sql = "UPDATE patienten SET `passwort`='$pw' WHERE  `dienstnummer`='$dn';";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return 1;
			}
		} else {
			return 0;
		}
	}
	
	function countWarns($name){
		include('config.php');
		$sql = "SELECT COUNT(*) AS counted FROM verwarnungen WHERE `name` = '$name' AND `gelesen` = '0';";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['counted'];
			}
		} else {
			return 0;
		}
	}
	
	function updateWarns($name){
		include('config.php');
		
		$sql = "UPDATE verwarnungen SET `gelesen`=1 WHERE  `name`='$name';";
		$conn->query($sql);
	}
	
	function reset_password($id){
		include('config.php');
		
		$password= md5("syd-gcfr");
		
		$sql = "UPDATE mitarbeiter SET `passwort`='$password' WHERE  `id`='$id';";
		$conn->query($sql);
	}
	
	function istAusbilder($dn){
		include('config.php');
		
		$sql = "SELECT ausbilder FROM mitarbeiter WHERE `dienstnummer`='$dn';";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if($row['ausbilder'] != 0){
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}