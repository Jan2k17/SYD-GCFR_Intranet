<div class="header">
	<div class="left">
	<h1>Mitarbeiter einstellen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ ADMIN / 
			<li><a href="#" class="active">Mitarbeiter einstellen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<?php
		if(isset($_POST['submit'])){
			
			$name = $_POST['name'];
			$qualification = $_POST['qualification'];
			$telefon = $_POST['telefon'];
			$forum = $_POST['forum'];
			$note = $_POST['note'];
			
			$sql = "INSERT INTO mitarbeiter (name, qualifikation, telefon, forum, note)
			VALUES ('".$name."', '".$qualification."', '".$telefon."', '".$forum."', '".$note."')";

			if ($conn->query($sql) === TRUE) {
				echo "Mitarbeiter wurde angelegt!<br />";
			} else {
				echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
			}
			
		}
	?>
	<div class="orders">
		<form action="index.php?p=adm_addCrew" method="POST">
			<div class="form-input">
				<input type="text" placeholder="Name" name="name" required>
			</div>
			<div class="form-input">
				<input type="text" placeholder="Qualifikation" name="qualification">
			</div>
			<div class="form-input">
				<input type="number" placeholder="Telefon" name="telefon">
			</div>
			<div class="form-input">
				<input type="text" placeholder="Forum" name="forum" required>
			</div>
			<div class="form-input">
				<input type="text" placeholder="Notiz" name="note">
			</div>
			
			<div class="form-input">
				<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
			</div>
		</form>
	</div>
</div>