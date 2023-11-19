<?php
	if(!isset($_SESSION['name'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(!nav_granted("adddan", $_SESSION['dienstnummer'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		exit;
	}
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO dienstanweisungen (content,ersteller) VALUES ('".$_POST['content']."','Jan Peters');";
		if ($conn->query($sql) === TRUE) {
			?>
				<div class="alert-outline-success" role="alert">
					<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong>Well done!</strong> News wurde angelegt.
				</div>
			<?php
		} else {
			?>
				<div class="alert alert-outline-danger mg-b-0" role="alert">
					<button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
					<span aria-hidden="true">&times;</span></button>
					<strong>Oh snap!</strong> <?php echo "Error: " . $sql . "<br>" . $conn->error; ?>
				</div>
			<?php
		}
	}
	?>
		<form action="?adm=dienstanweisungen" method="POST">
			<div class="card custom-card">
				<div class="card-body">
					<div id="wizard1">
						<h3>Dienstanweisung erstellen</h3>
						<section>
							<div class="form-group">
                                <div class="card">
									<div class="card-header border-bottom-0">
										<h3 class="card-title">Content</h3>
									</div>
									<div class="card-body">
										<textarea class="content5" name="content"></textarea>
									</div>
								</div>
							</div>
						</section>
						<section>
							<button name="submit" class="btn ripple btn-main-primary btn-block">SPEICHERN</button>
						</section>
					</div>
				</div>
			</div>
		</form>
	<?php
?>