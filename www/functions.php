<?php
	function get_site($url){
		include('config.php');
		
		$sql = "SELECT * FROM pages WHERE url='$url'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return array($row['title'],$row['content'],$row['creator'],$row['edit']);
			}
		} else {
			return "404";
		}
	}
	function add_sites($title,$content,$creator,$url,$navbar){
		include('config.php');
		
		$sql = "INSERT INTO pages (title, url, content, creator, navbar)
		VALUES ('".$title."', '".$url."', '".$content."', '".$creator."', '".$navbar."')";

		if ($conn->query($sql) === TRUE) {
			return "New record created successfully";
		} else {
			return "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	function get_setting($setting){
		include('config.php');
		
		$sql = "SELECT * FROM settings WHERE setting='$setting'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row['value'];
			}
		} else {
			return "7";
		}
	}