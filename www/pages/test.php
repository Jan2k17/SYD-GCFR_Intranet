<?php
	
?>
<div class="bottom-data">
	<div class="orders">
		<?php
			// AD COLUMN:
			// ALTER TABLE `ausbildungen` ADD `name` TINYINT(4) NOT NULL DEFAULT '0';
			
			// DEL COLUMN:
			// ALTER TABLE `ausbildungen` DROP COLUMN `name`;
			
			// SHOW COLUMNS:
			// SHOW COLUMNS FROM ausbildungen;
			
			$sql = "SHOW COLUMNS FROM ausbildungen;";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo $row['Field']."<br />";
				}
			}
		?>
	</div>
</div>