<?php
	var_dump($_SESSION);
	echo "<br />". getrang($_SESSION['dienstnummer']) . "<br />";
	if(getrang($_SESSION['dienstnummer']) < 9){
		echo 1;
	}
?>