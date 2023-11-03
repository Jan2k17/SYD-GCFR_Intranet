<?php
	if(!isset($_SESSION['steamid'])){
		header('Location: index.php');
	}
?>
<div class="header">
	<div class="left">
	<h1>Einstellungen</h1>
		<ul class="breadcrumb">
			<li><a href="index.php">
				INTRANET
			</a></li>
			/ ADMIN / 
			<li><a href="#" class="active">Einstellungen</a></li>
		</ul>
	</div>
</div>
<div class="bottom-data">
	<div class="orders">
		<?php
			if(isset($_POST['submit'])){
				foreach ($_POST as $key => $value) {
					if($key != "submit"){
						$sql = "UPDATE settings SET `value`='".$value."' WHERE  `setting`='".$key."'";
						if ($conn->query($sql) === TRUE) {
							echo "<br /><u>".$key."</u> wurde auf Mediclevel ".$value." gesetzt!<br />";
						} else {
							echo "Error: " . $sql . "<br />" . $conn->error . "<br />";
						}
					}
				}
			} else {
				?>
					<form action="index.php?p=settings" method="POST">
						<?php
							$sql = "SELECT * FROM settings;";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									?>
										<div class="fin2">
											<div class="form-input">
												<div class="tooltip">
													<?php echo $row['setting']; ?>: <input type="number" min="1" max="8" value="<?php echo $row['value']; ?>" name="<?php echo $row['setting']; ?>" required>
													<span class="tooltiptextr"><?php echo $row['desc']; ?></span>
												</div>
											</div>
										</div>
									<?php
								}
								?>
									<div class="form-input">
										<button type="submit" name="submit"><i class='bx bxs-save'></i></button>
									</div>
								<?php
							} else {
								echo 'Beim lesen der Einstellungen ist ein Fehler aufgetreten!';
							}
						?>
					</form>
				<?php
			}
		?>
	</div>
</div>